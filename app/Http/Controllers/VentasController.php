<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    // Muestra la tabla de Ventas realizadas
    public function mostrarVentas()
    {
        $ventas = Venta::all();
        return view('tables.ventasTable', compact('ventas'));
    }
}
