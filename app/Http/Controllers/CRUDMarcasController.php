<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\PDF;

class CRUDMarcasController extends Controller
{
    // Metodo que manda a la vista de registrar Marcas
    public function registrarMarca()
    {
        return view('forms.marcaForm');
    }

    // Metodo para almacenar la imagen 
    public function MarcaImageStore(Request $request)
    {

        //identificar el archivo que se sube en dropzone
        $imagen = $request->file('file');

        //convertimos el arreglo input a formato json
        //return response()->json(['imagen'=>$imagen->extension()]);
        //genera un id unico para cada una de las imagenes que se cargan en el server
        $nombreImagen = Str::uuid() . "." . $imagen->extension();

        //implementar intervention Image 
        $imagenServidor = Image::make($imagen);

        //agregamos efectps de intervention image: indicamos la medida de cada imagen
        $imagenServidor->fit(1000, 1000);

        //movemos la imagen a un lugar fisico del servidor
        $imagenPath = public_path('marcas') . '/' . $nombreImagen;

        //pasamos la imagen de memoria al server
        $imagenServidor->save($imagenPath);

        ///verificamos que el nombre del archivo se ponga como unico
        return response()->json(['imagen' => $nombreImagen]);
    }

    // Metodo para registrar una marca
    public function MarcaStore(Request $request)
    {

        // dd($request->all());

        // Validacion de los campos
        $request->validate([
            'nombre_marca' => 'required|unique:marcas,nombre_marca',
            'descripcion_marca' => 'required',
            'imagen' => 'required',
            'marca_creada_por' => 'required'
        ]);

        // Almacenar los datos en la base de datos
        Marca::create([
            'imagen_marca' => $request->imagen,
            'nombre_marca' => $request->nombre_marca,
            'descripcion_marca' => $request->descripcion_marca,
            'marca_creada_por' => $request->marca_creada_por
        ]);

        // Redireccionar la misms vista
        return back()->with('success', 'Marca creada con éxito');
    }

    // Metodo para mostrar las marcas
    public function mostrarMarcas()
    {
        $marcas = Marca::all();
        return view('tables.marcaTable', compact('marcas'));
    }

    // Metodo direccionar al formulario de editar
    public function editarMarca($id)
    {
        $marca = Marca::findOrFail($id);
        return view('update.marcaUpdate', compact('marca'));
    }

    // Metodo para actualizar los datos de la marca
    public function MarcaUpdate(Request $request, $id)
    {

        // dd($request->all());

        // Validacion de los campos de nombre y descripcion
        $request->validate([
            'nombre_marca' => 'required',
            'descripcion_marca' => 'required',
        ]);

        // Obtenemos la información de la marca actual
        $marca = Marca::findOrFail($id);

        // dd($request->imgen); // Si recibe null

        // Verificamos si se cargó una nueva imagen
        if ($request->imagen != null) {

            // Eliminamos la imagen anterior de la carpeta uploads
            File::delete(public_path('marcas') . '/' . $marca->imagen_marca);

            // Guardamos el nombre de la nueva imagen en el modelo de la marca
            $marca->imagen_marca = $request->imagen;
        }

        // Actualizamos el nombre y descripción de la marca
        $marca->nombre_marca = $request->input('nombre_marca');
        $marca->descripcion_marca = $request->input('descripcion_marca');

        // Guardamos los cambios en la base de datos
        $marca->save();

        return back()->with('success', 'Marca actualizada con éxito');
    }

    // Metodo para eliminar una marca
    public function MarcaDestroy($id)
    {
        try {
            $marca = Marca::findOrFail($id);
            // Eliminar la marca de la base de datos y la imagen de la carpeta marcas

            if ($marca->delete()) {
                File::delete(public_path('marcas') . '/' . $marca->imagen_marca);
            }
            return back()->with('success', 'Marca eliminada con éxito');
        } catch (\Exception $e) {
            return back()->with('error', 'No se puede eliminar la marca porque tiene productos asociados');
        }
    }



    public function exportarPDFMarcas()
    {

        $marcas = Marca::all();

        $pdf = \PDF::loadView('tables.marcas-pdf', compact('marcas'));
        return $pdf->download('marcas.pdf');
    }
}
