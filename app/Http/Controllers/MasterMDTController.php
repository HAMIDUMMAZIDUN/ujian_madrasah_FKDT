<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterMDT;

class MasterMDTController extends Controller
{
    public function index()
    {
        $data = MasterMDT::all(); // Ambil semua data dari tabel master_mdt
        return view('master_mdt.index', compact('data'));
    }
}
