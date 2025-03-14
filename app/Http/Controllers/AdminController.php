<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterMDT; 
use Illuminate\Support\Facades\DB;
use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Ambil daftar kecamatan unik dari database
        $list_kecamatan = DB::table('master_mdt')
            ->select('kecamatan')
            ->distinct()
            ->orderBy('kecamatan')
            ->pluck('kecamatan');
    
        // Ambil daftar desa berdasarkan kecamatan yang dipilih
        $list_desa = collect(); // Default kosong
        if ($request->has('kecamatan') && $request->kecamatan != '') {
            $list_desa = DB::table('master_mdt')
                ->where('kecamatan', $request->kecamatan)
                ->select('desa')
                ->distinct()
                ->orderBy('desa')
                ->pluck('desa');
        }
    
        // Query untuk filter kode_mdt yang relevan
        $queryKodeMDT = DB::table('master_mdt')->select('kode_mdt')->distinct();
    
        if ($request->has('kecamatan') && $request->kecamatan != '') {
            $queryKodeMDT->where('kecamatan', $request->kecamatan);
        }
    
        if ($request->has('desa') && $request->desa != '') {
            $queryKodeMDT->where('desa', $request->desa);
        }
    
        $list_kode_mdt = $queryKodeMDT->orderBy('kode_mdt')->pluck('kode_mdt');
    
        // Query data sesuai filter yang dipilih
        $query = DB::table('master_mdt');
    
        if ($request->has('kecamatan') && $request->kecamatan != '') {
            $query->where('kecamatan', $request->kecamatan);
        }
    
        if ($request->has('desa') && $request->desa != '') {
            $query->where('desa', $request->desa);
        }
    
        if ($request->has('kode_mdt') && $request->kode_mdt != '') {
            $query->where('kode_mdt', $request->kode_mdt);
        }
    
        $data = $query->get(); // Ambil data setelah filter diterapkan
    
        // **Hitung jumlah berdasarkan filter yang diterapkan**
        $jumlah_lembaga = (clone $query)->whereNotNull('nama_lembaga_MDT')->distinct()->count('nama_lembaga_MDT');
        $jumlah_desa = (clone $query)->whereNotNull('desa')->distinct()->count('desa');
        $jumlah_kecamatan = (clone $query)->whereNotNull('kecamatan')->distinct()->count('kecamatan');
        $jumlah_santri = (clone $query)->whereNotNull('nama_santri')->count();
    
        // Return ke view
        return view('admin.dashboard', compact(
            'data',
            'jumlah_lembaga',
            'jumlah_santri',
            'jumlah_desa',
            'jumlah_kecamatan',
            'list_kecamatan',
            'list_desa',
            'list_kode_mdt'
        ));
    }
    
    public function getDesaByKecamatan(Request $request)
    {
        $list_desa = DB::table('master_mdt')
            ->where('kecamatan', $request->kecamatan)
            ->select('desa')
            ->distinct()
            ->orderBy('desa')
            ->pluck('desa');
    
        return response()->json($list_desa);
    }
    
    public function downloadExcel()
    {
        return Excel::download(new SantriExport($kecamatan, $desa, $kode_mdt), 'santri.xlsx');

    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mdt' => 'required|unique:master_mdt,kode_mdt',
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
        
        MasterMDT::create([
            'kode_mdt' => $request->kode_mdt,
            'nama_lembaga_MDT' => $request->nama_lembaga_MDT,
            'alamat_madrasah' => $request->alamat_madrasah,
            'rt' => $request->rt,
            'rw' => $request->rw,
            'desa' => $request->desa,
            'kecamatan' => $request->kecamatan,
            'nsdt' => $request->nsdt,
            'no_hp' => $request->no_hp,
            'nama_kepala_MDT' => $request->nama_kepala_MDT,
            'no_peserta_ujian' => $request->no_peserta_ujian,
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'nama_santri' => $request->nama_santri,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'alamat_siswa_kp' => $request->alamat_siswa_kp,
            'alamat_siswa_rt' => $request->alamat_siswa_rt,
            'alamat_siswa_rw' => $request->alamat_siswa_rw,
            'alamat_siswa_desa' => $request->alamat_siswa_desa,
            'alamat_siswa_kec' => $request->alamat_siswa_kec,
            'asal_sekolah_formal' => $request->asal_sekolah_formal,
            'NIK_santri' => $request->NIK_santri,
        ]);
        

        return response()->json(['message' => 'Data berhasil disimpan']);
    }
}
