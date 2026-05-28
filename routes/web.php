<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt; // <-- IMPORTANTE: Asegurar que Volt esté importado arriba
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\NotaVentaController;
use App\Http\Controllers\OrdenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. Redirección de la raíz al login
Route::redirect('/', '/login');

// 2. Grupo de rutas protegidas globales (El usuario debe estar logeado)
Route::middleware(['auth'])->group(function () {
    
    // Vista del Dashboard principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ---------------------------------------------------------------------
    // 🛠️ RUTAS DE CONFIGURACIÓN DE PERFIL (Restauradas del Starter Kit)
    // ---------------------------------------------------------------------
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // ---------------------------------------------------------------------
// ---------------------------------------------------------------------
    // 📊 MÓDULO BITÁCORA: Solo el Administrador (tipoSupervisor = 1)
    // ---------------------------------------------------------------------
    Route::middleware(['role:supervisor'])->group(function () {
        // Quitamos el BitacoraController y usamos Volt directamente
        Volt::route('/bitacora', 'bitacora.index')->name('bitacora.index');
    });

    // ---------------------------------------------------------------------
    // 💰 MÓDULO VENTAS: Administradores y Vendedores
    // ---------------------------------------------------------------------
    Route::middleware(['role:supervisor,vendedor'])->group(function () {
        Route::get('/ventas', [NotaVentaController::class, 'index'])->name('ventas.index');
    });

    // ---------------------------------------------------------------------
    // 🖥️ MÓDULO SERVICIO TÉCNICO: Administradores y Técnicos
    // ---------------------------------------------------------------------
    Route::middleware(['role:supervisor,tecnico'])->group(function () {
        Route::get('/ordenes', [OrdenController::class, 'index'])->name('ordenes.index');
    });
});

// 3. Carga de las rutas de autenticación de Livewire/Volt
require __DIR__.'/auth.php';