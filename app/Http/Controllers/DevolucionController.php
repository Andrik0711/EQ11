<?php

namespace App\Http\Controllers;

use App\Models\Devolucion;
use Illuminate\Http\Request;

class DevolucionController extends Controller
{
    // Funcion para mostrar la tabla de devoluciones
    public function mostrarDevoluciones()
    {
        // Mostramos todas las devoluciones
        $devoluciones = Devolucion::all();
        return view('tables.devolucionesTable', compact('devoluciones'));
    }

    // Funcion para guardar una devolucion
    public function guardarDevolucion(Request $request)
    {

        try {
            // dd($request->all());
            // Validamos los datos
            $request->validate([
                'venta_id' => 'required|unique:devoluciones,venta_id',
                'motivo' => 'required',
                'status' => '',
            ]);

            // Guardamos la devolucion
            Devolucion::create([
                'venta_id' => $request->venta_id,
                'motivo' => $request->motivo,
                'status' => $request->status,
            ]);

            // Redireccionamos a la tabla de devoluciones
            return back()->with('success', 'La devolución fue generada correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', 'La devolución no pudo ser generada correctamente');
        }
    }

    // Funcion para actualizar el estatus de una devolucion
    public function actualizarEstadoDevolucion(Request $request, $id)
    {

        // dd($request->all(), $id);

        // Validamos los datos
        $request->validate([
            'status' => 'required',
        ]);

        try {
            // Buscamos la devolucion
            $devolucion = Devolucion::find($id);

            // Actualizamos el estatus de la devolucion
            $devolucion->status = $request->status;

            // Guardamos la devolucion
            $devolucion->save();

            // Redireccionamos a la tabla de devoluciones
            return back()->with('success', 'El estado de la devolución fue actualizada correctamente');
        } catch (\Throwable $th) {
            return back()->with('error', 'El estado de la devolución no pudo ser actualizada correctamente');
        }
    }


    // Funcion para eliminar una devolucion
    public function eliminarDevolucion($id)
    {
        // Buscamos la devolucion
        $devolucion = Devolucion::find($id);

        // Eliminamos la devolucion
        $devolucion->delete();

        // Redireccionamos a la tabla de devoluciones
        return back()->with('success', 'La devolución fue eliminada correctamente');
    }
}
