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

    // Rutas de Recetas accesibles para todos los usuarios
    // Route::prefix('recetas')->group(function () {
    //     Route::get('/', [RecetaController::class, 'index'])->name('recetas.index');
    //     Route::get('/create', [RecetaController::class, 'create'])->name('recetas.create');
    //     Route::post('/', [RecetaController::class, 'store'])->name('recetas.store');
    //     Route::get('/{receta}', [RecetaController::class, 'show'])->name('recetas.show');
    // });

    // Route::prefix('citas')->group(function () {
    //     Route::get('/', [CitaMedicaController::class, 'index'])->name('citas.index');
    //     Route::get('/create', [CitaMedicaController::class, 'create'])->name('citas.create');
    //     Route::post('/', [CitaMedicaController::class, 'store'])->name('citas.store');
    //     Route::get('/{citaMedica}', [CitaMedicaController::class, 'show'])->name('citas.show');
    // });

    Route::prefix('consultas')->group(function () {
        Route::get('/create', [ConsultaController::class, 'create'])->name('consultas.create');
        Route::post('/', [ConsultaController::class, 'store'])->name('consultas.store');

        Route::get('/{consulta}/edit', [ConsultaController::class, 'edit'])->name('consultas.edit');
        Route::put('/{consulta}', [ConsultaController::class, 'update'])->name('consultas.update');
        Route::delete('/{consulta}', [ConsultaController::class, 'destroy'])->name('consultas.destroy');

        Route::get('/{consulta}', [ConsultaController::class, 'show'])->name('consultas.show');
        Route::get('/', [ConsultaController::class, 'index'])->name('consultas.index');
    });

    Route::prefix('doctores')->group(function () {
        Route::get('/create', [DoctorController::class, 'create'])->name('doctores.create');
        Route::post('/', [DoctorController::class, 'store'])->name('doctores.store');

        Route::get('/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctores.edit');
        Route::put('/{doctor}', [DoctorController::class, 'update'])->name('doctores.update');
        Route::delete('/{doctor}', [DoctorController::class, 'destroy'])->name('doctores.destroy');

        Route::get('/{doctor}', [DoctorController::class, 'show'])->name('doctores.show');
        Route::get('/', [DoctorController::class, 'index'])->name('doctores.index');
    });

    Route::get('/citas/create', [CitaMedicaController::class, 'create'])->name('citas.create');
    Route::post('/citas', [CitaMedicaController::class, 'store'])->name('citas.store');
    Route::get('/recetas/create', [RecetaController::class, 'create'])->name('recetas.create');
    Route::post('/recetas', [RecetaController::class, 'store'])->name('recetas.store');
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
    Route::get('/user/recetas', [RecetaController::class, 'recetasUser'])->name('recetas.user');
    Route::get('/user/historial-medico', [CitaMedicaController::class, 'historial'])->name('historial.citas');
});
