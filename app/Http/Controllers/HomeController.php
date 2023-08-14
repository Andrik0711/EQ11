<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Marca;
use App\Models\Venta;
use App\Models\Compra;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Cotizacion;
use App\Models\Devolucion;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Obtenemos el total de categorias registradas
        $totalCategorias = Categoria::all();

        // Obtenemos el total de subcategorias registradas
        $totalSubcategorias = Subcategoria::all();

        // Obtenemos el total de Marcas
        $totalMarcas = Marca::all();

        // obtenemos todos los productos de la base de datos
        $totalProductos = Producto::all();

        // Obtenemos el total de usuarios registrados
        $totalUsuarios = User::all();

        // Obtenemos el total de proveedores registrados
        $totalProveedores = Proveedor::all();

        // Obtenemos el total de clientes
        $totalClientes = Cliente::all();

        // Obtenemos el total de ventas
        $totalVentas = Venta::all();

        // Obtenemos el total de compras
        $totalCompras = Compra::all();

        // Obtenemos el total de cotizaciones
        $totalCotizaciones = Cotizacion::all();

        // Obtenemos el total de devoluciones
        $totalDevoluciones = Devolucion::all();


        return view('dashboard', compact('totalCategorias', 'totalSubcategorias', 'totalMarcas', 'totalProductos', 'totalUsuarios', 'totalProveedores', 'totalClientes', 'totalVentas', 'totalCompras', 'totalCotizaciones', 'totalDevoluciones'));
    }
}
