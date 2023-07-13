<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class CRUDProveedoresController extends Controller
{
    // Metodo que manda a la vista de registrar proveedor
    public function registrarProveedor()
    {
        return view('forms.proveedoresForm');
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
            'codigo_proveedor' => 'required',
            'telefono_proveedor' => 'required',
            'email_proveedor' => 'required',
            'proveedor_creado_por' => 'required'
        ]);

        Proveedor::create([
            'nombre_proveedor' => $request->nombre_proveedor,
            'codigo_proveedor' => $request->codigo_proveedor,
            'telefono_proveedor' => $request->telefono_proveedor,
            'email_proveedor' => $request->email_proveedor,
            'proveedor_creado_por' => $request->proveedor_creado_por
        ]);

        return back()->with('mensaje', 'Proveedor registrador con exito');
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
            'codigo_proveedor' => 'required',
            'telefono_proveedor' => 'required',
            'email_proveedor' => 'required',
            'proveedor_creado_por' => 'required'
        ]);

        $proveedor = Proveedor::findOrFail($id);

        $proveedor->update([
            'nombre_proveedor' => $request->nombre_proveedor,
            'codigo_proveedor' => $request->codigo_proveedor,
            'telefono_proveedor' => $request->telefono_proveedor,
            'email_proveedor' => $request->email_proveedor,
            'proveedor_creado_por' => $request->proveedor_creado_por
        ]);

        return back()->with('mensaje', 'Proveedor actualizado con exito');
    }

    // Metodo para eliminar proveedor
    public function ProveedorDestroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $proveedor->delete();

        return back()->with('mensaje', 'Proveedor eliminado con exito');
    }
}
