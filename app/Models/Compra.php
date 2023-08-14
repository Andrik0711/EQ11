<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = "compras";

    protected $fillable = [
        'fecha_compra',
        'proveedor_id',
        'referencia',
        'descripcion',
        'compra_status',
        'compra_subtotal',
        'compra_impuestos',
        'compra_total',
        'compra_productos_comprados',
    ];

    // Relacion donde una compra pertenece a un proveedor
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    // Relacion donde una compra puede tener muchos productos
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'compras_de_productos', 'compra_id', 'producto_id')->withPivot('cantidad_comprada', 'precio_unitario', 'subtotal');
    }
}
