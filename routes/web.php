<?php

use App\Http\Controllers\{ProfileController, AuthenticatedSessionController,
    UjianController, AuthController, AdminController, UserController, UserrController, LoginController, 
    MasterMDTController, DataController, LembagaController, ImportController, ExportController, 
    PesertaController,CetakkartuController};
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\{Route, Auth, DB};
use Illuminate\Http\Request;

// Route untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Default Dashboard (Mencegah Loop Redirect)
Route::get('/dashboard', function () {
    $user = Auth::user();
    return $user->role === 'admin' ? redirect()->route('admin.dashboard') : redirect()->route('user.dashboard');
})->middleware('auth')->name('dashboard');

// Route untuk pengguna yang sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::post('/register', [UserController::class, 'store']);
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/get-desa', [AdminController::class, 'getDesaByKecamatan']);
    Route::get('/admin/download-excel', [AdminController::class, 'downloadExcel'])->name('admin.downloadExcel');
    Route::get('/admin/tambah-lembaga', [LembagaController::class, 'create'])->name('admin.tambah_lembaga');
    Route::post('/admin/simpan-lembaga', [LembagaController::class, 'store'])->name('admin.simpan_lembaga');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/get-desa', [AdminController::class, 'getDesaByKecamatan'])->name('admin.getDesaByKecamatan');
    Route::get('/search/santri', [AdminController::class, 'search'])->name('search.santri'); 
    Route::post('/hapus-semua-data', function (Request $request) {
        if ($request->pin !== '1234') { // Ganti dengan validasi PIN sesuai kebutuhan
            return response()->json(['success' => false, 'message' => 'PIN salah!'], 400);
        }
    
        // Hapus semua data di tabel tertentu
        \DB::table('master_mdt')->truncate(); // Sesuaikan nama tabel
    
        return response()->json(['success' => true]);
    })->name('hapus-semua-data')->middleware('auth');
    Route::get('/user/dashboard', [UserrController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/get-desa', [UserrController::class, 'getDesaByKecamatan']);
    Route::get('/user/download-excel', [UserrController::class, 'downloadExcel'])->name('user.downloadExcel');
    Route::get('/user/tambah-lembaga', [LembagaController::class, 'create'])->name('user.tambah_lembaga');
    Route::post('/user/simpan-lembaga', [LembagaController::class, 'store'])->name('user.simpan_lembaga');
    Route::post('/user/store', [UserrController::class, 'store'])->name('user.store');
    Route::get('/user/get-desa', [UserrController::class, 'getDesaByKecamatan'])->name('user.getDesaByKecamatan');
    Route::get('/search/santri', [UserrController::class, 'search'])->name('search.santri');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/change-password', [PasswordController::class, 'edit'])->name('password.change')->middleware('auth');
    Route::post('/change-password', [PasswordController::class, 'update'])->name('password.update')->middleware('auth');
    Route::get('/data', [DataController::class, 'index'])->name('data.index');  
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/get-kecamatan', [DataController::class, 'getKecamatan']);
    Route::get('/get-desa/{kecamatan_id}', [DataController::class, 'getDesa']);
    Route::get('/get-lembaga/{desa_id}', [DataController::class, 'getLembaga']);
    Route::get('/filter-data', [DataController::class, 'filterData']);
    Route::get('/get-all-data', [DataController::class, 'getAllData']);
    Route::get('/tambah-lembaga', [LembagaController::class, 'create'])->name('lembaga.create');
    Route::post('/tambah-lembaga', [LembagaController::class, 'store'])->name('lembaga.store');
    Route::post('/simpan-kecamatan', [LembagaController::class, 'simpanKecamatan']);
    Route::post('/simpan-desa', [LembagaController::class, 'simpanDesa']);
    Route::get('/get-last-mdt', [LembagaController::class, 'getLastMDT']);
    Route::get('/edit/{id}', [LembagaController::class, 'edit'])->name('edit');
    Route::delete('/delete/{id}', [LembagaController::class, 'destroy'])->name('delete');
    Route::put('/update/{id}', [LembagaController::class, 'update'])->name('update');
    Route::get('/download-template', [ImportController::class, 'downloadTemplate'])->name('download.template');
    Route::post('/import', [ImportController::class, 'importExcel'])->name('import.excel');
    Route::get('/export-excel', [ExportController::class, 'exportExcel'])->name('export.excel');
    Route::get('/generate-no-peserta', [PesertaController::class, 'generateNoPeserta'])->name('generate.no_peserta');
    Route::put('/master-mdt/update', [MasterMDTController::class, 'update'])->name('master_mdt.update');
    Route::post('/save-no-peserta', [MasterMDTController::class, 'saveNoPeserta'])->name('save.no_peserta');
    Route::get('/admin.layout.cetakkartu', [CetakKartuController::class, 'cetakkartu'])->name('admin.layout.cetak-kartu');
    Route::get('/admin/cetak-kartu', [AdminController::class, 'cetakKartu'])->name('admin.cetak-kartu');
    Route::get('/admin/maincontent', [AdminController::class, 'showMainContent'])->name('admin.maincontent');
    Route::get('/admin/cetak-pdf', [AdminController::class, 'cetakPDF'])->name('admin.cetak-pdf');
    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');
});

// Route untuk masterMDT
Route::get('/master_mdt', [MasterMDTController::class, 'index']);

// Memuat route auth tambahan dari Laravel Breeze/Fortify jika digunakan
require __DIR__.'/auth.php';