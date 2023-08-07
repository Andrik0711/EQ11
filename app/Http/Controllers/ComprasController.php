<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $clientes = Cliente::all();
        return view('compras.compraVista', compact('clientes', 'todosLosProductos', 'categorias'));
    }
}
