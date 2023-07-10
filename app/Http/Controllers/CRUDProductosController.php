<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CRUDProductosController extends Controller
{
    // Metodo que manda a la vista de registrar productos
    public function registrarProducto()
    {
        return view('forms.productoForm');
    }
}
