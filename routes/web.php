<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UjianController;
use Illuminate\Support\Facades\Auth;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Route untuk halaman dashboard (hanya bisa diakses jika sudah login)
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/dashboarduser', function () {
    return view('user.dashboard');
})->name('dashboarduser')->middleware('auth');

// Route untuk proses login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Route untuk logout menggunakan controller
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Middleware untuk user yang sudah login
Route::middleware('auth')->group(function () {
    // Route untuk mengelola profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route CRUD otomatis untuk ujian
    Route::resource('/ujian', UjianController::class);
});

// Memuat route auth tambahan dari Laravel Breeze/Fortify jika digunakan
require __DIR__.'/auth.php';
