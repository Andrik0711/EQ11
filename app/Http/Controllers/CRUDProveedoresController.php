<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CRUDProveedoresController extends Controller
{
    // Metodo que manda a la vista de registrar proveedor
    public function registrarProveedor()
    {
        return view('forms.proveedoresForm');
    }

    // Metodo para almacenar la imagen 
    public function ProveedorImageStore(Request $request)
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
        $imagenPath = public_path('proveedores') . '/' . $nombreImagen;

        //pasamos la imagen de memoria al server
        $imagenServidor->save($imagenPath);

        ///verificamos que el nombre del archivo se ponga como unico
        return response()->json(['imagen' => $nombreImagen]);
    }


    // Metodo para mostrar todos los proveedores
    public function mostrarProveedores()
    {
        $proveedores = Proveedor::all();

        return view('tables.proveedoresTable', compact('proveedores'));
    }

    // Metodo para registrar proveedores
    public function ProveedorStore(Request $request)
    {
        // verificams los datos recibidos
        // dd($request->all());

        // validamos los datos 
        $request->validate([
            'nombre_proveedor' => 'required',
            'codigo_proveedor' => 'required|unique:proveedores,codigo_proveedor',
            'telefono_proveedor' => 'required|unique:proveedores,telefono_proveedor',
            'email_proveedor' => 'required|unique:proveedores,email_proveedor',
            'proveedor_creado_por' => 'required',
            'pais_proveedor' => 'required',
            'estado_proveedor' => 'required',
            'direccion_proveedor' => 'required',
            'descripcion_proveedor' => 'required',
            'imagen' => 'required'
        ]);

        Proveedor::create([
            'nombre_proveedor' => $request->nombre_proveedor,
            'codigo_proveedor' => $request->codigo_proveedor,
            'telefono_proveedor' => $request->telefono_proveedor,
            'email_proveedor' => $request->email_proveedor,
            'proveedor_creado_por' => $request->proveedor_creado_por,
            'pais_proveedor' => $request->pais_proveedor,
            'estado_proveedor' => $request->estado_proveedor,
            'direccion_proveedor' => $request->direccion_proveedor,
            'descripcion_proveedor' => $request->descripcion_proveedor,
            'imagen_proveedor' => $request->imagen
        ]);

        return back()->with('success', 'Proveedor registrador con éxito');
    }

    // Metodo para direccionar a la vista de editar proveedor
    public function editarProveedor($id)
    {
        $proveedor = Proveedor::findOrFail($id);

        return view('update.proveedoresUpdate', compact('proveedor'));
    }

    // Metodo para editar proveedor
    public function ProveedorUpdate(Request $request, $id)
    {
        // verificams los datos recibidos
        // dd($request->all());

        // validamos los datos 
        $request->validate([
            'nombre_proveedor' => 'required',
            'codigo_proveedor' => 'required|unique:proveedores,codigo_proveedor',
            'telefono_proveedor' => 'required|unique:proveedores,telefono_proveedor',
            'email_proveedor' => 'required|unique:proveedores,email_proveedor',
            'proveedor_creado_por' => 'required',
            'pais_proveedor' => 'required',
            'estado_proveedor' => 'required',
            'direccion_proveedor' => 'required',
            'descripcion_proveedor' => 'required'
        ]);

        $proveedor = Proveedor::findOrFail($id);

        // Verificamos si se cargó una nueva imagen
        if ($request->imagen != null) {

            // Eliminamos la imagen anterior de la carpeta uploads
            File::delete(public_path('proveedores') . '/' . $proveedor->imagen_proveedor);

            // Guardamos el nombre de la nueva imagen en el modelo de la proveedor
            $proveedor->imagen_proveedor = $request->imagen;
        }

        // Actualizamos los campos de la proveedor
        $proveedor->nombre_proveedor = $request->input('nombre_proveedor');
        $proveedor->codigo_proveedor = $request->input('codigo_proveedor');
        $proveedor->telefono_proveedor = $request->input('telefono_proveedor');
        $proveedor->email_proveedor = $request->input('email_proveedor');
        $proveedor->proveedor_creado_por = $request->input('proveedor_creado_por');
        $proveedor->pais_proveedor = $request->input('pais_proveedor');
        $proveedor->estado_proveedor = $request->input('estado_proveedor');
        $proveedor->direccion_proveedor = $request->input('direccion_proveedor');
        $proveedor->descripcion_proveedor = $request->input('descripcion_proveedor');

        // Guardamos los cambios en la base de datos
        $proveedor->save();

        return back()->with('success', 'Proveedor actualizado con éxito');
    }

    // Metodo para eliminar proveedor
    public function ProveedorDestroy($id)
    {
        try {
            $proveedor = Proveedor::findOrFail($id);

            // Verificamos si el proveedor no tiene compras asociadas
            if ($proveedor->compras->isEmpty()) {
                // Si no hay compras asociadas, eliminamos al proveedor de la base de datos y la imagen de la carpeta proveedores
                if ($proveedor->delete()) {
                    File::delete(public_path('proveedores') . '/' . $proveedor->imagen_proveedor);
                }
                return back()->with('success', 'Proveedor eliminado con éxito');
            } else {
                return back()->with('warning', 'No se puede eliminar el proveedor porque tiene compras asociadas');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al eliminar el proveedor');
        }
    }
}
