<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = "ventas";

    protected $fillable = [
        'fecha_venta',
        'cliente_id',
        'venta_status',
        'venta_abono',
        'venta_subtotal',
        'venta_impuestos',
        'venta_total',
        'venta_unidades_vendidas',
    ];

    // Relacion donde una venta pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    // Relacion donde una venta puede tener muchos productos
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'ventas_de_productos', 'venta_id', 'producto_id')->withPivot('cantidad_vendida', 'precio_unitario', 'subtotal');
    }

    // Funcion para realizar una devolucion total de una venta
    public function realizarDevolucionCompleta()
    {
        $devolucion = new Devolucion([
            'venta_id' => $this->id,
            'fecha_devolucion' => now(),
            // Otros campos necesarios para la devolución
        ]);

        $devolucion->save();

        // Eliminar la venta y las relaciones con productos
        $this->productos()->detach();
        $this->delete();

        return $devolucion;
    }

    public function realizarDevolucionProducto($producto_id, $cantidadDevuelta)
    {
        $producto = $this->productos()->findOrFail($producto_id);
        if ($cantidadDevuelta <= 0 || $cantidadDevuelta > $producto->pivot->cantidad_vendida) {
            return false;
        }

        $cantidad_restante = $producto->pivot->cantidad_vendida - $cantidadDevuelta;
        $producto->pivot->cantidad_vendida = $cantidad_restante;
        $producto->pivot->save();

        $devolucion = new Devolucion([
            'venta_id' => $this->id,
            'producto_id' => $producto_id,
            'cantidad_devuelta' => $cantidadDevuelta,
            'fecha_devolucion' => now(),
            'motivo_devolucion' => 'Sin motivo',
        ]);

        $devolucion->save();

        return $devolucion;
    }
}
