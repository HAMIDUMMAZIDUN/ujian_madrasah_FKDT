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
            <!-- Header Sidebar (Toggle + Logo + Teks) -->
            <div class="flex items-center">
                <!-- Toggle Button -->
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 text-gray-600 hover:bg-gray-200 rounded">
                    <i data-lucide="menu"></i>
                </button>

                <!-- Logo + Teks -->
                <div class="flex items-center ml-4" x-show="sidebarOpen" x-cloak>
                    <img src="{{ asset('images/FKDT.png') }}" alt="FKDT Logo" class="w-10 h-10">
                    <span class="ml-2 font-semibold text-gray-900">PDUMDT</span>
                </div>
            </div>

            <div class="border-t-4 border-gray-300 my-4"></div>

            <!-- Sidebar Menu -->
            <nav class="space-y-2">
                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                    <i data-lucide="layout-dashboard"></i>
                    <span x-show="sidebarOpen" class="ml-2">Dashboard</span>
                </a>
                <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                    <i data-lucide="building"></i>
                    <span x-show="sidebarOpen" class="ml-2">Data Lembaga</span>
                </a>
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
        <main class="flex-1 p-6 relative">
            <!-- User Profile (Top Right) -->
            <div class="absolute top-0 right-0 m-4 flex items-center">
                <span class="mr-2 font-semibold">{{ Auth::user()->name }}</span>
                <div class="relative">
                    <button id="user-menu-button" class="flex items-center space-x-2 p-2 bg-gray-200 rounded-full focus:outline-none">
                    <img src="{{ file_exists(public_path('images/' . Auth::user()->name . '.png')) 
                        ? asset('images/' . Auth::user()->name . '.png') 
                        : asset('images/default.png') }}" 
                        alt="User" class="w-8 h-8 rounded-full">
                    </button>
                    <div id="user-menu" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-lg">
                        <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Ubah Password</a>
                        
                        <!-- Form Logout -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>

                        <button id="logout-button" class="w-full text-left px-4 py-2 text-gray-800 hover:bg-gray-200">
                            Logout
                        </button>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-12">
                <div class="p-4 bg-white shadow rounded-lg">
                    <h2 class="text-xl font-semibold">Jumlah Siswa</h2>
                    <p class="text-2xl font-bold">172</p>
                </div>
                <div class="p-4 bg-white shadow rounded-lg">
                    <h2 class="text-xl font-semibold">Siswa Lengkap</h2>
                    <p class="text-2xl font-bold">172</p>
                </div>
                <div class="p-4 bg-white shadow rounded-lg">
                    <h2 class="text-xl font-semibold">Generate Nopes</h2>
                    <p class="text-2xl font-bold">172</p>
                </div>
                <div class="p-4 bg-white shadow rounded-lg">
                    <h2 class="text-xl font-semibold">Bergabung</h2>
                    <p class="text-2xl font-bold">0</p>
                </div>
            </div>

            <div class="mt-6 bg-white p-6 shadow rounded-lg">
                <h2 class="text-xl font-semibold">Info PDUM</h2>
                <p>Pendataan Peserta Asesmen Madrasah (AM) tahun pelajaran 2024/2025...</p>
            </div>
        </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            lucide.createIcons();

            document.getElementById('user-menu-button').addEventListener('click', function () {
                document.getElementById('user-menu').classList.toggle('hidden');
            });

            document.getElementById('logout-button').addEventListener('click', function () {
                if (confirm("Apakah Anda yakin ingin logout?")) {
                    document.getElementById('logout-form').submit();
                }
            });
        });
    </script>
</body>
</html>
