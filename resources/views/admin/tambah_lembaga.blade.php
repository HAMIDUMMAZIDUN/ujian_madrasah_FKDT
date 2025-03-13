@if(session('success'))
    <div id="popup" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white p-4 rounded shadow-lg w-1/3">
            <h2 class="text-green-500 text-lg font-bold mb-2">Data Berhasil Disimpan!</h2>
            <p class="mb-2">Berikut adalah data yang Anda masukkan:</p>
            <ul class="list-disc pl-5 mb-3">
                @foreach(session('data') as $key => $value)
                    <li><strong>{{ ucwords(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</li>
                @endforeach
            </ul>
            <button onclick="document.getElementById('popup').style.display='none'" class="bg-red-500 text-white px-4 py-2 rounded">Tutup</button>
        </div>
    </div>
@endif

<form action="{{ route('lembaga.store') }}" method="POST">
    @csrf
    <label>Kode MDT:</label>
    <input type="text" name="kode_mdt" required class="border p-2 rounded w-full">
    
    <label>Nama Lembaga MDT:</label>
    <input type="text" name="nama_lembaga_MDT" required class="border p-2 rounded w-full">

    <label>Alamat Madrasah:</label>
    <input type="text" name="alamat_madrasah" required class="border p-2 rounded w-full">

    <label>RT:</label>
    <input type="text" name="rt" class="border p-2 rounded w-full">

    <label>RW:</label>
    <input type="text" name="rw" class="border p-2 rounded w-full">

    <label>Desa:</label>
    <input type="text" name="desa" required class="border p-2 rounded w-full">

    <label>Kecamatan:</label>
    <input type="text" name="kecamatan" required class="border p-2 rounded w-full">

    <label>NSDT:</label>
    <input type="text" name="nsdt" class="border p-2 rounded w-full">

    <label>No HP:</label>
    <input type="text" name="no_hp" required class="border p-2 rounded w-full">

    <label>Nama Kepala MDT:</label>
    <input type="text" name="nama_kepala_MDT" required class="border p-2 rounded w-full">

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-3">Simpan</button>
</form>
