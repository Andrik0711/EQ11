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
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_compra');
            $table->foreignId('proveedor_id')->constrained('proveedores');
            $table->string('referencia');
            $table->string('descripcion');
            $table->string('compra_status');
            // $table->decimal('compra_abono', 10, 2);
            $table->decimal('compra_subtotal', 10, 2);
            $table->decimal('compra_impuestos', 10, 2);
            $table->decimal('compra_total', 10, 2);
            $table->integer('compra_productos_comprados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
