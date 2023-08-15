<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    protected $table = "devoluciones";

    protected $fillable = [
        'venta_id',
        'producto_id',
        'cantidad_devuelta',
        'fecha_devolucion',
        'motivo_devolucion'
    ];

    // Relacion donde una devolucion pertenece a una venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
