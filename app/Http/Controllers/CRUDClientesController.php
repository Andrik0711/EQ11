<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class CRUDClientesController extends Controller
{
    // Metodo para direccionar al formulario de registrar cliente
    public function registrarCliente()
    {
        return view('forms.clienteForm');
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
            'codigo_cliente' => 'required',
            'telefono_cliente' => 'required',
            'email_cliente' => 'required',
            'empresa_cliente' => 'required',
            'cliente_creado_por' => 'required'
        ]);

        Cliente::create([
            'nombre_cliente' => $request->nombre_cliente,
            'codigo_cliente' => $request->codigo_cliente,
            'telefono_cliente' => $request->telefono_cliente,
            'email_cliente' => $request->email_cliente,
            'empresa_cliente' => $request->empresa_cliente,
            'cliente_creado_por' => $request->cliente_creado_por
        ]);

        return back()->with('mensaje', 'Cliente registrador con exito');
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
            'cliente_creado_por' => 'required'
        ]);

        $cliente = Cliente::findOrFail($id);

        $cliente->update([
            'nombre_cliente' => $request->nombre_cliente,
            'codigo_cliente' => $request->codigo_cliente,
            'telefono_cliente' => $request->telefono_cliente,
            'email_cliente' => $request->email_cliente,
            'empresa_cliente' => $request->empresa_cliente,
            'cliente_creado_por' => $request->cliente_creado_por
        ]);

        return back()->with('mensaje', 'Cliente actualizado con exito');
    }

    // Metodo para eliminar cliente
    public function ClienteDestroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        $cliente->delete();

        return back()->with('mensaje', 'Cliente eliminado con exito');
    }
}
