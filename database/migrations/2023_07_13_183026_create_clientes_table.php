<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_cliente');
            $table->string('codigo_cliente');
            $table->string('telefono_cliente');
            $table->string('email_cliente');
            $table->string('empresa_cliente');
            $table->string('cliente_creado_por');
            $table->string('pais_cliente');
            $table->string('estado_cliente');
            $table->string('direccion_cliente');
            $table->string('descripcion_cliente');
            $table->string('imagen_cliente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
