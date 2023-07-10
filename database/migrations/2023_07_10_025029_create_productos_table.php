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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_producto')->constrained('categorias')->onDelete('cascade');
            $table->integer('id_subcategoria_producto');
            $table->string('nombre_producto');
            $table->decimal('precio_de_compra', 8, 2);
            $table->decimal('precio_de_venta', 8, 2);
            $table->integer('unidades_disponibles');
            $table->string('producto_creado_por');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
