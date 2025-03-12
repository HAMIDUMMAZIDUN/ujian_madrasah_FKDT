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

        // Query data sesuai filter yang dipilih
        $query = DB::table('master_mdt');

        if ($request->has('kecamatan') && $request->kecamatan != '') {
            $query->where('kecamatan', $request->kecamatan);
        }

        if ($request->has('desa') && $request->desa != '') {
            $query->where('desa', $request->desa);
        }

        $data = $query->get();

        // Hitung jumlah lembaga dengan nama unik
        $jumlah_lembaga = MasterMDT::whereNotNull('nama_lembaga_MDT')
            ->select('nama_lembaga_MDT')
            ->distinct()
            ->count();

        $jumlah_desa = MasterMDT::whereNotNull('desa')
            ->select('desa')
            ->distinct()
            ->count();

        $jumlah_kecamatan = MasterMDT::whereNotNull('kecamatan')
            ->select('kecamatan')
            ->distinct()
            ->count();

        // Hitung jumlah santri
        $jumlah_santri = MasterMDT::whereNotNull('nama_santri')->count(); 

        return view('admin.dashboard', [
            'data' => $data,
            'jumlah_lembaga' => $jumlah_lembaga, 
            'jumlah_santri' => $jumlah_santri, 
            'jumlah_desa' => $jumlah_desa, 
            'jumlah_kecamatan' => $jumlah_kecamatan, 
            'list_kecamatan' => $list_kecamatan, // Kirim ke view
        ]);
    }

    public function getDesaByKecamatan(Request $request)
    {
        $desaList = DB::table('master_mdt') // Pastikan tabelnya benar
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

