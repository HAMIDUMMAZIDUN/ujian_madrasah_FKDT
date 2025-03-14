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

<form action="{{ route('lembaga.store') }}" method="POST" class="p-4">
    @csrf
    <div class="grid grid-cols-3 gap-4">
        <!-- Baris Pertama: 3 Kolom -->
        <div>
            <label class="block">Kode MDT:</label>
            <input type="text" name="kode_mdt" required class="border p-2 rounded w-full">
        </div>
        <div>
            <label class="block">Nama Lembaga MDT:</label>
            <input type="text" name="nama_lembaga_MDT" required class="border p-2 rounded w-full">
        </div>
        <div>
            <label class="block">Alamat Madrasah:</label>
            <input type="text" name="alamat_madrasah" required class="border p-2 rounded w-full">
        </div>
    </div>
    
    <!-- Baris Berikutnya: 2 Kolom per Baris -->
    <div class="grid grid-cols-2 gap-4 mt-4">
        <div>
            <label class="block">RT:</label>
            <input type="text" name="rt" class="border p-2 rounded w-full">
        </div>
        <div>
            <label class="block">RW:</label>
            <input type="text" name="rw" class="border p-2 rounded w-full">
        </div>
        <div>
            <label class="block">Desa:</label>
            <input type="text" name="desa" required class="border p-2 rounded w-full">
        </div>
        <div>
            <label class="block">Kecamatan:</label>
            <input type="text" name="kecamatan" required class="border p-2 rounded w-full">
        </div>
        <div>
            <label class="block">NSDT:</label>
            <input type="text" name="nsdt" class="border p-2 rounded w-full">
        </div>
        <div>
            <label class="block">No HP:</label>
            <input type="text" name="no_hp" required class="border p-2 rounded w-full">
        </div>
    </div>
    
    <!-- Baris Terakhir: Full Width -->
    <div class="mt-4">
        <label class="block">Nama Kepala MDT:</label>
        <input type="text" name="nama_kepala_MDT" required class="border p-2 rounded w-full">
    </div>
    
    <div class="mt-4 text-center">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </div>
</form>
