<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $table = 'subcategorias';

    protected $fillable = [
        'categoria_subcategoria',
        'codigo_subcategoria',
        'nombre_subcategoria',
        'descripcion_subcategoria',
        'subcategoria_creada_por',
        'imagen_subcategoria'
    ];

    // Relacion donde una subcategoria pertenece a una categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_subcategoria');
    }
}
