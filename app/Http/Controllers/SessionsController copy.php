<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PDFController extends Controller
{
    // ... Tu código existente ...

    public function generarPDF()
    {
        $categorias = Categoria::all(); // Obtén todas las categorías

        // $pdf = PDF::loadView('pdf.categorias', compact('categorias'));

        // return $pdf->download('categorias.pdf');
    }
}
