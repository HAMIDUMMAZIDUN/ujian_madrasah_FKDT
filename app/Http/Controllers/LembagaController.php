<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterMDT;

class LembagaController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_mdt' => 'required',
            'nama_lembaga_MDT' => 'required',
            'alamat_madrasah' => 'required',
            'rt' => 'nullable',
            'rw' => 'nullable',
            'desa' => 'required',
            'kecamatan' => 'required',
            'nsdt' => 'nullable',
            'no_hp' => 'nullable',
            'nama_kepala_MDT' => 'nullable',
            'no_peserta_ujian' => 'nullable',
            'nis' => 'nullable',
            'nisn' => 'nullable',
            'nama_santri' => 'required',
            'jenis_kelamin' => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'nama_ayah' => 'nullable',
            'nama_ibu' => 'nullable',
            'alamat_siswa_kp' => 'nullable',
            'alamat_siswa_rt' => 'nullable',
            'alamat_siswa_rw' => 'nullable',
            'alamat_siswa_desa' => 'nullable',
            'alamat_siswa_kec' => 'nullable',
            'asal_sekolah_formal' => 'nullable',
            'NIK_santri' => 'nullable',
        ]);
        
        // Simpan ke database
        MasterMDT::create($validatedData);
        
        // Redirect dengan session
        return redirect()->back()->with([
            'success' => 'Data berhasil disimpan!',
            'data' => $validatedData
        ]);
    }

    public function edit($id)
    {
        $lembaga = MasterMDT::findOrFail($id);
        return view('admin.dashboard', compact('lembaga'));
    }

    public function destroy($id)
    {
        MasterMDT::destroy($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode_mdt' => 'required',
            'nama_lembaga_MDT' => 'required',
            'alamat_madrasah' => 'required',
            'rt' => 'nullable',
            'rw' => 'nullable',
            'desa' => 'required',
            'kecamatan' => 'required',
            'nsdt' => 'nullable',
            'no_hp' => 'nullable',
            'nama_kepala_MDT' => 'nullable',
            'no_peserta_ujian' => 'nullable',
            'nis' => 'nullable',
            'nisn' => 'nullable',
            'nama_santri' => 'required',
            'jenis_kelamin' => 'nullable',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable|date',
            'nama_ayah' => 'nullable',
            'nama_ibu' => 'nullable',
            'alamat_siswa_kp' => 'nullable',
            'alamat_siswa_rt' => 'nullable',
            'alamat_siswa_rw' => 'nullable',
            'alamat_siswa_desa' => 'nullable',
            'alamat_siswa_kec' => 'nullable',
            'asal_sekolah_formal' => 'nullable',
            'NIK_santri' => 'nullable',
        ]);

        MasterMDT::where('id', $id)->update($validatedData);
        return redirect()->route('admin.dashboard.index')->with('success', 'Data berhasil diperbarui!');
    }
}
