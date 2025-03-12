<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterMdt; // Ubah model yang digunakan

class LembagaController extends Controller
{
    // Menampilkan form tambah lembaga
    public function create()
    {
        return view('admin.tambah_lembaga');
    }

    // Menyimpan data lembaga baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'kode_mdt' => 'required|unique:master_mdt', // Sesuaikan dengan nama tabel yang benar
            'nama_lembaga_MDT' => 'required',
            'alamat_madrasah' => 'required',
            'rt' => 'nullable', // Jika bisa kosong, gunakan 'nullable'
            'rw' => 'nullable',
            'desa' => 'required',
            'kecamatan' => 'required',
            'nsdt' => 'nullable',
            'no_hp' => 'required|numeric',
            'nama_kepala_MDT' => 'required',
        ]);

        MasterMdt::create($request->all()); // Gunakan model MasterMdt

        return redirect()->route('lembaga.create')->with('success', 'Data lembaga berhasil disimpan!');
    }
}
