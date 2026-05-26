<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\NotaVentaController;
use App\Http\Controllers\OrdenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Redirección de la raíz al login (Limpieza de la portada de Laravel)
Route::redirect('/', '/login');

// 2. Grupo de rutas protegidas globales (El usuario debe iniciar sesión)
Route::middleware(['auth'])->group(function () {
    
    // Vista del Dashboard principal para todos los usuarios logeados
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ---------------------------------------------------------------------
    // MÓDULO BITÁCORA: Solo el Administrador (tipoSupervisor = 1)
    // ---------------------------------------------------------------------
    Route::middleware(['role:supervisor'])->group(function () {
        Route::get('/bitacora', [BitacoraController::class, 'index'])->name('bitacora.index');
    });

    // ---------------------------------------------------------------------
    // MÓDULO VENTAS: Administradores y Vendedores (tipoSupervisor o tipoAssesor = 1)
    // ---------------------------------------------------------------------
    Route::middleware(['role:supervisor,vendedor'])->group(function () {
        Route::get('/ventas', [NotaVentaController::class, 'index'])->name('ventas.index');
    });

    // ---------------------------------------------------------------------
    // MÓDULO SERVICIO TÉCNICO: Administradores y Técnicos (tipoSupervisor o tipoTecnico = 1)
    // ---------------------------------------------------------------------
    Route::middleware(['role:supervisor,tecnico'])->group(function () {
        Route::get('/ordenes', [OrdenController::class, 'index'])->name('ordenes.index');
    });
});

// 3. Carga automática de las rutas de autenticación de Livewire/Volt (login, logout, etc.)
require __DIR__.'/auth.php';