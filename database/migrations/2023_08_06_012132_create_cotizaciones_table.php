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
        Schema::create('cotizaciones', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_cotizacion');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->string('referencia');
            $table->string('status');
            $table->text('descripcion_cotizacion');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('impuestos', 10, 2);
            $table->decimal('total', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cotizaciones');
    }
};
