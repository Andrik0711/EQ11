<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class CRUDClientesController extends Controller
{
    // Metodo para direccionar al formulario de registrar cliente
    public function registrarCliente()
    {
        return view('forms.clienteForm');
    }

    // Metodo para almacenar la imagen 
    public function ClienteImageStore(Request $request)
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
        $imagenPath = public_path('clientes') . '/' . $nombreImagen;

        //pasamos la imagen de memoria al server
        $imagenServidor->save($imagenPath);

        ///verificamos que el nombre del archivo se ponga como unico
        return response()->json(['imagen' => $nombreImagen]);
    }


    // Metodo para mostrar los clientes registrado
    public function mostrarClientes()
    {
        $clientes = Cliente::all();

        return view('tables.clienteTable', compact('clientes'));
    }

    // Metodo para registrar cliente
    public function ClienteStore(Request $request)
    {
        // verificams los datos recibidos
        // dd($request->all());

        // validamos los datos 
        $request->validate([
            'nombre_cliente' => 'required',
            'codigo_cliente' => 'required|unique:clientes,codigo_cliente',
            'telefono_cliente' => 'required|unique:clientes,telefono_cliente',
            'email_cliente' => 'required|unique:clientes,email_cliente',
            'empresa_cliente' => 'required',
            'cliente_creado_por' => 'required',
            'pais_cliente' => 'required',
            'estado_cliente' => 'required',
            'direccion_cliente' => 'required',
            'descripcion_cliente' => 'required',
            'imagen' => 'required'
        ]);

        // Creamos al cliente
        Cliente::create([
            'nombre_cliente' => $request->nombre_cliente,
            'codigo_cliente' => $request->codigo_cliente,
            'telefono_cliente' => $request->telefono_cliente,
            'email_cliente' => $request->email_cliente,
            'empresa_cliente' => $request->empresa_cliente,
            'cliente_creado_por' => $request->cliente_creado_por,
            'pais_cliente' => $request->pais_cliente,
            'estado_cliente' => $request->estado_cliente,
            'direccion_cliente' => $request->direccion_cliente,
            'descripcion_cliente' => $request->descripcion_cliente,
            'imagen_cliente' => $request->imagen
        ]);

        return back()->with('success', 'Cliente registrador con éxito');
    }

    // Metodo para direccionar a la vista de editar cliente
    public function editarCliente($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view('update.clienteUpdate', compact('cliente'));
    }

    // Metodo para editar cliente
    public function ClienteUpdate(Request $request, $id)
    {
        // verificams los datos recibidos
        // dd($request->all());

        // validamos los datos 
        $request->validate([
            'nombre_cliente' => 'required',
            'codigo_cliente' => 'required',
            'telefono_cliente' => 'required',
            'email_cliente' => 'required',
            'empresa_cliente' => 'required',
            'cliente_creado_por' => 'required',
            'pais_cliente' => 'required',
            'estado_cliente' => 'required',
            'direccion_cliente' => 'required',
            'descripcion_cliente' => 'required'
        ]);

        $cliente = Cliente::findOrFail($id);

        // Verificamos si se cargó una nueva imagen
        if ($request->imagen != null) {

            // Eliminamos la imagen anterior de la carpeta uploads
            File::delete(public_path('clientes') . '/' . $cliente->imagen_cliente);

            // Guardamos el nombre de la nueva imagen en el modelo de la cliente
            $cliente->imagen_cliente = $request->imagen;
        }

        // Actualizamos los campos de la cliente
        $cliente->nombre_cliente = $request->input('nombre_cliente');
        $cliente->codigo_cliente = $request->input('codigo_cliente');
        $cliente->telefono_cliente = $request->input('telefono_cliente');
        $cliente->email_cliente = $request->input('email_cliente');
        $cliente->empresa_cliente = $request->input('empresa_cliente');
        $cliente->cliente_creado_por = $request->input('cliente_creado_por');
        $cliente->pais_cliente = $request->input('pais_cliente');
        $cliente->estado_cliente = $request->input('estado_cliente');
        $cliente->direccion_cliente = $request->input('direccion_cliente');
        $cliente->descripcion_cliente = $request->input('descripcion_cliente');

        // Guardamos los cambios en la base de datos
        $cliente->save();

        return back()->with('success', 'Cliente actualizado con éxito');
    }

    // Metodo para eliminar cliente
    public function ClienteDestroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);

            // Verificar si el cliente tiene ventas realizadas
            if ($cliente->ventas->isEmpty()) {
                // Si no hay ventas asociadas, procede a eliminar al cliente
                if ($cliente->delete()) {
                    File::delete(public_path('clientes') . '/' . $cliente->imagen_cliente);
                }
                return back()->with('success', 'Cliente eliminado con éxito');
            } else {
                // Si hay ventas asociadas, muestra un mensaje de error
                return back()->with('error', 'No se puede eliminar el cliente porque tiene ventas realizadas.');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrió un error al intentar eliminar el cliente.');
        }
    }
}
