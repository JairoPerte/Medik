<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\Centro_MedicoController;
use App\Http\Controllers\TwilioController;

use App\Models\Cita_Medica;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\CitaMedicaController;
use App\Http\Controllers\DoctorController;

Route::get('/', function () {
    return auth()->guard("sanctum")->check() ? redirect('/dashboard') : view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    /**
     * PONER AQUÍ LAS RUTAS QUE PUEDEN ACCEDER TODOS
     *
     * POR EJEMPLO:
     *
     * Route::get('/dashboard', function () {
     *   return "Hola";
     * })->name('dashboard');
     */

    Route::get('/dashboard', function () {
        $citas = Cita_Medica::all();
        return view('dashboard', compact('citas'));
    })->name('dashboard');

    // Rutas de Consultas accesibles para todos los usuarios
    Route::prefix('consultas')->group(function () {
        Route::get('/{consulta}', [ConsultaController::class, 'show'])->name('consultas.show');
        Route::get('/', [ConsultaController::class, 'index'])->name('consultas.index');
        Route::get('/create', [ConsultaController::class, 'create'])->name('consultas.create');
        Route::post('/', [ConsultaController::class, 'store'])->name('consultas.store');
    });
    Route::prefix('doctores')->group(function () {
        Route::get('/{doctor}', [DoctorController::class, 'show'])->name('doctores.show');
        Route::get('/', [DoctorController::class, 'index'])->name('doctores.index');
        Route::get('/create', [DoctorController::class, 'create'])->name('doctores.create');
        Route::post('/', [DoctorController::class, 'store'])->name('doctores.store');
    });

    // Rutas de Recetas accesibles para todos los usuarios
    Route::prefix('recetas')->group(function () {
        Route::get('/', [RecetaController::class, 'index'])->name('recetas.index');
        Route::get('/create', [RecetaController::class, 'create'])->name('recetas.create');
        Route::post('/', [RecetaController::class, 'store'])->name('recetas.store');
        Route::get('/{receta}', [RecetaController::class, 'show'])->name('recetas.show');
    });

    // Rutas de Citas Médicas accesibles para todos los usuarios
    Route::prefix('citas')->group(function () {
        Route::get('/', [CitaMedicaController::class, 'index'])->name('citas.index');
        Route::get('/create', [CitaMedicaController::class, 'create'])->name('citas.create');
        Route::post('/', [CitaMedicaController::class, 'store'])->name('citas.store');
        Route::get('/{citaMedica}', [CitaMedicaController::class, 'show'])->name('citas.show');
    });
    
    // Rutas para Historial de Citas
    Route::get('/historial-citas', [CitaMedicaController::class, 'index'])->name('historial.citas');
});

Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::get('/admin/create', [])->name('admin.create');
    Route::post('/admin', [])->name('admin.store');
    /**
     * PONER AQUÍ LAS RUTAS QUE SOLO PUEDEN ACCEDER LOS ADMINISTRADORES (ADMIN)
     *
     * POR EJEMPLO:
     *
     * Route::get('/admin/dashboard', function () {
     *   return "Hola";
     * })->name('admin.dashboard');
     */

    // Rutas de Consultas accesibles solo para los administradores
    Route::prefix('consultas')->group(function () {
        // Route::get('/create', [ConsultaController::class, 'create'])->name('consultas.create');
        // Route::post('/', [ConsultaController::class, 'store'])->name('consultas.store');
        Route::get('/{consulta}/edit', [ConsultaController::class, 'edit'])->name('consultas.edit');
        Route::put('/{consulta}', [ConsultaController::class, 'update'])->name('consultas.update');
        Route::delete('/{consulta}', [ConsultaController::class, 'destroy'])->name('consultas.destroy');
    });
    Route::prefix('doctores')->group(function () {
        Route::get('/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctores.edit');
        Route::put('/{doctor}', [DoctorController::class, 'update'])->name('doctores.update');
        Route::delete('/{doctor}', [DoctorController::class, 'destroy'])->name('doctores.destroy');
    });
    Route::get('/citas/create', [CitaMedicaController::class, 'create'])->name('citas.create');
    Route::post('/citas', [CitaMedicaController::class, 'store'])->name('citas.store');

    // Rutas de Medicamentos accesibles solo para los administradores
    Route::prefix('medicamentos')->group(function () {
        Route::get('/', [MedicamentoController::class, 'index'])->name('medicamentos.index');
        Route::get('/create', [MedicamentoController::class, 'create'])->name('medicamentos.create');
        Route::post('/', [MedicamentoController::class, 'store'])->name('medicamentos.store');
        Route::get('/{medicamento}/edit', [MedicamentoController::class, 'edit'])->name('medicamentos.edit');
        Route::put('/{medicamento}', [MedicamentoController::class, 'update'])->name('medicamentos.update');
        Route::delete('/{medicamento}', [MedicamentoController::class, 'destroy'])->name('medicamentos.destroy');
    });

    // Rutas de Recetas accesibles solo para los administradores
    Route::prefix('recetas')->group(function () {
        // Route::get('/create', [RecetaController::class, 'create'])->name('recetas.create');
        // Route::post('/', [RecetaController::class, 'store'])->name('recetas.store');
        Route::get('/{receta}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
        Route::put('/{receta}', [RecetaController::class, 'update'])->name('recetas.update');
        Route::delete('/{receta}', [RecetaController::class, 'destroy'])->name('recetas.destroy');
    });
});

Route::middleware(['auth:web', 'verified'])->group(function () {
    /**
     * PONER AQUÍ LAS RUTAS QUE SOLO PUEDEN ACCEDER LOS USUARIOS (WEB)
     *
     * POR EJEMPLO:
     *
     * Route::get('/web/dashboard', function () {
     *   return "Hola";
     * })->name('web.dashboard');
     */
    Route::post('/send-sms', [TwilioController::class, 'sendSmsToUser'])->name('send.sms');
});
