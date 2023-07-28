<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = [
        'nombre_proveedor',
        'codigo_proveedor',
        'telefono_proveedor',
        'email_proveedor',
        'proveedor_creado_por',
        'pais_proveedor',
        'estado_proveedor',
        'direccion_proveedor',
        'descripcion_proveedor',
        'imagen_proveedor'
    ];
}
