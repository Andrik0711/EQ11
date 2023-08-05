<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = "carrito";

    protected $fillable = [
        'carrito_id_producto',
        'carrito_id_usuario',
        'carrito_cantidad_producto'
    ];

    // Relacion donde un carrito pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'carrito_id_producto');
    }

    // Relacion donde un carrito pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'carrito_id_usuario');
    }
}
