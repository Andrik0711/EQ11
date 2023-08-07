<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionProducto extends Model
{
    use HasFactory;

    protected $table = 'cotizacion_productos'; // Nombre de la tabla intermedia

    protected $fillable = [
        'cotizacion_id',
        'producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal'
    ];

    // Relación uno a muchos inversa
    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class, 'cotizacion_id');
    }

    // Relación uno a muchos inversa
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
