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
}
