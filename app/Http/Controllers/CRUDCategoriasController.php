<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CRUDCategoriasController extends Controller
{
    // Metodo que manda a la vista de registrar Categorias
    public function registrarCategoria()
    {
        return view('forms.categoriaForm');
    }
}
