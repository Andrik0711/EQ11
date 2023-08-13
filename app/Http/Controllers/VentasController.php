<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\VentaProducto;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    // Muestra la tabla de Ventas realizadas
    public function mostrarVentas()
    {
        $ventas = Venta::all();
        return view('tables.ventasTable', compact('ventas'));
    }

    // Muestra el ticket de la venta realizada
    public function mostrarTicket($id)
    {
        $venta_realizada = Venta::findOrFail($id);
        return view('tickets.ventaTicket', compact('venta_realizada'));
    }

    // Elimina una venta
    public function eliminarVenta($venta_id)
    {
        // Eliminar registros relacionados en ventas_de_productos
        VentaProducto::where('venta_id', $venta_id)->delete();

        // Luego, eliminar la venta
        Venta::destroy($venta_id);

        // return response()->json(['message' => 'La venta ha sido eliminada correctamente.']);
        return redirect()->back()->with('success', 'La venta ha sido eliminada correctamente.');
    }
}
