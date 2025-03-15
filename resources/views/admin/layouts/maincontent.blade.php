<main class="flex-1 p-6 relative overflow-x-auto overflow-y-auto">

            <!-- User Profile (Top Right) -->
            <div class="absolute top-0 right-0 m-4 flex items-center">
                <span class="mr-2 font-semibold">{{ Auth::user()->name }}</span>
                <div class="relative">
                <button id="user-menu-button" class="flex items-center space-x-2 p-2 bg-gray-200 rounded-full focus:outline-none">
                    <img src="{{ asset('images/FKDT.png') }}" 
                        alt="User" class="w-8 h-8 rounded-full">
                </button>

                    <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg">
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Ubah Password</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-200">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
                   
        <!-- Statistik -->
            <br>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-12">
                <div class="p-4 bg-blue-500 text-white shadow rounded-lg text-center">
                    <div class="flex justify-center mb-2">
                        <i data-lucide="school" class="w-8 h-8"></i>
                    </div>
                    <h2 class="text-xl font-semibold">Jumlah Lembaga</h2>
                    <p class="text-2xl font-bold">{{ $jumlah_lembaga }}</p>
                </div>
                <div class="p-4 bg-green-500 text-white shadow rounded-lg text-center">
                    <div class="flex justify-center mb-2">
                        <i data-lucide="users" class="w-8 h-8"></i>
                    </div>
                    <h2 class="text-xl font-semibold">Jumlah Santri</h2>
                    <p class="text-2xl font-bold">{{ $jumlah_santri }}</p>
                </div>
                <div class="p-4 bg-yellow-500 text-white shadow rounded-lg text-center">
                    <div class="flex justify-center mb-2">
                        <i data-lucide="map-pin" class="w-8 h-8"></i>
                    </div>
                    <h2 class="text-xl font-semibold">Jumlah Desa</h2>
                    <p class="text-2xl font-bold">{{ $jumlah_desa }}</p>
                </div>
                <div class="p-4 bg-red-500 text-white shadow rounded-lg text-center">
                    <div class="flex justify-center mb-2">
                        <i data-lucide="map" class="w-8 h-8"></i>
                    </div>
                    <h2 class="text-xl font-semibold">Jumlah Kecamatan</h2>
                    <p class="text-2xl font-bold">{{ $jumlah_kecamatan }}</p>
                </div>
                <div class="p-4 bg-pink-500 text-white shadow rounded-lg text-center">
                    <div class="flex justify-center mb-2">
                        <i data-lucide="users" class="w-8 h-8"></i>
                    </div>
                    <h2 class="text-xl font-semibold">Jumlah Santri laki-laki</h2>
                    <p class="text-2xl font-bold">{{ $jumlah_santri_laki }}</p>
                </div>
                <div class="p-4 bg-pink-500 text-white shadow rounded-lg text-center">
                    <div class="flex justify-center mb-2">
                        <i data-lucide="users" class="w-8 h-8"></i>
                    </div>
                    <h2 class="text-xl font-semibold">Jumlah Santri Perempuan</h2>
                    <p class="text-2xl font-bold">{{ $jumlah_santri_perempuan }}</p>
                </div>
            </div>

            <!-- Button Download Excel & Import -->
            <br>
            <div class="container-fluid">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <!-- Tombol Download Excel -->
                    <form method="GET" id="export-form" action="{{ route('export.excel') }}">
                        <input type="hidden" name="kecamatan" id="export-kecamatan">
                        <input type="hidden" name="desa" id="export-desa">
                        <input type="hidden" name="kode_mdt" id="export-kode_mdt"> 
                        <button type="submit" class="bg-green-500 text-white font-bold py-2 px-3 rounded">
                            Download Excel
                        </button>
                    </form>

            <!-- Button Import -->
            <!-- resources/views/import.blade.php -->
            <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <a href="{{ route('download.template') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Download Template</a>
                <input type="file" name="file" class="mt-2">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Upload</button>
            </form>
                </div>
            </div>
        </div>
    </div>

            @if(session('success'))
                <script>
                    Swal.fire({
                        title: "Sukses!",
                        text: "{{ session('success') }}",
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                </script>
            @endif

            @if(session('error'))
                <script>
                    Swal.fire({
                        title: "Gagal!",
                        text: "{{ session('error') }}",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                </script>
            @endif
            
                <!-- TABEL DETAIL DATA -->
            <div class="mt-6 bg-white p-6 shadow rounded-lg overflow-auto h-[calc(90vh-90px)]">
                <div class="text-center mt-4">
                    @if($data->isEmpty())
                        <p class="text-gray-500">Tidak ada data yang ditemukan.</p>
                    @else
                        @include('database.mastermdt', compact('data'))
                    @endif

                    <div id="hidden-data" class="hidden mt-4 overflow-auto">
                </div>
            </div>