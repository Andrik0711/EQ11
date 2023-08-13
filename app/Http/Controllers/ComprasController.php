<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Proveedor;

class ComprasController extends Controller
{
    // Metodo para mostrar la vista de compras
    public function index()
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
            return back()->with('warning', 'No se puede agregar un producto con 0 o menos unidades');
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
        return back();
    }


    // Metodo para eliminar un producto de la tabla de compras
    public function eliminarProducto(Request $request)
    {
        dd($request->all());
    }

    // Metodo para guardar la compra
    public function guardarCompra(Request $request)
    {
        dd($request->all());
    }
}
