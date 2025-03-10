<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function index()
    {
        $ujians = Ujian::all();
        return view('admin.ujian.index', compact('ujians'));
    }

    public function create()
    {
        return view('admin.ujian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ujian' => 'required',
            'tanggal' => 'required|date',
            'durasi' => 'required|integer',
        ]);

        Ujian::create($request->all());
        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil ditambahkan.');
    }
}
