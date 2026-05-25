<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermisoSeeder::class, // 1. Primero se crean los permisos bases
            RolSeeder::class,     // 2. Se crean los roles y se vinculan a los permisos
            UsuarioSeeder::class, // 3. Finalmente se crean los usuarios del sistema
        ]);
    }
}