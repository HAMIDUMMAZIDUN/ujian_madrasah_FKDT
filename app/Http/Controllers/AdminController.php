<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterMdt; 
use App\Models\Santri; 
use Illuminate\Support\Facades\DB;
use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        // Ambil daftar kecamatan unik dari database
        $list_kecamatan = MasterMdt::select('kecamatan')
            ->distinct()
            ->orderBy('kecamatan')
            ->pluck('kecamatan');

        // Ambil daftar desa berdasarkan kecamatan yang dipilih
        $list_desa = collect();
        if ($request->filled('kecamatan')) {
            $list_desa = MasterMdt::where('kecamatan', $request->kecamatan)
                ->select('desa')
                ->distinct()
                ->orderBy('desa')
                ->pluck('desa');
        }

        // Query utama untuk filter data
        $query = MasterMdt::query();

        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->kecamatan);
        }

        if ($request->filled('desa')) {
            $query->where('desa', $request->desa);
        }

        if ($request->filled('kode_mdt')) {
            $query->where('kode_mdt', $request->kode_mdt);
        }

        // Ambil data setelah filter diterapkan
        $data = $query->get();

        // **Hitung jumlah berdasarkan filter yang diterapkan**
        $jumlah_lembaga = (clone $query)->whereNotNull('nama_lembaga_MDT')->distinct()->count('nama_lembaga_MDT');
        $jumlah_desa = (clone $query)->whereNotNull('desa')->distinct()->count('desa');
        $jumlah_kecamatan = (clone $query)->whereNotNull('kecamatan')->distinct()->count('kecamatan');
        $jumlah_santri = (clone $query)->whereNotNull('nama_santri')->count();
        $jumlah_santri_laki = (clone $query)->where('jenis_kelamin', 'L')->count();
        $jumlah_santri_perempuan = (clone $query)->where('jenis_kelamin', 'P')->count();

        // Ambil daftar kode_mdt setelah filter diterapkan
        $list_kode_mdt = $query->distinct()->pluck('kode_mdt');
        return view('admin.dashboard', compact(
            'data',
            'jumlah_lembaga',
            'jumlah_santri',
            'jumlah_desa',
            'jumlah_kecamatan',
            'jumlah_santri_laki',
            'jumlah_santri_perempuan',
            'list_kecamatan',
            'list_desa',
            'list_kode_mdt'
        ));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $santri = Santri::where('nama_santri', 'LIKE', "%{$query}%")->get();
        return response()->json($santri);
    }

    public function getDesaByKecamatan(Request $request)
    {
        $list_desa = MasterMdt::where('kecamatan', $request->kecamatan)
            ->select('desa')
            ->distinct()
            ->orderBy('desa')
            ->pluck('desa');

        return response()->json($list_desa);
    }

    public function downloadExcel(Request $request)
    {
        $kecamatan = $request->kecamatan ?? null;
        $desa = $request->desa ?? null;
        $kode_mdt = $request->kode_mdt ?? null;

        return Excel::download(new DataExport($kecamatan, $desa, $kode_mdt), 'santri.xlsx');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_mdt' => 'required|unique:master_mdt,kode_mdt',
            'nama_lembaga_MDT' => 'required',
            'alamat_madrasah' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'nsdt' => 'required',
            'no_hp' => 'required',
            'nama_kepala_MDT' => 'required', 
            'no_peserta_ujian' => 'required',
            'nis' => 'required',
            'nisn' => 'required',
            'no_urut_santri_diniyah' => 'required',
            'nama_santri' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'nullable|date',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'alamat_siswa_kp' => 'required',
            'alamat_siswa_rt' => 'required',
            'alamat_siswa_rw' => 'required',
            'alamat_siswa_desa' => 'required',
            'alamat_siswa_kec' => 'required',
            'asal_sekolah_formal' => 'required',
            'NIK_santri' => 'nullable|string' 
        ]);

         // Cek apakah request memiliki 'no_peserta_ujian'
            if ($request->has('no_peserta_ujian')) {
                $request->validate([
                    'no_peserta_ujian' => 'required|unique:master_mdt,no_peserta_ujian'
                ]);

                // Update nomor peserta ujian untuk santri yang belum memiliki nomor peserta
                $santri = MasterMdt::whereNull('no_peserta_ujian')->first();

                if ($santri) {
                    $santri->no_peserta_ujian = $request->no_peserta_ujian;
                    $santri->save();
                    return response()->json(['success' => true, 'message' => 'No Peserta berhasil disimpan!']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Tidak ada data santri yang bisa diperbarui.']);
                }
            }
        MasterMdt::create($request->all());

        return response()->json(['message' => 'Data berhasil disimpan']);
    }

}
