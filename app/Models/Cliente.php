<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clientes";

    protected $fillable = [
        'nombre_cliente',
        'codigo_cliente',
        'telefono_cliente',
        'email_cliente',
        'empresa_cliente',
        'cliente_creado_por',
        'imagen_cliente'
    ];
}
