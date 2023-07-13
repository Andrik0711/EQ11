<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marcas';

    protected $fillable = [
        'imagen_marca',
        'nombre_marca',
        'descripcion_marca',
        'marca_creada_por'
    ];
}
