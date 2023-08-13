<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CRUDCategoriasController extends Controller
{
    // Metodo que manda a la vista de registrar Categorias
    public function registrarCategoria()
    {
        return view('forms.categoriaForm');
    }

    // Metodo para almacenar la imagen 
    public function CategoriaImageStore(Request $request)
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
        $imagenPath = public_path('categorias') . '/' . $nombreImagen;

        //pasamos la imagen de memoria al server
        $imagenServidor->save($imagenPath);

        ///verificamos que el nombre del archivo se ponga como unico
        return response()->json(['imagen' => $nombreImagen]);
    }

    // Metodo que muestra todas las categorias registradas
    public function mostrarCategorias()
    {
        $categorias = Categoria::all(); // Cambia esto según tu lógica para obtener las categorías
        return view('tables.categoriaTable', compact('categorias'));
    }

    // Metodo para Registar Categoria
    public function CategoriaStore(Request $request)
    {

        // dd($request->all());

        // Validacion de campos
        $request->validate([
            'nombre_categoria' => 'required|unique:categorias,nombre_categoria',
            'codigo_categoria' => 'required|unique:categorias,codigo_categoria',
            'descripcion_categoria' => 'required',
            'categoria_creada_por' => 'required',
            'imagen' => 'required'
        ]);

        // Registramos la categoria
        Categoria::create([
            'nombre_categoria' => $request->nombre_categoria,
            'codigo_categoria' => $request->codigo_categoria,
            'descripcion_categoria' => $request->descripcion_categoria,
            'categoria_creada_por' => $request->categoria_creada_por,
            'imagen_categoria' => $request->imagen
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
            'nombre_categoria' => 'required|unique:categorias,nombre_categoria',
            'codigo_categoria' => 'required|unique:categorias,codigo_categoria',
            'descripcion_categoria' => 'required',
            'categoria_creada_por' => 'required'
        ]);

        // Obtenemos la información de la categoria actual
        $categoria = Categoria::findOrFail($id);

        // dd($request->imgen); // Si recibe null

        // Verificamos si se cargó una nueva imagen
        if ($request->imagen != null) {

            // Eliminamos la imagen anterior de la carpeta uploads
            File::delete(public_path('categorias') . '/' . $categoria->imagen_categoria);

            // Guardamos el nombre de la nueva imagen en el modelo de la categoria
            $categoria->imagen_categoria = $request->imagen;
        }

        // Actualizamos los campos de la categoria
        $categoria->nombre_categoria = $request->input('nombre_categoria');
        $categoria->codigo_categoria = $request->input('codigo_categoria');
        $categoria->descripcion_categoria = $request->input('descripcion_categoria');
        $categoria->categoria_creada_por = $request->input('categoria_creada_por');

        // Guardamos los cambios en la base de datos
        $categoria->save();

        // Redireccionar a la misma vista con mensaje de exito
        return back()->with('mensaje', 'Categoria actualizada con exito');
    }

    // Metodo para eliminar una categoria
    public function CategoriaDestroy($id)
    {

        // dd($id);

        $categoria = Categoria::findOrFail($id);
        // Eliminar la categoría de la base de datos y la imagen de la carpeta uploads
        File::delete(public_path('categorias') . '/' . $categoria->imagen_categoria);
        $categoria->delete();

        // Redireccionar a la misma vista con mensaje de exito
        return back()->with('mensaje', 'Categoria eliminada con exito');
    }
}
