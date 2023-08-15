<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaProducto extends Model
{
    use HasFactory;

    protected $table = "ventas_de_productos";

    protected $fillable = [
        'id_venta',
        'producto_id', // Debe ser 'producto_id' para que funcione la relación
        'cantidad_vendida',
        'producto_status',
        'precio_unitario',
        'subtotal',
    ];

    // Relación con el modelo Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id'); // Debe ser 'producto_id' para que funcione la relación
    }

    // Funcion para realizar una devolucion de un producto
    public function realizarDevolucionProducto()
    {
        // Actualiza el estado del producto a "devuelto"
        $this->update(['producto_status' => true]);

        // Incrementa las unidades disponibles del producto
        $this->producto->increment('unidades_disponibles', $this->cantidad_vendida);

        return true;
    }
}
