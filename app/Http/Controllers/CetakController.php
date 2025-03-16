<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Santri; // Pastikan model Santri tersedia

class CetakController extends Controller
{
    public function cetak() {
        // Ambil semua data santri dari database
        $santris = Santri::all();

        // Pastikan data dikirim dengan compact('santris')
        $pdf = Pdf::loadView('cetak.kartu', ['santris' => $santris])->setPaper('A4', 'portrait');

        return $pdf->stream('Kartu_Peserta.pdf');
    }
}
