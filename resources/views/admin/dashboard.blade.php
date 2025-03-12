<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('images/FKDT.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100">
<div x-data="{ sidebarOpen: true }" class="flex">
    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-16'" class="h-screen bg-gray-900 text-gray-200 p-4 shadow-md transition-all duration-300 relative">
        <!-- Header Sidebar -->
        <div class="flex items-center">
            <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-400 hover:bg-gray-700 rounded">
                <i data-lucide="menu"></i>
            </button>

            <div class="flex items-center ml-4" x-show="sidebarOpen" x-cloak>
                <img src="{{ asset('images/FKDT.png') }}" alt="FKDT Logo" class="w-10 h-10">
                <span class="ml-2 font-semibold text-white">PDUMDT</span>
            </div>
        </div>

        <div class="border-t-4 border-gray-700 my-4"></div>
        <script src="{{ asset('js/filter.js') }}"></script>

            <!-- Sidebar Menu -->
            <nav class="space-y-2">

             <!-- Search Box -->
            <div class="p-2">
                <input type="text" id="searchBox" placeholder="Search..." class="w-full p-2 border rounded bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            
            <!-- Fitur Menu -->
            <a href="#" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                <i data-lucide="layout-dashboard"></i>
                <span x-show="sidebarOpen" class="ml-2">Dashboard</span>
            </a>

            <!-- FORM FILTER -->
            <form method="GET" action="{{ route('admin.dashboard') }}" id="filter-form" class="p-4 bg-white rounded shadow">
                <div class="mb-4">
                    <label for="kecamatan" class="block text-black font-semibold">Pilih Kecamatan:</label>
                    <select name="kecamatan" id="kecamatan" class="w-full p-2 text-black font-semibold border rounded">
                        <option value="">Semua Kecamatan</option>
                        @foreach($list_kecamatan as $kecamatan)
                            <option value="{{ $kecamatan }}">{{ $kecamatan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="desa" class="block text-black font-semibold">Pilih Desa:</label>
                    <select name="desa" id="desa" class="w-full p-2 text-black font-semibold border rounded">
                        <option value="">Semua Desa</option>
                    </select>
                </div>

                <!-- Button Filter -->
                <button type="submit" class="w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">
                    Filter
                </button>
            </form>


            <!-- Data Lembaga dengan Submenu -->
            <div x-data="{ open: false }">
                <a href="#" @click="open = !open" class="flex items-center justify-between p-2 text-gray-300 hover:bg-gray-700 rounded cursor-pointer">
                    <div class="flex items-center">
                        <i data-lucide="building"></i>
                        <span x-show="sidebarOpen" class="ml-2">Data Lembaga</span>
                    </div>
                    <i data-lucide="chevron-down" x-show="sidebarOpen"></i>
                </a>
                <div x-show="open" class="ml-6 space-y-1" x-collapse>
                    <a href="#" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Profil Sekolah</a>
                    <a href="#" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Tahun Akademik</a>
                    <a href="#" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Buat Rombel Siswa Baru</a>
                    <a href="#" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Pendaftaran Ulang</a>
                    <a href="#" class="block p-2 text-gray-300 hover:bg-gray-700 rounded">Tambahkan Wali Kelas</a>
                </div>
            </div>
            <!-- Data siswa -->
            <a href="#" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                <i data-lucide="users"></i>
                <span x-show="sidebarOpen" class="ml-2">Data Siswa</span>
            </a>
            <a href="#" class="flex items-center p-2 text-gray-300 hover:bg-gray-700 rounded">
                <i data-lucide="clipboard-list"></i>
                <span x-show="sidebarOpen" class="ml-2">Ujian Siswa</span>
            </a>
        </nav>
        </aside>
       


        <!-- Main Content -->
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mt-12">
        <div class="p-4 bg-white shadow rounded-lg text-center">
            <h2 class="text-xl font-semibold">Jumlah Lembaga</h2>
            <p class="text-2xl font-bold">{{ $jumlah_lembaga }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded-lg text-center">
            <h2 class="text-xl font-semibold">Jumlah Santri</h2>
            <p class="text-2xl font-bold">{{ $jumlah_santri }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded-lg text-center">
            <h2 class="text-xl font-semibold">Jumlah Desa</h2>
            <p class="text-2xl font-bold">{{ $jumlah_desa }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded-lg text-center">
            <h2 class="text-xl font-semibold">Jumlah Kecamatan</h2>
            <p class="text-2xl font-bold">{{ $jumlah_kecamatan }}</p>
        </div>
    </div>

    <!-- TABEL DETAIL DATA -->
<div class="mt-6 bg-white p-6 shadow rounded-lg overflow-auto h-[calc(90vh-90px)]">
    <div class="text-center mt-4">
        @if($data->isEmpty())
            <p class="text-gray-500">Tidak ada data yang ditemukan.</p>
        @else
            @include('database.mastermdt', compact('data'))
        @endif
        
        <button id="view-all-btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg mx-auto block">View All</button>
    </div>

    <div id="hidden-data" class="hidden mt-4 overflow-auto">
    </div>
</div>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            lucide.createIcons();

            document.getElementById('user-menu-button').addEventListener('click', function () {
                document.getElementById('user-menu').classList.toggle('hidden');
            });

            document.addEventListener('click', function(event) {
                const menu = document.getElementById('user-menu');
                if (!document.getElementById('user-menu-button').contains(event.target) && !menu.contains(event.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
        document.getElementById('view-all-btn').addEventListener('click', function() {
        document.getElementById('hidden-data').classList.toggle('hidden');
        this.style.display = 'none';
    });
    
document.getElementById('kecamatan').addEventListener('change', function() {
    let kecamatan = this.value;
    let desaDropdown = document.getElementById('desa');

    desaDropdown.innerHTML = '<option value="">Semua Desa</option>'; // Reset opsi

    if (kecamatan) {
        fetch(`/get-desa?kecamatan=${kecamatan}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(desa => {
                    let option = document.createElement('option');
                    option.value = desa;
                    option.textContent = desa;
                    desaDropdown.appendChild(option);
                });
            });
    }
});

$(document).ready(function() {
    $('#kecamatan').change(function() {
        var kecamatan = $(this).val();
        $('#desa').html('<option value="">Loading...</option>'); // Indikator loading

        $.ajax({
            url: '/get-desa',
            type: 'GET',
            data: { kecamatan: kecamatan },
            success: function(data) {
                $('#desa').html('<option value="">Semua Desa</option>'); // Reset opsi
                $.each(data, function(index, desa) {
                    $('#desa').append('<option value="' + desa + '">' + desa + '</option>');
                });
            }
        });
    });
});

document.getElementById("apply-filter").addEventListener("click", function() {
    document.getElementById("filter-form").submit();
});
    </script>
</body>
</html>
