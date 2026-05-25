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
        Schema::create('usuario', function (Blueprint $table) {
            // Configuraciones de caracteres exigidas
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            // Estructura de columnas
            $table->integer('idUsuario')->autoIncrement(); // PK explícita NOT NULL
            $table->string('nombre', 100)->nullable(false);
            $table->string('apellido', 100)->nullable(false);
            $table->string('password', 255)->nullable(false); // Para hashes seguros como Bcrypt
            $table->string('telefono', 30)->nullable();
            $table->boolean('estado')->default(true)->nullable(false); // 1: Activo, 0: Inactivo

            // Banderas de tipos de usuario (Roles lógicos del negocio)
            $table->boolean('tipoAssesor')->default(false)->nullable(false);
            $table->boolean('tipoSupervisor')->default(false)->nullable(false);
            $table->boolean('tipoTecnico')->default(false)->nullable(false);

            // Auditoría activa para control del personal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
