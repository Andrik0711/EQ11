<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class CRUDSubCategoriasController extends Controller
{
    // Metodo que manda a la vista de registrar SubCategorias
    public function registrarSubCategoria()
    {
        // Le pasamos las categorias a la vista
        $categorias = Categoria::all();

        return view('forms.subcategoriaForm', compact('categorias'));
    }

    // Metodo que muestra todas las SubCategorias registradas
    public function mostrarSubCategorias()
    {
        $subcategorias = Subcategoria::all();
        return view('tables.subcategoriaTable', compact('subcategorias'));
    }

    // Metodo que registra SubCategorias
    public function SubCategoriaStore(Request $request)
    {

        // dd($request->all());

        // Validacion de campos
        $request->validate([
            'categoria_subcategoria' => 'required',
            'codigo_subcategoria' => 'required|unique:subcategorias,codigo_subcategoria',
            'nombre_subcategoria' => 'required',
            'descripcion_subcategoria' => 'required',
            'subcategoria_creada_por' => 'required'
        ]);

        // Registrar SubCategoria
        Subcategoria::create([
            'categoria_subcategoria' => $request->categoria_subcategoria,
            'codigo_subcategoria' => $request->codigo_subcategoria,
            'nombre_subcategoria' => $request->nombre_subcategoria,
            'descripcion_subcategoria' => $request->descripcion_subcategoria,
            'subcategoria_creada_por' => $request->subcategoria_creada_por
        ]);

        // Redireccionar a la misma vista con mensaje de exito
        return back()->with('mensaje', 'SubCategoria registrada con exito');
    }

    // Metodo para direcionar al form de editar una SubCategoria
    public function editarSubCategoria($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $categorias = Categoria::all();
        return view('update.subcategoriaUpdate', compact('subcategoria', 'categorias'));
    }

    // Metodo para actualizar una SubCategoria
    public function SubCategoriaUpdate(Request $request, $id)
    {

        // dd($request->all());

        // Validacion de campos
        $request->validate([
            'categoria_subcategoria' => 'required',
            'codigo_subcategoria' => 'required',
            'nombre_subcategoria' => 'required',
            'descripcion_subcategoria' => 'required',
            'subcategoria_creada_por' => 'required'
        ]);

        // Actualizar SubCategoria
        Subcategoria::findOrFail($id)->update([
            'categoria_subcategoria' => $request->categoria_subcategoria,
            'codigo_subcategoria' => $request->codigo_subcategoria,
            'nombre_subcategoria' => $request->nombre_subcategoria,
            'descripcion_subcategoria' => $request->descripcion_subcategoria,
            'subcategoria_creada_por' => $request->subcategoria_creada_por
        ]);

        // Redireccionar a la misma vista con mensaje de exito
        return back()->with('mensaje', 'SubCategoria actualizada con exito');
    }

    // Metodo para eliminar una SubCategoria
    public function SubCategoriaDestroy($id)
    {
        // Eliminar SubCategoria
        Subcategoria::findOrFail($id)->delete();

        // Redireccionar a la misma vista con mensaje de exito
        return back()->with('mensaje', 'SubCategoria eliminada con exito');
    }
}
