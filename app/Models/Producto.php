<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";

    protected $fillable = [
        'id_categoria_producto',
        'id_subcategoria_producto',
        'nombre_producto',
        'descripcion_producto',
        'precio_de_compra',
        'precio_de_venta',
        'unidades_disponibles',
        'producto_creado_por',
        'imagen_producto'
    ];

    // Relacion donde un producto pertenece a una categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria_producto');
    }

    // Relacion donde un producto pertenece a una subcategoria
    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'id_subcategoria_producto');
    }
}
