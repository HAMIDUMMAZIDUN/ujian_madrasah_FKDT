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
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: true }" class="flex">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-16'" class="h-screen bg-white p-4 shadow-md transition-all duration-300 relative">
            <!-- Header Sidebar -->
            <div class="flex items-center">
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-600 hover:bg-gray-200 rounded">
                    <i data-lucide="menu"></i>
                </button>

                <div class="flex items-center ml-4" x-show="sidebarOpen" x-cloak>
                    <img src="{{ asset('images/FKDT.png') }}" alt="FKDT Logo" class="w-10 h-10">
                    <span class="ml-2 font-semibold text-gray-900">PDUMDT</span>
                </div>
            </div>

            <div class="border-t-4 border-gray-300 my-4"></div>

            <!-- Sidebar Menu -->
            <nav class="space-y-2">
                <!-- Search Box -->
                <div class="p-2">
                    <input type="text" placeholder="Search..." class="w-full p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                
                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                    <i data-lucide="layout-dashboard"></i>
                    <span x-show="sidebarOpen" class="ml-2">Dashboard</span>
                </a>
                
                <!-- Data Lembaga dengan Submenu -->
                <div x-data="{ open: false }">
                    <a href="#" @click="open = !open" class="flex items-center justify-between p-2 text-gray-700 hover:bg-gray-200 rounded cursor-pointer">
                        <div class="flex items-center">
                            <i data-lucide="building"></i>
                            <span x-show="sidebarOpen" class="ml-2">Data Lembaga</span>
                        </div>
                        <i data-lucide="chevron-down" x-show="sidebarOpen"></i>
                    </a>
                    <div x-show="open" class="ml-6 space-y-1" x-collapse>
                        <a href="#" class="block p-2 text-gray-700 hover:bg-gray-200 rounded">Profil Sekolah</a>
                        <a href="#" class="block p-2 text-gray-700 hover:bg-gray-200 rounded">Tahun Akademik</a>
                        <a href="#" class="block p-2 text-gray-700 hover:bg-gray-200 rounded">Buat Rombel Siswa Baru</a>
                        <a href="#" class="block p-2 text-gray-700 hover:bg-gray-200 rounded">Pendaftaran Ulang</a>
                        <a href="#" class="block p-2 text-gray-700 hover:bg-gray-200 rounded">Tambahkan Wali Kelas</a>
                    </div>
                </div>
                
                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                    <i data-lucide="users"></i>
                    <span x-show="sidebarOpen" class="ml-2">Data Siswa</span>
                </a>
                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
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
                        <img src="{{ file_exists(public_path('images/' . Auth::user()->name . '.png')) ? asset('images/' . Auth::user()->name . '.png') : asset('images/default.png') }}" 
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
<div class="mt-6 bg-white p-6 shadow rounded-lg overflow-auto h-[calc(100vh-100px)]">
    <div class="text-center mt-4">
        @include('database.mastermdt', compact('data'))
        <button id="view-all-btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg">View All</button>
    </div>
    <div id="hidden-data" class="hidden mt-4 overflow-auto">
        <!-- Data akan muncul di sini -->
    </div>
</div>
</main>

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
    </script>
</body>
</html>
