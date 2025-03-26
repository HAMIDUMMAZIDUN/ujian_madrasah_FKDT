<?php
namespace App\Http\Controllers;

use App\Models\Kelas; 
use App\Models\MasterMdt;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakKartuController extends Controller
{
    public function cetakKartu(Request $request)
    {
        $list_kecamatan = DB::table('master_mdt')->pluck('kecamatan')->unique();
        $peserta = DB::table('master_mdt')
            ->where('kecamatan', $request->kecamatan)
            ->get();

        return view('admin.layouts.cetakkartu', compact('list_kecamatan', 'peserta'));
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
    }
    public function cetakPDF()
    {
        
        // Fetch the data for peserta
        $peserta = MasterMdt::all(); // Replace with the correct model or query if needed
        $list_kecamatan = MasterMdt::select('kecamatan')->distinct()->get(); // Adjust query as necessary

        // Generate the PDF
        $pdf = Pdf::loadView('admin.layouts.cetakkartu', compact('peserta', 'list_kecamatan'));
        return $pdf->stream('kartu_peserta.pdf');
    }
}