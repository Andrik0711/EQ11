<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Carrito;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class POSController extends Controller
{
    //Motodo que muestra la vista de productos
    public function index()
    {
        // pasamos todas las categorias a la vista
        $categorias = Categoria::all();

        // Obtenemos todos los productos
        $todosLosProductos = Producto::all();

        // Pasamos todos los clientes a la vista
        $clientes = Cliente::all();
        return view('pos.pos', compact('categorias', 'todosLosProductos', 'clientes'));
    }

    // Metodo para hacer el filtrado de productos por categoria
    public function filtrarProductos($categoriaId)
    {
        // dd($categoriaId);
        // Obtener todas las categorias
        $categorias = Categoria::all();

        // Obtener los productos de la categoría seleccionada
        $productosfiltrados = Producto::where('id_categoria_producto', $categoriaId)->get();

        // Pasamos todos los clientes a la vista
        $clientes = Cliente::all();

        // Pasar los productosfiltrados filtrados a la vista
        return view('pos.pos', compact('productosfiltrados', 'categorias', 'clientes'));
    }

    public function agregarCarrito(Request $request)
    {
        $carrito = session()->get('carrito', []);
        $producto_id = $request->get('producto_id');
        $accion = $request->get('agregar');

        if (!isset($carrito[$producto_id])) {
            // Obtener el producto a partir del id
            $producto = Producto::findOrFail($producto_id);

            if ($producto->unidades_disponibles === 0) {
                return back()->with('warning', 'No se puede agregar un producto con 0 unidades disponibles');
            }

            $carrito[$producto_id] = [
                'nombre' => $producto->nombre_producto,
                'precio' => $producto->precio_de_venta,
                'cantidad' => 1,
                'imagen' => $producto->imagen_producto,
            ];
        } else {
            // Obtener el producto a partir del id
            $producto = Producto::findOrFail($producto_id);

            if ($accion === 'add') {
                if ($carrito[$producto_id]['cantidad'] < $producto->unidades_disponibles) {
                    $carrito[$producto_id]['cantidad']++;
                } else {
                    return back()->with('warning', 'No se puede agregar más unidades de este producto');
                }
            } elseif ($accion === 'less') {
                if ($carrito[$producto_id]['cantidad'] > 1) {
                    $carrito[$producto_id]['cantidad']--;
                } else {
                    unset($carrito[$producto_id]);
                }
            }
        }

        session()->put('carrito', $carrito);
        return back()->with('mensaje', 'Operación realizada exitosamente');
    }


    // Eliminar el producto del carrito
    public function eliminarCarrito(Request $request)
    {
        $carrito = session()->get('carrito', []);
        $producto_id = $request->get('producto_id');

        if (isset($carrito[$producto_id])) {
            unset($carrito[$producto_id]);
        }

        session()->put('carrito', $carrito);
        return back()->with('mensaje', 'Producto eliminado del carrito');
    }

    // Almacenar la venta en la base de datos
    public function almacenarVenta(Request $request)
    {

        // dd($request->all());

        // Condicionamos que una venta no se pueda realizar
        // si el pago no es igual o mayor al total de la venta
        if ($request->input('pago') < $request->input('total')) {
            return back()->with('warning', 'El pago no puede ser menor al total de la venta');
        } else if ($request->input('pago') == 0) {
            return back()->with('warning', 'El pago no puede ser igual a 0');
        }


        // Obtener los datos de la solicitud
        $total = $request->input('total');
        $subtotal = $request->input('subtotal');
        $impuestos = $request->input('impuestos');
        $unidades_vendidas = $request->input('unidades_vendidas'); // Numero de productos diferenres vendidos
        $pago = $request->input('pago');
        $id_cliente_venta = $request->input('cliente_venta');

        // Validar que el carrito no esté vacío
        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            return back()->with('mensaje', 'No hay productos en el carrito');
        }

        // Iniciar una transacción
        DB::beginTransaction();

        try {
            // Obtener el cliente a partir del id
            $cliente = Cliente::findOrFail($id_cliente_venta);

            // Crear la venta
            $venta = new Venta();
            $venta->fecha_venta = Carbon::now();
            $venta->cliente_id = $cliente->id;

            // Condicionar el estatus de la venta
            $venta->venta_status = ($pago < $total) ? "pendiente" : "terminada";

            // Almacenar los demás datos
            $venta->venta_abono = $pago;
            $venta->venta_subtotal = $subtotal;
            $venta->venta_impuestos = $impuestos;
            $venta->venta_total = $total;
            $venta->venta_unidades_vendidas = $unidades_vendidas;

            // Guardar la venta
            $venta->save();

            // Obtener los productos vendidos del carrito
            $productosVendidos = [];
            foreach ($carrito as $producto_id => $producto) {
                $productosVendidos[$producto_id] = [
                    'cantidad_vendida' => $producto['cantidad'],
                    'precio_unitario' => $producto['precio'],
                    'subtotal' => $producto['cantidad'] * $producto['precio'],
                ];
            }

            // Asociar los productos vendidos a la venta
            $venta->productos()->attach($productosVendidos);


            // Actualizar el stock de los productos vendidos
            // foreach ($carrito as $producto_id => $producto) {
            //     $producto = Producto::findOrFail($producto_id);
            //     $producto->unidades_disponibles -= $producto['cantidad'];
            //     $producto->save();
            // }


            // Actualizar la cantidad disponible de los productos vendidos
            foreach ($productosVendidos as $producto_id => $productoVendido) {
                $producto = Producto::findOrFail($producto_id); // Obtener el producto
                // Restar la cantidad vendida a la cantidad disponible
                $nuevaCantidadDisponible = $producto->unidades_disponibles - $productoVendido['cantidad_vendida'];
                $producto->update(['unidades_disponibles' => $nuevaCantidadDisponible]); // Actualizar la cantidad disponible
            }


            DB::commit();
            if ($request->input('pago') > $request->input('total')) {
                $diferencia = $request->input('pago') - $request->input('total');
                // Limpiar el carrito de la sesión después de guardar la venta
                session()->forget('carrito');
                return back()->with('Listo', 'Venta realizada, pero el pago es mayor al total de la venta. Se debe regresar: $' . number_format($diferencia, 2));
            } else {
                session()->forget('carrito');
                return back()->with('Listo', 'Venta realizada con éxito');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('warning', 'Ha ocurrido un error al procesar la venta, verifique los datos');
        }
    }
}
