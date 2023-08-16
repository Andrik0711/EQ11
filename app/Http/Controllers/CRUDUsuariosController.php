<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CRUDUsuariosController extends Controller
{
    // Metodo para direccionar al formulario de registrar usuario
    public function registrarUsuario()
    {
        return view('forms.usuariosForm');
    }

    // Metodo para almacenar la imagen 
    public function UsuarioImageStore(Request $request)
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
        $imagenPath = public_path('usuarios') . '/' . $nombreImagen;

        //pasamos la imagen de memoria al server
        $imagenServidor->save($imagenPath);

        ///verificamos que el nombre del archivo se ponga como unico
        return response()->json(['imagen' => $nombreImagen]);
    }


    // Metodo para mostrar los usuarios registrados
    public function mostrarUsuarios()
    {
        $users = Usuario::all();

        return view('tables.usuariosTable', compact('users'));
    }

    // Metodo para registrar usuarios
    public function UsuarioStore(Request $request)
    {
        // verificams los datos recibidos
        // dd($request->all());

        // validamos los datos 
        $request->validate([
            'name' => 'required',
            'apellido' => 'required',
            'username' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'password' => 'required',
            //'rol' => '',
            'imagen' => 'required',
        ]);

        // Creamos al usuario
        Usuario::create([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'username' => $request->username,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => $request->password,
            //'rol' => $request->rol,
            'imagen_usuario' => $request->imagen,
        ]);

        return back()->with('success', 'Usuario registrado con exito');
    }

    // Metodo para direccionar a la vista de editar usuarios
    public function editarUsuario($id)
    {
        $user = Usuario::findOrFail($id);

        return view('update.usuariosUpdate', compact('user'));
    }

    // Metodo para editar usuarios
    public function UsuarioUpdate(Request $request, $id)
    {
        // verificams los datos recibidos
        // dd($request->all());

        // validamos los datos 
        $request->validate([
            'name' => 'required',
            'apellido' => 'required',
            'username' => 'required',
            'telefono' => 'required',
            'email' => 'required|',
            'password' => 'required',
            // 'rol' => 'required',
            'imagen_actual' => '',
            'imagen' => '',
        ]);

        $user = Usuario::findOrFail($id);

        // Verificamos si se cargó una nueva imagen
        if ($request->imagen != null) {

            // Eliminamos la imagen anterior de la carpeta usuarios
            File::delete(public_path('usuarios') . '/' . $user->imagen_usuario);

            // Guardamos el nombre de la nueva imagen en el modelo del usuario
            $user->imagen_usuario = $request->imagen;
        }

        // dd($user->imagen_usuario);


        // Actualizamos los campos del usuario
        $user->name = $request->input('name');
        $user->apellido = $request->input('apellido');
        $user->username = $request->input('username');
        $user->telefono = $request->input('telefono');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        //$user->rol = $request->input('rol');
        // $user->imagen_usuario = $request->input('imagen');


        // Guardamos los cambios en la base de datos
        $user->save();

        return back()->with('success', 'Usuario actualizado con exito');
    }

    // Metodo para eliminar usuario
    public function UsuarioDestroy($id)
    {
        $users = Usuario::findOrFail($id);

        // Eliminar al usuario de la base de datos y la imagen de la carpeta usuarios
        File::delete(public_path('usuarios') . '/' . $users->imagen_usuario);
        $users->delete();

        return back()->with('success', 'Usuario eliminado con exito');
    }
}
