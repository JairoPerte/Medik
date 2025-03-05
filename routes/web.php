<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\CentroMedicoController;

Route::get('/', function () {
    return view('welcome');
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

Route::resource('centros', CentroMedicoController::class);
Route::resource('consultas', ConsultaController::class);
