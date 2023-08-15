<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Devolucion;
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    // Funcion para mostrar la tabla de devoluciones
    public function mostrarDevoluciones()
    {
        // Mostramos todas las devoluciones
        $devoluciones = Devolucion::all();
        return view('tables.devolucionesTable', compact('devoluciones'));
    }

    // Funcion para mostrar venta 
    public function mostrarDevolucion($id)
    {
        $venta_realizada = Venta::findOrFail($id);
        return view('tickets.ventaDevolucion', compact('venta_realizada'));
    }

    // Metodo para actualizar el motivo de la devolucion
    public function actualizarMotivoDevolucion(Request $request, $id)
    {
        // dd($request->all(), $id);
        $devolucion = Devolucion::findOrFail($id);
        $devolucion->motivo_devolucion = $request->motivo_devolucion;
        $devolucion->save();

        return back()->with('success', 'Se ha actualizado el motivo de la devolución');
    }

    // Método para devolver una venta completa
    // public function devolverVentaCompleta(Request $request,  $id)
    // {

    //     dd($request->all(), $id); // Si recibe el id de la venta 
    //     $venta = Venta::findOrFail($id);

    //     // Realiza la devolución completa
    //     $devolucion = $venta->realizarDevolucionCompleta();

    //     return back()->with('success', 'Se ha realizado la devolución completa de la venta. ID de la devolución: ' . $devolucion->id);
    // }

    // Método para devolver un producto de una venta
    public function devolverProductoVenta(Request $request,  $producto_id, $venta_id)
    {
        // dd($id);
        // dd($request->all(), $id); // Si recibe el id del producto que se vendio
        $venta = Venta::findOrFail($venta_id); // Buscamos la venta por el id
        $producto = $producto_id; // El id del producto que se va a devolver
        $cantidadDevuelta = $request->cantidad_vendida; // La cantidad que se va a devolver

        try {
            // dd($venta, $producto_id, $cantidadDevuelta); // Si recibe el id del producto que se vendio
            // dd($producto_id, $cantidadDevuelta);
            $devolucion = Devolucion::where('venta_id', $venta_id)->where('producto_id', $producto_id)->first();
            $venta->load('productos');

            // Condicionamos que si ya existe el id de la venta y id del producto en la tabla de devoluciones se actualice la cantidad devuelta
            if ($devolucion) {

                $nuevaCantidadDevuelta = $devolucion->cantidad_devuelta + $cantidadDevuelta;
                $devolucion->update(['cantidad_devuelta' => $nuevaCantidadDevuelta]);
                // Buscar el producto dentro de la relación cargada
                $productoEnVenta = $venta->productos->find($producto_id);

                if ($productoEnVenta) {

                    // Actualizar la cantidad vendida en la tabla pivot de ventas_de_productos
                    $venta->productos()->updateExistingPivot($producto_id, [
                        'cantidad_vendida' => $productoEnVenta->pivot->cantidad_vendida - $cantidadDevuelta
                    ]);
                }

                return back()->with('success', 'Se ha actualizado la cantidad devuelta del producto de la venta. Devolución: ' . $devolucion->id);
            } else {

                // Sino existe el id de la venta y id del producto en la tabla de devoluciones se crea una nueva devolucion
                // Realiza la devolución del producto
                $devolucion = $venta->realizarDevolucionProducto($producto_id, $cantidadDevuelta);
                return back()->with('success', 'Se ha realizado la devolución del producto de la venta. Devolución: ' . $devolucion->id);
            }
        } catch (\Exception $e) {

            dd($e->getMessage());
            return back()->with('error', 'Ha ocurrido un error al realizar la devolución del producto: ' . $e->getMessage());
        }
    }

    // Metodo para eliminar una devolucion
    public function eliminarDevolucion($id)
    {
        $devolucion = Devolucion::findOrFail($id);
        $devolucion->delete();

        return back()->with('success', 'Se ha eliminado la devolución');
    }
}
