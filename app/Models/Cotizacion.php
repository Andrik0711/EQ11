<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    protected $table = "cotizaciones";

    protected $fillable = [
        'fecha_cotizacion',
        'cliente_id',
        'referencia',
        'status',
        'descripcion_cotizacion',
        'subtotal',
        'impuestos',
        'total',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'cotizacion_productos', 'cotizacion_id', 'producto_id')
            ->withPivot('cantidad', 'precio_unitario', 'subtotal');
    }
}
