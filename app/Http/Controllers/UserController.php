<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterMDT; 

class userController extends Controller
{
    public function index()
    {
        // Ambil semua data dari tabel
        $data = MasterMDT::all(); 

        // Hitung jumlah lembaga dengan nama unik
        $jumlah_lembaga = MasterMDT::whereNotNull('nama_lembaga_MDT')->distinct('nama_lembaga_MDT')->count('nama_lembaga_MDT'); 
        $jumlah_desa = MasterMDT::whereNotNull('desa')->distinct('desa')->count('desa');
        $jumlah_kecamatan = MasterMDT::whereNotNull('kecamatan')->distinct('kecamatan')->count('kecamatan');

        // Hitung jumlah santri, desa, dan kecamatan tanpa cek unik
        $jumlah_santri = MasterMDT::whereNotNull('nama_santri')->count(); 

        return view('user.dashboard', [
            'data' => $data,
            'jumlah_lembaga' => $jumlah_lembaga, 
            'jumlah_santri' => $jumlah_santri, 
            'jumlah_desa' => $jumlah_desa, 
            'jumlah_kecamatan' => $jumlah_kecamatan, 
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password) // Hash password secara manual jika versi Laravel lama
        ]);

        return response()->json(['message' => 'User berhasil dibuat!', 'user' => $user]);
    }
}
