<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class POSController extends Controller
{
    //Motodo que muestra la vista de productos
    public function index()
    {
        $categorias = Categoria::all();

        $todosLosProductos = Producto::all();
        return view('pos.pos', compact('categorias', 'todosLosProductos'));
    }

    // Metodo para hacer el filtrado de productos por categoria
    public function filtrarProductos($categoriaId)
    {
        // dd($categoriaId);
        // Obtener todas las categorias
        $categorias = Categoria::all();

        // Obtener los productos de la categoría seleccionada
        $productosfiltrados = Producto::where('id_categoria_producto', $categoriaId)->get();

        // Pasar los productosfiltrados filtrados a la vista
        return view('pos.pos', compact('productosfiltrados', 'categorias'));
    }

    // Metodo que manda a la vista del producto seleccionado
    public function productoSeleccionado($id)
    {
        // verificamos si se pasa el producto
        // dd($id);


        $producto = Producto::findOrFail($id);
        return view('compras.productoVista', compact('producto'));
    }
}
