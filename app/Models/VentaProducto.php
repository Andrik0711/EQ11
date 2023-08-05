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
        'producto_id', // Asegúrate de que este campo se llame 'producto_id'
        'cantidad_vendida',
        'precio_unitario',
        'subtotal',
        // Aquí puedes agregar otros campos específicos de la tabla pivot, si los tienes.
    ];

    // Relación con el modelo Venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id'); // Asegúrate de usar 'producto_id' aquí
    }
}
