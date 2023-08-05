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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_venta');
            $table->foreignId('cliente_id')->constrained('clientes');
            $table->string('venta_status');
            $table->decimal('venta_abono', 10, 2);
            $table->decimal('venta_subtotal', 10, 2);
            $table->decimal('venta_impuestos', 10, 2);
            $table->decimal('venta_total', 10, 2);
            $table->integer('venta_unidades_vendidas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
