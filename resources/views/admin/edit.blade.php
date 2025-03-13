@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold mb-4">Edit Lembaga</h2>

    <form action="{{ route('update', $lembaga->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
    <label class="block text-gray-700">Kode MDT</label>
    <input type="text" name="kode_mdt" value="{{ $lembaga->kode_mdt ?? '' }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block text-gray-700">Nama Lembaga</label>
    <input type="text" name="nama_lembaga_MDT" value="{{ $lembaga->nama_lembaga_MDT ?? '' }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block text-gray-700">Alamat Madrasah</label>
    <input type="text" name="alamat_madrasah" value="{{ $lembaga->alamat_madrasah ?? '' }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block text-gray-700">RT</label>
    <input type="text" name="rt" value="{{ $lembaga->rt ?? '' }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block text-gray-700">RW</label>
    <input type="text" name="rw" value="{{ $lembaga->rw ?? '' }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block text-gray-700">Desa</label>
    <input type="text" name="desa" value="{{ $lembaga->desa ?? '' }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block text-gray-700">Kecamatan</label>
    <input type="text" name="kecamatan" value="{{ $lembaga->kecamatan ?? '' }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block text-gray-700">NSDT</label>
    <input type="text" name="nsdt" value="{{ $lembaga->nsdt ?? '' }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block text-gray-700">No HP</label>
    <input type="text" name="no_hp" value="{{ $lembaga->no_hp ?? '' }}" class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block text-gray-700">Nama Kepala Madrasah</label>
    <input type="text" name="nama_kepala_MDT" value="{{ $lembaga->nama_kepala_MDT ?? '' }}" class="w-full border p-2 rounded">
</div>


        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ url()->previous() }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
    </form>
</div>
@endsection
