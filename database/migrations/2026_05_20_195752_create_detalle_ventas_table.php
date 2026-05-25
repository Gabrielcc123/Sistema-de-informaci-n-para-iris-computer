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
        Schema::create('detalleVenta', function (Blueprint $table) {
            // Configuraciones de caracteres exigidas
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            // Columnas base para la PK compuesta
            $table->integer('idNotaVenta')->nullable(false);
            $table->integer('idProductoServicio')->nullable(false);
            
            // Atributos propios del renglón de venta
            $table->integer('cantidad')->nullable(false);
            $table->decimal('precioUnitario', 10, 2)->nullable(false);
            $table->decimal('subTotal', 10, 2)->nullable(false);

            // Definición explícita de la Clave Primaria Compuesta (Garantiza NOT NULL)
            $table->primary(['idNotaVenta', 'idProductoServicio']);

            // Restricciones de Integridad Referencial con Cascada Total
            $table->foreign('idNotaVenta')
                    ->references('nroNotaVenta')
                    ->on('notaVenta')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('idProductoServicio')
                    ->references('idProductoServicio')
                    ->on('productoServicio')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            // No lleva timestamps por diseño de normalización transaccional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleVenta');
    }
};
