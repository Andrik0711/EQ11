<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraProducto extends Model
{
    use HasFactory;

    protected $table = "compras_de_productos";

    protected $fillable = [
        'id_compra',
        'producto_id', // Asegúrate de que este campo se llame 'producto_id'
        'cantidad_comprada',
        'precio_unitario',
        'subtotal',
        // Aquí puedes agregar otros campos específicos de la tabla pivot, si los tienes.
    ];

    // Relación con el modelo Compra
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');
    }

    // Relación con el modelo Producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id'); // Asegúrate de usar 'producto_id' aquí
    }
}
