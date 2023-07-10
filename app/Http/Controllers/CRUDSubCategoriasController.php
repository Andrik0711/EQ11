<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CRUDSubCategoriasController extends Controller
{
    // Metodo que manda a la vista de registrar SubCategorias
    public function registrarSubCategoria()
    {
        return view('forms.subcategoriaForm');
    }
}
