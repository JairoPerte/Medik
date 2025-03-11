<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\Centro_MedicoController;
use App\Mail\ExampleMail;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return auth()->guard("sanctum")->check() ? redirect('/dashboard') : view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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

Route::prefix('consultas')->group(function () {
    Route::get('/', [ConsultaController::class, 'index'])->name('consultas.index');
    Route::get('/create', [ConsultaController::class, 'create'])->name('consultas.create');
    Route::post('/', [ConsultaController::class, 'store'])->name('consultas.store');
    Route::get('/{consulta}', [ConsultaController::class, 'show'])->name('consultas.show');
    Route::get('/{consulta}/edit', [ConsultaController::class, 'edit'])->name('consultas.edit');
    Route::put('/{consulta}', [ConsultaController::class, 'update'])->name('consultas.update');
    Route::delete('/{consulta}', [ConsultaController::class, 'destroy'])->name('consultas.destroy');
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
