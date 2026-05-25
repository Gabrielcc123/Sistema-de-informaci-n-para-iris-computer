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
        Schema::create('notaVenta', function (Blueprint $table) {
            // Configuraciones de caracteres exigidas
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            // Estructura de columnas
            $table->integer('nroNotaVenta')->autoIncrement(); // PK explícita NOT NULL
            $table->integer('idCliente')->nullable(false);
            $table->integer('idPago')->nullable(false);
            $table->integer('idAssesor')->nullable(false); // FK apuntando a idUsuario del asesor
            $table->date('fecha')->nullable(false);
            $table->decimal('total', 10, 2)->default(0.00)->nullable(false);

            // Definición explícita de Claves Foráneas con Cascada Total
            $table->foreign('idCliente')
                    ->references('idCliente')
                    ->on('cliente')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('idPago')
                    ->references('idPago')
                    ->on('pago')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->foreign('idAssesor')
                    ->references('idUsuario')
                    ->on('usuario')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            // Timestamps activos para auditoría financiera y contable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notaVenta');
    }
};
