<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = "categorias";

    protected $fillable = [
        'nombre_categoria',
        'codigo_categoria',
        'descripcion_categoria',
        'categoria_creada_por'
    ];

    // Relacion donde una categoria puede tener muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    // Relacion donde una categoria puede tener muchas subcategorias
    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class);
    }
}
