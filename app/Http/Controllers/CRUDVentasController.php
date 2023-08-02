<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CRUDVentasController extends Controller
{
    // Metodo que muestra la vista de productos
    public function MostrarVentas()
    {
        return view('tables.VentasTable');
    }
}
