<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\PDF;

class CRUDSubCategoriasController extends Controller
{
    // Metodo que manda a la vista de registrar SubCategorias
    public function registrarSubCategoria()
    {
        // Le pasamos las categorias a la vista
        $categorias = Categoria::all();

        return view('forms.subcategoriaForm', compact('categorias'));
    }

    // Metodo para almacenar la imagen 
    public function SubCategoriaImageStore(Request $request)
    {

        //identificar el archivo que se sube en dropzone
        $imagen = $request->file('file');

        //genera un id unico para cada una de las imagenes que se cargan en el server
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //implementar intervention Image 
        $imagenServidor = Image::make($imagen);

        //agregamos efectps de intervention image: indicamos la medida de cada imagen
        $imagenServidor->fit(1000, 1000);

        //movemos la imagen a un lugar fisico del servidor
        $imagenPath = public_path('subcategorias') . '/' . $nombreImagen;

        //pasamos la imagen de memoria al server
        $imagenServidor->save($imagenPath);

        ///verificamos que el nombre del archivo se ponga como unico
        return response()->json(['imagen' => $nombreImagen]);
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
            'nombre_subcategoria' => 'required|unique:subcategorias,nombre_subcategoria',
            'descripcion_subcategoria' => 'required',
            'subcategoria_creada_por' => 'required',
            'imagen' => 'required'
        ]);

        // Registrar SubCategoria
        Subcategoria::create([
            'categoria_subcategoria' => $request->categoria_subcategoria,
            'codigo_subcategoria' => $request->codigo_subcategoria,
            'nombre_subcategoria' => $request->nombre_subcategoria,
            'descripcion_subcategoria' => $request->descripcion_subcategoria,
            'subcategoria_creada_por' => $request->subcategoria_creada_por,
            'imagen_subcategoria' => $request->imagen
        ]);

        // Redireccionar a la misma vista con mensaje de exito
        return back()->with('success', 'Subcategoria registrada con éxito');
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
            'codigo_subcategoria' => 'required|unique:subcategorias,codigo_subcategoria',
            'nombre_subcategoria' => 'required|unique:subcategorias,nombre_subcategoria',
            'descripcion_subcategoria' => 'required',
            'subcategoria_creada_por' => 'required'
        ]);

        // Obtenemos la información de la SubCategoria actual
        $subcategoria = Subcategoria::findOrFail($id);

        // Verificamos si se cargó una nueva imagen
        if ($request->imagen != null) {

            // Eliminamos la imagen anterior de la carpeta uploads
            File::delete(public_path('subcategorias') . '/' . $subcategoria->imagen_subcategoria);

            // Guardamos el nombre de la nueva imagen en el modelo de la SubCategoria
            $subcategoria->imagen_subcategoria = $request->imagen;
        }

        // Actualizamos los campos de la SubCategoria
        $subcategoria->categoria_subcategoria = $request->input('categoria_subcategoria');
        $subcategoria->codigo_subcategoria = $request->input('codigo_subcategoria');
        $subcategoria->nombre_subcategoria = $request->input('nombre_subcategoria');
        $subcategoria->descripcion_subcategoria = $request->input('descripcion_subcategoria');
        $subcategoria->subcategoria_creada_por = $request->input('subcategoria_creada_por');

        // Guardamos los cambios en la base de datos
        $subcategoria->save();

        // Redireccionar a la misma vista con mensaje de exito
        return back()->with('success', 'Subcategoria actualizada con éxito');
    }

    // Metodo para eliminar una SubCategoria
    public function SubCategoriaDestroy($id)
    {

        try {
            // Eliminar SubCategoria
            $subcategoria = Subcategoria::findOrFail($id);
            // Eliminar la Subcategoria de la base de datos y la imagen de la carpeta subcategorias
            if ($subcategoria->delete()) {
                File::delete(public_path('subcategorias') . '/' . $subcategoria->imagen_subcategoria);
                return back()->with('success', 'Subcategoria eliminada con éxito');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'No se puede eliminar la Subcategoria porque tiene productos asociados');
        }

        // // Eliminar SubCategoria
        // $subcategoria = Subcategoria::findOrFail($id);
        // // Eliminar la Subcategoria de la base de datos y la imagen de la carpeta subcategorias
        // File::delete(public_path('subcategorias') . '/' . $subcategoria->imagen_subcategoria);
        // $subcategoria->delete();

        // // Redireccionar a la misma vista con mensaje de exito
        // return back()->with('success', 'Subcategoria eliminada con éxito');
    }



    public function exportarPDFSubCategorias()
    {
        $subcategorias = Subcategoria::all();

        $pdf = PDF::loadView('tables.subcategorias-pdf', compact('subcategorias'));
        return $pdf->download('subcategorias.pdf');
    }
}
