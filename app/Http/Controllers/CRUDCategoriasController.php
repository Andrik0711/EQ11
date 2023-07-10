<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CRUDCategoriasController extends Controller
{
    // Metodo que manda a la vista de registrar Categorias
    public function registrarCategoria()
    {
        return view('forms.categoriaForm');
    }

    // Metodo que muestra todas las categorias registradas
    public function mostrarCategorias()
    {
        $categorias = Categoria::all();
        return view('tables.categoriaTable', compact('categorias'));
    }

    // Metodo para Registar Categoria
    public function CategoriaStore(Request $request)
    {

        // dd($request->all());

        // Validacion de campos
        $request->validate([
            'nombre_categoria' => 'required',
            'codigo_categoria' => 'required|unique:categorias,codigo_categoria',
            'descripcion_categoria' => 'required',
            'categoria_creada_por' => 'required'
        ]);

        // Registramos la categoria
        Categoria::create([
            'nombre_categoria' => $request->nombre_categoria,
            'codigo_categoria' => $request->codigo_categoria,
            'descripcion_categoria' => $request->descripcion_categoria,
            'categoria_creada_por' => $request->categoria_creada_por
        ]);

        // Redireccionar a la misma vista con mensaje de exito
        return back()->with('mensaje', 'Categoria registrada con exito');
    }

    // Metodo para direcionar al form de editar una categoria
    public function editarCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('update.categoriaUpdate', compact('categoria'));
    }

    // Metodo para actualizar una categoria
    public function CategoriaUpdate(Request $request, $id)
    {

        // dd($request->all());

        // Validacion de campos
        $request->validate([
            'nombre_categoria' => 'required',
            'codigo_categoria' => 'required',
            'descripcion_categoria' => 'required',
            'categoria_creada_por' => 'required'
        ]);

        // Actualizamos la categoria
        Categoria::where('id', $id)->update([
            'nombre_categoria' => $request->nombre_categoria,
            'codigo_categoria' => $request->codigo_categoria,
            'descripcion_categoria' => $request->descripcion_categoria,
            'categoria_creada_por' => $request->categoria_creada_por
        ]);

        // Redireccionar a la misma vista con mensaje de exito
        return back()->with('mensaje', 'Categoria actualizada con exito');
    }

    // Metodo para eliminar una categoria
    public function CategoriaDestroy($id)
    {

        // dd($id);

        $categoria = Categoria::findOrFail($id);
        // Eliminar la categoría de la base de datos
        $categoria->delete();

        // Redireccionar a la misma vista con mensaje de exito
        return back()->with('mensaje', 'Categoria eliminada con exito');
    }
}
