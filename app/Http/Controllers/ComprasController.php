<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Models\CompraProducto;
use App\Http\Controllers\Controller;

class ComprasController extends Controller
{
    // Metodo que muestra la tabla de compras
    public function mostrarCompras()
    {
        // Obtenemos todas las compras
        $compras = Compra::all();

        // Retornamos la vista de compras   
        return view('tables.comprasTable', compact('compras'));
    }

    // Metodo para mostrar el ticket de la compra
    public function mostrarTicket($id)
    {
        // Obtenemos la compra a partir del id
        $compra_realizada = Compra::findOrFail($id);

        // Retornamos la vista del ticket de la compra
        return view('tickets.compraTicket', compact('compra_realizada'));
    }

    // Metodo para eliminar una compra
    public function eliminarCompra($compra_id)
    {
        // Eliminar registros relacionados en compras_de_productos
        CompraProducto::where('compra_id', $compra_id)->delete();

        // Luego, eliminar la compra
        Compra::destroy($compra_id);

        // return response()->json(['message' => 'La compra ha sido eliminada correctamente.']);
        return back()->with('success', 'La compra ha sido eliminada correctamente.');
    }



    // Metodo para mostrar la vista de compras
    public function compraVista()
    {
        // pasamos todas las categorias a la vista
        $categorias = Categoria::all();

        // Obtenemos todos los productos
        $todosLosProductos = Producto::all();

        // Pasamos todos los clientes a la vista
        $proveedores = Proveedor::all();
        return view('compras.compraVista', compact('proveedores', 'todosLosProductos', 'categorias'));
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
        $proveedores = Proveedor::all();

        // Pasar los productosfiltrados filtrados a la vista
        return view('compras.compraVista', compact('productosfiltrados', 'categorias', 'proveedores'));
    }

    // Metodo para agregar un producto a la tabla de compras
    public function agregarProducto(Request $request)
    {
        $tabla = session()->get('tabla', []);
        $producto_id = $request->get('producto_id');
        $accion = $request->get('agregar');
        $cantidadCompra = (int) $request->get('cantidad_compra');

        // Obtener el producto a partir del id
        $producto = Producto::findOrFail($producto_id);

        if ($cantidadCompra <= 0) {
            return back()->with('warning', 'No se puede agregar un producto con 0 unidades o negativas');
        }

        // Validar si el producto ya existe en la tabla
        if (isset($tabla[$producto_id])) {
            $tabla[$producto_id]['cantidad'] += $cantidadCompra;
        } else {
            $tabla[$producto_id] = [
                'nombre' => $producto->nombre_producto,
                'precio' => $producto->precio_de_compra,
                'cantidad' => $cantidadCompra,
                'imagen' => $producto->imagen_producto,
            ];
        }
        session()->put('tabla', $tabla);
        return back()->with('success', 'Producto agregado correctamente');
    }

    // Metodo para guardar una compra
    public function guardarCompra(Request $request)
    {
        // dd($request->all());
        try {
            // Validar los datos recibidos con una condicion
            $request->validate([
                'fecha' => 'required|date',
                'proveedor_id' => 'required',
                'codigo_referencia' => 'nullable|string|max:255|unique:compras,referencia',
                'descripcion_compra' => 'nullable|string',
                'subtotal' => 'required|numeric',
                'totalImpuestos' => 'required|numeric',
                'total' => 'required|numeric',
                'status_compra' => 'required',
                'cantidad_productos_diferentes' => 'required|numeric',
            ]);

            dd($request->all()); // no entra al dd

            // Creamos la compra
            $compra = new Compra();
            $compra->fecha_compra = $request->get('fecha');
            $compra->proveedor_id = $request->get('proveedor_id');
            $compra->referencia = $request->get('codigo_referencia');
            $compra->descripcion = $request->get('descripcion_compra');
            $compra->compra_subtotal = $request->get('subtotal');
            $compra->compra_impuestos = $request->get('totalImpuestos');
            $compra->compra_total = $request->get('total');
            $compra->compra_status = $request->get('status_compra');
            $compra->compra_productos_comprados = $request->get('cantidad_productos_diferentes');


            // Guardamos la compra en la base de datos
            $compra->save();

            // Obtenemos los productos seleccionados de la tabla
            $productosSeleccionados = session()->get('tabla', []);

            // Recorrer todos los productos seleccionados y los asociamos a la compra en la tabla compras_de_productos
            foreach ($productosSeleccionados as $producto_id => $producto) {
                // Buscamos el producto en la base de datos
                $productoModel = Producto::find($producto_id);

                $compra->productos()->attach($productoModel, [
                    'cantidad_comprada' => $producto['cantidad'],
                    'precio_unitario' => $producto['precio'],
                    'subtotal' => $producto['cantidad'] * $producto['precio'],
                ]);

                // Actualizar la cantidad disponible del producto
                $productoModel->unidades_disponibles += $producto['cantidad'];
                $productoModel->save();
            }

            // Eliminamos la tabla de productos seleccionados de la sesión
            session()->forget('tabla');

            // Redireccionar a la misma vista con mensaje de exito
            return back()->with('success', 'Compra realizada con exito');
        } catch (\Throwable $th) {
            // Redireccionar a la misma vista con mensaje de error
            return back()->with('error', 'Error al realizar la compra');
        }
    }

    // Metodo para eliminar un producto de la tabla de compras
    public function eliminarProducto(Request $request)
    {
        // dd($request->all());
        $tabla = session()->get('tabla', []);
        $producto_id = $request->get('producto_id');

        if (isset($tabla[$producto_id])) {
            unset($tabla[$producto_id]);
            session()->put('tabla', $tabla);
            return back()->with('success', 'Producto eliminado correctamente');
        }
    }
}
