<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
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
        return back()->with('mensaje', 'Marca creada con exito');
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

        // Validacion de los campos
        $request->validate([
            'nombre_marca' => 'required',
            'descripcion_marca' => 'required',
            // 'imagen' => 'required',
            // 'marca_creada_por' => 'required'
        ]);

        // Almacenar los datos en la base de datos
        Marca::where('id', $id)->update([
            // 'imagen_marca' => $request->imagen,
            'nombre_marca' => $request->nombre_marca,
            'descripcion_marca' => $request->descripcion_marca,
            // 'marca_creada_por' => $request->marca_creada_por
        ]);

        return back()->with('mensaje', 'Marca actualizada con exito');
    }

    // Metodo para eliminar una marca
    public function MarcaDestroy($id)
    {
        $marca = Marca::findOrFail($id);
        $marca->delete();
        return back()->with('mensaje', 'Marca eliminada con exito');
    }
}
