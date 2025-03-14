<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SantriExport;

class ExportController extends Controller
{
    public function exportExcel(Request $request)
    {
        // Ambil filter dari request
        $kecamatan = $request->input('kecamatan');
        $desa = $request->input('desa');
        $kode_mdt = $request->input('kode_mdt');

        // Unduh data sesuai filter yang diterapkan
        return Excel::download(new SantriExport($kecamatan, $desa, $kode_mdt), 'data_santri.xlsx');
    }
}




