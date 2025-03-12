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

        $data = $query->get();

        // Hitung jumlah lembaga berdasarkan filter
        $jumlah_lembaga = DB::table('master_mdt')
            ->whereNotNull('nama_lembaga_MDT')
            ->distinct()
            ->count('nama_lembaga_MDT');

        // Hitung jumlah desa berdasarkan filter
        $jumlah_desa = DB::table('master_mdt')
            ->whereNotNull('desa')
            ->distinct()
            ->count('desa');

        // Hitung jumlah kecamatan berdasarkan filter
        $jumlah_kecamatan = DB::table('master_mdt')
            ->whereNotNull('kecamatan')
            ->distinct()
            ->count('kecamatan');

        // Hitung jumlah santri berdasarkan filter
        $jumlah_santri = DB::table('master_mdt')
            ->whereNotNull('nama_santri')->count();

        // Return ke view
        return view('admin.dashboard', compact(
            'data',
            'jumlah_lembaga',
            'jumlah_santri',
            'jumlah_desa',
            'jumlah_kecamatan',
            'list_kecamatan',
            'list_kode_mdt'
        ));
    }

    public function getDesaByKecamatan(Request $request)
    {
        $desaList = DB::table('master_mdt')
            ->where('kecamatan', $request->kecamatan)
            ->select('desa')
            ->distinct()
            ->orderBy('desa')
            ->pluck('desa');

        return response()->json($desaList);
    }

    public function downloadExcel()
    {
        return Excel::download(new DataExport, 'data-detail.xlsx');
    }
}
