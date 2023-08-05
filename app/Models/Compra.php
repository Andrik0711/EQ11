<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = "compras";

    protected $fillable = [
        'compra_id_producto',
        'compra_id_usuario',
        'compra_cantidad_producto',
        'compra_precio_total'
    ];

    // Relacion donde una compra pertenece a un producto
    // public function producto()
    // {
    //     return $this->belongsTo(Producto::class, 'compra_id_producto');
    // }

    // Relacion donde una compra pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'compra_id_usuario');
    }

    // Si los productos se agregan antes al carrito, se puede hacer una relación de muchos a muchos
    // public function carrito()
    // {
    //     return $this->belongsToMany(Carrito::class);
    // }
}
