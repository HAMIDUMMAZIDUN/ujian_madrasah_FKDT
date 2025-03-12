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
use App\Http\Controllers\MasterMDTController;
use App\Http\Controllers\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


    // Route untuk halaman utama
    Route::get('/', function () {
    return view('welcome');
    });

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Route Default Dashboard (Mencegah Loop Redirect)
    Route::get('/dashboard', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    
    $user = Auth::user();
    return $user->role === 'admin' ? redirect()->route('admin.dashboard') : redirect()->route('user.dashboard');
    })->middleware('auth')->name('dashboard');

    // Route untuk User dan Admin
    Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Route untuk mengelola profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route CRUD otomatis untuk ujian
    Route::resource('/ujian', UjianController::class);

    // Route filter
    Route::get('/get-kecamatan', [DataController::class, 'getKecamatan']);
    Route::get('/get-desa/{kecamatan_id}', [DataController::class, 'getDesa']);
    Route::get('/get-lembaga/{desa_id}', [DataController::class, 'getLembaga']);
    Route::get('/filter-data', [DataController::class, 'filterData']);
    Route::get('/get-all-data', [DataController::class, 'getAllData']);
    Route::get('/get-desa', [AdminController::class, 'getDesaByKecamatan']);


});

    // Route untuk logout menggunakan controller
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    //Route untuk masterMDT
    Route::get('/master_mdt', [MasterMDTController::class, 'index']);

    // Memuat route auth tambahan dari Laravel Breeze/Fortify jika digunakan
    require __DIR__.'/auth.php';
