<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario 1: Administrador
        Usuario::firstOrCreate(
            ['email' => 'admin@iris.com'], // <-- Condición de búsqueda por email
            [
                'nombre' => 'Admin', 
                'apellido' => 'Principal',
                'password' => Hash::make('password'),
                'telefono' => '70000001',
                'estado' => 1,
                'tipoAssesor' => 1,
                'tipoSupervisor' => 1,
                'tipoTecnico' => 1,
            ]
        );

        // Usuario 2: Vendedor
        Usuario::firstOrCreate(
            ['email' => 'vendedor@iris.com'], // <-- Condición de búsqueda por email
            [
                'nombre' => 'Juan', 
                'apellido' => 'Vendedor',
                'password' => Hash::make('password'),
                'telefono' => '70000002',
                'estado' => 1,
                'tipoAssesor' => 1,
                'tipoSupervisor' => 0,
                'tipoTecnico' => 0,
            ]
        );

        // Usuario 3: Técnico
        Usuario::firstOrCreate(
            ['email' => 'tecnico@iris.com'], // <-- Condición de búsqueda por email
            [
                'nombre' => 'Carlos', 
                'apellido' => 'Técnico',
                'password' => Hash::make('password'),
                'telefono' => '70000003',
                'estado' => 1,
                'tipoAssesor' => 0,
                'tipoSupervisor' => 0,
                'tipoTecnico' => 1,
            ]
        );
    }
}