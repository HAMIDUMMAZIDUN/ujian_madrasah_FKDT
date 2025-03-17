<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
public function hapusSemuaData (Request $request)
{
    $adminPin = "123"; 

    if ($request->pin !== $adminPin) {
        return response()->json(['success' => false, 'message' => 'PIN salah!'], 403);
    }

    if ($request->isMethod('get')) {
        return response()->json(['message' => 'Metode GET tidak diperbolehkan'], 405);
    }

    // Lanjutkan proses penghapusan
    DB::table('master_mdt')->truncate();
    return redirect()->back()->with('success', 'Semua data berhasil dihapus.');
}

}