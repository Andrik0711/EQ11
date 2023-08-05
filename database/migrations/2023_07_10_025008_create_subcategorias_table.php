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
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->id();
            // llave foranea a la tabla categorias
            $table->foreignId('categoria_subcategoria')->constrained('categorias');
            $table->string('codigo_subcategoria');
            $table->string('nombre_subcategoria');
            $table->string('descripcion_subcategoria');
            $table->string('subcategoria_creada_por');
            $table->string('imagen_subcategoria');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategorias');
    }
};
