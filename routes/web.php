<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KebunController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\BlokController;
use App\Http\Controllers\HasilPanenController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Admin
    Route::get('/admin/pengguna', [PenggunaController::class, 'index'])->name('admin.pengguna.index');
    Route::patch('/admin/pengguna/{pengguna}/toggle-status', [PenggunaController::class, 'toggleStatus'])->name('admin.pengguna.toggle-status');

    // Route Resource
    Route::resource('kebun', KebunController::class);
    Route::resource('blok', BlokController::class);
    
    // ROUTE LAPORAN HARUS DI ATAS RESOURCE
    Route::get('/hasil-panen/laporan', [HasilPanenController::class, 'laporan'])->name('hasil-panen.laporan');
    Route::resource('hasil-panen', HasilPanenController::class);
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);