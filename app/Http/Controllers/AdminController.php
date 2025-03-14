<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterMDT; 
use App\Models\Santri; // Pastikan model ini ada
use Illuminate\Support\Facades\DB;
use App\Exports\DataExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q');
        $santri = Santri::where('nama_santri', 'LIKE', "%{$query}%")->get();
        return response()->json($santri);
    }

    public function index(Request $request)
    {
        // Ambil daftar kecamatan unik dari database
        $list_kecamatan = MasterMDT::select('kecamatan')
            ->distinct()
            ->orderBy('kecamatan')
            ->pluck('kecamatan');
    
        // Ambil daftar desa berdasarkan kecamatan yang dipilih
        $list_desa = collect();
        if ($request->filled('kecamatan')) {
            $list_desa = MasterMDT::where('kecamatan', $request->kecamatan)
                ->select('desa')
                ->distinct()
                ->orderBy('desa')
                ->pluck('desa');
        }
    
        // Query utama untuk filter data
        $query = MasterMDT::query();

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
    
    public function getDesaByKecamatan(Request $request)
    {
        $list_desa = MasterMDT::where('kecamatan', $request->kecamatan)
            ->select('desa')
            ->distinct()
            ->orderBy('desa')
            ->pluck('desa');
    
        return response()->json($list_desa);
    }
    
    public function downloadExcel(Request $request)
    {
        // Pastikan variabel ini dikirim dari request
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
            'desa' => 'required',
            'kecamatan' => 'required',
            'nama_santri' => 'required',
            'tanggal_lahir' => 'nullable|date',
        ]);
        
        MasterMDT::create($request->all());

        return response()->json(['message' => 'Data berhasil disimpan']);
    }
}
