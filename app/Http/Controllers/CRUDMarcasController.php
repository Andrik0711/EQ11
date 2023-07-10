<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Marca as ModelsMarca;
use Intervention\Image\Facades\Image;

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

        //validar que se este enviando una imagen
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

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
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

        //pasamos la imagen de memoria al server
        $imagenServidor->save($imagenPath);

        ///verificamos que el nombre del archivo se ponga como unico
        return response()->json(['imagen' => $nombreImagen]);
    }

    // Metodo para registrar una marca
    public function MarcaStore(Request $request)
    {

        dd($request->all());

        // Validacion de los campos
        $request->validate([
            'nombre_marca' => 'required',
            'descripcion_marca' => 'required',
            'imagen' => 'required',
            'marca_creada_por' => 'required'
        ]);

        // Almacenar los datos en la base de datos
        Marca::created([
            'imagen_marca' => $request->imagen,
            'nombre_marca' => $request->nombre_marca,
            'descripcion_marca' => $request->descripcion_marca,
            'marca_creada_por' => $request->marca_creada_por
        ]);
    }
}
