@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-black text-2xl font-bold mb-4 text-center">Cetak Kartu Peserta</h1>
    
    <!-- Form Pencarian Kecamatan -->
    <form method="GET" action="{{ route('admin.layout.cetak-kartu') }}" class="mb-4">
        <div class="mb-4">
            <label for="kecamatan" class="block text-black font-semibold">Kecamatan</label>
            <select id="kecamatan" name="kecamatan" class="w-full p-2 border rounded">
                @foreach($list_kecamatan as $kecamatan)
                <option value="{{ $kecamatan }}" {{ request('kecamatan') == $kecamatan ? 'selected' : '' }}>
                    {{ $kecamatan }}
                </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Cari</button>
    </form>

    <!-- Tombol Cetak -->
    <button onclick="window.print()" class="bg-green-500 text-white font-bold py-2 px-4 rounded mb-4">
        Cetak
    </button>

    <!-- Wrapper untuk cetak PDF -->
    <div id="print-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-2 p-4">
        @foreach($peserta as $data)
        <div class="border border-gray-300 p-4 rounded-lg shadow-md bg-white">
            <div class="border border-gray-300 p-4 rounded-lg">
                <table class="w-full border-collapse">
                    <tr>
                        <td class="text-black text-center border-b border-gray-300 pb-2">
                            <img src="{{ asset('images/FKDT.png') }}" alt="Logo Madrasah" class="mx-auto h-16 mb-2">
                        </td>
                        <td class="text-black text-center border-b border-gray-300 pb-2">
                            <p class="font-bold text-black text-center uppercase">Kartu Peserta Ujian Madrasah</p>
                            <p class="text-black text-center">Tahun Pelajaran 2024/2025</p>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="6" class="text-black text-center align-top">
                            <img src="{{ asset($data->foto ?? 'path/to/default-photo.png') }}" alt="Foto Peserta" class="h-24 w-20 mx-auto border rounded-md">
                        </td>
                        <td class="font-semibold text-black text-sm">Nama Peserta</td>
                        <td class="text-black text-sm">: {{ $data->nama_santri }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-black text-sm">Tanggal Lahir</td>
                        <td class="text-black text-sm">: {{ $data->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-black text-sm">NISN</td>
                        <td class="text-black text-sm">: {{ $data->nisn }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-black text-sm">Nomor Peserta</td>
                        <td class="text-black text-sm">: {{ $data->no_peserta_ujian }}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold text-black text-sm">Nama Madrasah</td>
                        <td class="text-black text-sm">: {{ $data->nama_lembaga_MDT }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-black text-center border-t border-gray-300 pt-2">
                            <p class="text-black text-sm">Bandung, {{ date('d M Y') }}</p>
                            <p class="text-black text-sm">Kepala Madrasah</p>
                            <br><br>
                            <p class="font-bold text-black text-sm">{{ $data->nama_kepala_MDT }}</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- CSS untuk Mode Cetak -->
<style>
@media print {
    /* Tetapkan layout cetak menjadi dua kolom */
    #print-container {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 10px !important;
        padding: 10px !important;
    }

    /* Hilangkan tombol saat mencetak */
    button {
        display: none !important;
    }
}
</style>

@endsection
