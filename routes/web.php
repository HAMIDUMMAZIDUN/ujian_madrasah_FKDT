<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\UjianController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Default Dashboard (Mencegah Loop Redirect)
Route::get('/dashboard', function () {
    return Auth::check() ? redirect()->route('user.dashboard') : redirect()->route('login');
})->middleware('auth')->name('dashboard');

// Route untuk User
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('admin.dashboard'); // Pastikan ada file resources/views/dashboard.blade.php
    })->name('user.dashboard');

    Route::get('/admin/dashboard', [UserController::class, 'index'])->name('admin.dashboard');

    // Route untuk mengelola profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route CRUD otomatis untuk ujian
    Route::resource('/ujian', UjianController::class);
});

// Route untuk logout menggunakan controller
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Memuat route auth tambahan dari Laravel Breeze/Fortify jika digunakan
require __DIR__.'/auth.php';
