<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterMDT; // Sesuaikan dengan model yang digunakan

class PesertaController extends Controller
{
    public function generateNoPeserta()
    {
        // Ambil nomor peserta terakhir dari database
        $lastPeserta = MasterMDT::latest()->first();

        // Tentukan nomor baru
        if ($lastPeserta && $lastPeserta->no_peserta_ujian) {
            $lastNumber = (int) substr($lastPeserta->no_peserta_ujian, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        // Format nomor peserta (misalnya: MDT-2025-0001)
        $year = date('Y');
        $noPeserta = "MDT-{$year}-{$newNumber}";

        // Simpan ke database
        $peserta = new MasterMDT();
        $peserta->no_peserta_ujian = $noPeserta;
        $peserta->save();

        return response()->json(['no_peserta' => $noPeserta]);
    }
}
