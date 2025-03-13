<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterMDT;

class LembagaController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_mdt' => 'required',
            'nama_lembaga_MDT' => 'required',
            'alamat_madrasah' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'nsdt' => 'required',
            'no_hp' => 'required',
            'nama_kepala_MDT' => 'required',
        ]);
    
        // Simpan ke database
        MasterMDT::create($validatedData);
    
        // Redirect dengan session
        return redirect()->back()->with([
            'success' => 'Data berhasil disimpan!',
            'data' => $validatedData
        ]);
    }
    public function edit($id)
{
    $lembaga = MasterMDT::findOrFail($id);
    dd($lembaga->toArray());
    return view('admin.edit', compact('lembaga'));
}

    public function destroy($id)
    {
        MasterMDT::destroy($id);
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'kode_mdt' => 'required',
        'nama_lembaga_MDT' => 'required',
        'alamat_madrasah' => 'required',
        'rt' => 'required',
        'rw' => 'required',
        'desa' => 'required',
        'kecamatan' => 'required',
        'nsdt' => 'required',
        'no_hp' => 'required',
        'nama_kepala_MDT' => 'required',
    ]);

    $lembaga = Lembaga::findOrFail($id);
    $lembaga->update($request->all());

    return redirect()->route('lembaga.index')->with('success', 'Data berhasil diperbarui!');
}

    
}

