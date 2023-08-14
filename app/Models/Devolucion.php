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
        'motivo',
        'status',
    ];

    // Relacion donde una devolucion pertenece a una venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }
}
