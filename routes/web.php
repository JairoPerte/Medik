<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\Centro_MedicoController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\CitaMedicaController;

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
        return view('dashboard');
    })->name('dashboard');
    Route::prefix('consultas')->group(function () {
        Route::get('/', [ConsultaController::class, 'index'])->name('consultas.index');
        Route::get('/create', [ConsultaController::class, 'create'])->name('consultas.create'); // ✅ Movida aquí para acceso general
        Route::post('/', [ConsultaController::class, 'store'])->name('consultas.store');
        Route::get('/{consulta}', [ConsultaController::class, 'show'])->name('consultas.show');
    });
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
    Route::prefix('consultas')->group(function () {
        //Route::get('/create', [ConsultaController::class, 'create'])->name('consultas.create');
        //Route::post('/', [ConsultaController::class, 'store'])->name('consultas.store');
        Route::get('/{consulta}/edit', [ConsultaController::class, 'edit'])->name('consultas.edit');
        Route::put('/{consulta}', [ConsultaController::class, 'update'])->name('consultas.update');
        Route::delete('/{consulta}', [ConsultaController::class, 'destroy'])->name('consultas.destroy');
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
});

Route::prefix('centros')->group(function () {
    Route::get('/', [Centro_MedicoController::class, 'index'])->name('centros.index');
    Route::get('/create', [Centro_MedicoController::class, 'create'])->name('centros.create');
    Route::post('/', [Centro_MedicoController::class, 'store'])->name('centros.store');
    Route::get('/{centroMedico}', [Centro_MedicoController::class, 'show'])->name('centros.show');
    Route::get('/{centroMedico}/edit', [Centro_MedicoController::class, 'edit'])->name('centros.edit');
    Route::put('/{centroMedico}', [Centro_MedicoController::class, 'update'])->name('centros.update');
    Route::delete('/{centroMedico}', [Centro_MedicoController::class, 'destroy'])->name('centros.destroy');
});

// Rutas de Medicamentos
Route::prefix('medicamentos')->group(function () {
    Route::get('/', [MedicamentoController::class, 'index'])->name('medicamentos.index');
    Route::get('/create', [MedicamentoController::class, 'create'])->name('medicamentos.create');
    Route::post('/', [MedicamentoController::class, 'store'])->name('medicamentos.store');
    Route::get('/{medicamento}/edit', [MedicamentoController::class, 'edit'])->name('medicamentos.edit');
    Route::put('/{medicamento}', [MedicamentoController::class, 'update'])->name('medicamentos.update');
    Route::delete('/{medicamento}', [MedicamentoController::class, 'destroy'])->name('medicamentos.destroy');
});

// Rutas de Recetas
Route::prefix('recetas')->group(function () {
    Route::get('/', [RecetaController::class, 'index'])->name('recetas.index');
    Route::get('/create', [RecetaController::class, 'create'])->name('recetas.create');
    Route::post('/', [RecetaController::class, 'store'])->name('recetas.store');
    Route::get('/{receta}/edit', [RecetaController::class, 'edit'])->name('recetas.edit');
    Route::put('/{receta}', [RecetaController::class, 'update'])->name('recetas.update');
    Route::delete('/{receta}', [RecetaController::class, 'destroy'])->name('recetas.destroy');
});

// Rutas de Citas Médicas (Solo vistas)
Route::prefix('citas')->group(function () {
    Route::get('/', [CitaMedicaController::class, 'index'])->name('citas.index');
    Route::get('/create', [CitaMedicaController::class, 'create'])->name('citas.create');
    Route::get('/{citaMedica}', [CitaMedicaController::class, 'show'])->name('citas.show');
    Route::get('/{citaMedica}/edit', [CitaMedicaController::class, 'edit'])->name('citas.edit');
});
