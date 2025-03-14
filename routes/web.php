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
use App\Http\Controllers\LembagaController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\PesertaController;

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

    // Route 
    Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/ujian', UjianController::class);
    Route::get('/get-kecamatan', [DataController::class, 'getKecamatan']);
    Route::get('/get-desa/{kecamatan_id}', [DataController::class, 'getDesa']);
    Route::get('/get-lembaga/{desa_id}', [DataController::class, 'getLembaga']);
    Route::get('/filter-data', [DataController::class, 'filterData']);
    Route::get('/get-all-data', [DataController::class, 'getAllData']);
    Route::get('/get-desa', [AdminController::class, 'getDesaByKecamatan']);
    Route::get('/admin/download-excel', [AdminController::class, 'downloadExcel'])->name('admin.downloadExcel');
    Route::get('/tambah-lembaga', [LembagaController::class, 'create'])->name('lembaga.create');
    Route::post('/tambah-lembaga', [LembagaController::class, 'store'])->name('lembaga.store');
    Route::get('/admin/tambah-lembaga', [LembagaController::class, 'create'])->name('admin.tambah_lembaga');
    Route::post('/admin/simpan-lembaga', [LembagaController::class, 'store'])->name('admin.simpan_lembaga');
    Route::post('/simpan-kecamatan', [LembagaController::class, 'simpanKecamatan']);
    Route::post('/simpan-desa', [LembagaController::class, 'simpanDesa']);
    Route::get('/get-last-mdt', [LembagaController::class, 'getLastMDT']);
    Route::get('/lembaga/tambah', [LembagaController::class, 'create'])->name('lembaga.create');
    Route::post('/lembaga/store', [LembagaController::class, 'store'])->name('lembaga.store');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/edit/{id}', [LembagaController::class, 'edit'])->name('edit');
    Route::delete('/delete/{id}', [LembagaController::class, 'destroy'])->name('delete');
    Route::put('/update/{id}', [LembagaController::class, 'update'])->name('update');
    Route::get('/admin/get-desa', [AdminController::class, 'getDesaByKecamatan'])->name('admin.getDesaByKecamatan');
    Route::get('/download-template', [ImportController::class, 'downloadTemplate'])->name('download.template');
    Route::post('/import-excel', [ImportController::class, 'importExcel'])->name('import.excel');
    Route::get('/export-excel', [ExportController::class, 'exportExcel'])->name('export.excel');
    Route::get('/search/santri', [AdminController::class, 'search'])->name('search.santri');
    Route::get('/generate-no-peserta', [PesertaController::class, 'generateNoPeserta'])->name('generate.no_peserta');

});

    // Route untuk logout menggunakan controller
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    //Route untuk masterMDT
    Route::get('/master_mdt', [MasterMDTController::class, 'index']);

    // Memuat route auth tambahan dari Laravel Breeze/Fortify jika digunakan
    require __DIR__.'/auth.php';
