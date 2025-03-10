<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\Centro_MedicoController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

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
    Route::get('/admin/dashboard', function () {
        return "Hola";
    })->name('admin.dashboard');
});

Route::middleware(['auth:web', 'verified'])->group(function () {
    Route::get('/web/dashboard', function () {
        return "Hola";
    })->name('admin.dashboard');
});

Route::resource('centros', Centro_MedicoController::class);
Route::resource('consultas', ConsultaController::class);
