<main class="flex-1 p-3 md:p-4 relative overflow-x-auto overflow-y-auto">

    <!-- User Profile (Top Right) -->
    <div class="absolute top-0 right-0 m-3 flex items-center">
        <span class="mr-2 text-sm font-semibold">{{ Auth::user()->name }}</span>
        <div class="relative">
            <button id="user-menu-button" class="flex items-center space-x-2 p-2 bg-gray-200 rounded-full focus:outline-none">
                <img src="{{ asset('images/FKDT.png') }}" alt="User" class="w-7 h-7 rounded-full">
            </button>
            <div id="user-menu" class="hidden absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg">
                <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Ubah Password</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</button>
                </form>
            </div>
        </div>
    </div>

   <!-- Statistik -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mt-12">
    <div class="p-6  text-black shadow-lg rounded-xl transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-center text-center">
        <h2 class="text-lg font-semibold">Jumlah Lembaga</h2>
        <p class="text-3xl font-bold">{{ $jumlah_lembaga }}</p>
        <div class="h-24 w-full">
            <canvas id="chartLembaga"></canvas>
        </div>
    </div>
    <div class="p-6  text-black  shadow-lg rounded-xl transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-center text-center">
        <h2 class="text-lg font-semibold">Jumlah Santri</h2>
        <p class="text-3xl font-bold">{{ $jumlah_santri }}</p>
        <div class="h-24 w-full">
            <canvas id="chartSantri"></canvas>
        </div>
    </div>
    <div class="p-6  text-black  shadow-lg rounded-xl transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-center text-center">
        <h2 class="text-lg font-semibold">Jumlah Desa</h2>
        <p class="text-3xl font-bold">{{ $jumlah_desa }}</p>
        <div class="h-24 w-full">
            <canvas id="chartDesa"></canvas>
        </div>
    </div>
    <div class="p-6  text-black  shadow-lg rounded-xl transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-center text-center">
        <h2 class="text-lg font-semibold">Jumlah Kecamatan</h2>
        <p class="text-3xl font-bold">{{ $jumlah_kecamatan }}</p>
        <div class="h-24 w-full">
            <canvas id="chartKecamatan"></canvas>
        </div>
    </div>
    <div class="p-6  text-black  shadow-lg rounded-xl transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-center text-center">
        <h2 class="text-lg font-semibold">Jumlah Santri Laki-laki</h2>
        <p class="text-3xl font-bold">{{ $jumlah_santri_laki }}</p>
        <div class="h-24 w-full">
            <canvas id="chartSantriLaki"></canvas>
        </div>
    </div>
    <div class="p-6  text-black  shadow-lg rounded-xl transform transition duration-300 hover:scale-105 hover:shadow-xl flex flex-col items-center text-center">
        <h2 class="text-lg font-semibold">Jumlah Santri Perempuan</h2>
        <p class="text-3xl font-bold">{{ $jumlah_santri_perempuan }}</p>
        <div class="h-24 w-full">
            <canvas id="chartSantriPerempuan"></canvas>
        </div>
    </div>
</div>



    <!-- Button Download Excel & Import -->
    <div class="mt-4">
        <div class="flex flex-col sm:flex-row items-center gap-3">
            <form method="GET" id="export-form" action="{{ route('export.excel') }}">
                <button type="submit" class="bg-green-500 text-white font-bold py-1.5 px-3 rounded">Download Excel</button>
            </form>
            <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-2">
                @csrf
                <a href="{{ route('download.template') }}" class="bg-blue-500 text-white px-3 py-1.5 rounded">Download Template</a>
                <input type="file" name="file" class="border rounded px-2 py-1 text-sm">
                <button type="submit" class="bg-green-500 text-white px-3 py-1.5 rounded">Upload</button>
            </form>
            <!-- Tombol Hapus Semua Data -->
            <button onclick="openDeleteModal()" class="bg-red-500 text-white px-3 py-1.5 rounded">Hapus Semua Data</button>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-lg font-bold mb-3">Konfirmasi Hapus</h2>
            <p class="mb-2">Masukkan PIN Admin untuk menghapus semua data:</p>
            <input type="password" id="deletePin" class="border p-2 w-full mb-3" placeholder="Masukkan PIN">
            <div class="flex justify-end gap-2">
                <button onclick="closeDeleteModal()" class="bg-gray-500 text-white px-3 py-1.5 rounded">Batal</button>
                <button onclick="submitDelete()" class="bg-red-500 text-white px-3 py-1.5 rounded">Hapus</button>
            </div>
        </div>
    </div>

<!-- Form Hapus yang Tersembunyi -->
<form id="deleteForm" action="{{ route('delete.all') }}" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="pin" id="hiddenPin">
</form>

    @if(session('success'))
        <div class="bg-green-500 text-white p-2 rounded mt-2 text-sm">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-500 text-white p-2 rounded mt-2 text-sm">
            {{ session('error') }}
        </div>
    @endif

    <!-- TABEL DETAIL DATA -->
    <div class="flex flex-col h-[70vh] mt-3">
        <div class="text-center flex-grow">
            @if($data->isEmpty())
                <p class="text-gray-500 text-sm">Tidak ada data yang ditemukan.</p>
            @else
                <div class="max-h-[60vh] overflow-auto border rounded-lg shadow-md p-3 text-sm">
                    @include('database.mastermdt', compact('data'))
                </div>
            @endif
        </div>
    </div>
</main>
