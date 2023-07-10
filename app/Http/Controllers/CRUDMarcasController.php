<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CRUDMarcasController extends Controller
{
    // Metodo que manda a la vista de registrar Marcas
    public function registrarMarca()
    {
        return view('forms.marcaForm');
    }
}
