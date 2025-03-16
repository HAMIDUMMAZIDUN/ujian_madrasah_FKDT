<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterMdt;

class MasterMdtController extends Controller
{
    public function update(Request $request)
    {
        // Validasi data
        $request->validate([
            'id' => 'required|exists:master_mdt,id',
            'kode_mdt' => 'required|string',
            'nama_lembaga_MDT' => 'required|string',
            'alamat_madrasah' => 'required|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'desa' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'nsdt' => 'nullable|string',
            'no_hp' => 'nullable|string',
            'nama_kepala_MDT' => 'nullable|string',
            'no_peserta_ujian' => 'nullable|string',
            'nis' => 'nullable|string',
            'nisn' => 'nullable|string',
            'no_urut_santri_diniyah' => 'nullable|string',
            'nama_santri' => 'nullable|string',
            'jenis_kelamin' => 'nullable|string',
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'nama_ayah' => 'nullable|string',
            'nama_ibu' => 'nullable|string',
            'alamat_siswa_kp' => 'nullable|string',
            'alamat_siswa_rt' => 'nullable|string',
            'alamat_siswa_rw' => 'nullable|string',
            'alamat_siswa_desa' => 'nullable|string',
            'alamat_siswa_kec' => 'nullable|string',
            'asal_sekolah_formal' => 'nullable|string',
            'NIK_santri' => 'nullable|string',
        ]);

        // Cari data berdasarkan ID
        $lembaga = MasterMdt::findOrFail($request->id);

        // Update data
        $lembaga->update($request->except(['id', '_token', '_method']));

        return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui']);
    }
    public function index()
    {
        // Mengambil semua data dari tabel master_mdt
        $data = MasterMdt::all();
        
        // Mengirim data ke view
        return view('database.mastermdt', compact('data'));
    }
    
}
