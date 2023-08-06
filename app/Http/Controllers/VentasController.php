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

    // Muestra el ticket de la venta realizada
    public function mostrarTicket($id)
    {
        $venta_realizada = Venta::findOrFail($id);
        return view('tickets.ventaTicket', compact('venta_realizada'));
    }
}
