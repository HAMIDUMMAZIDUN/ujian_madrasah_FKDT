<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: true }" class="flex">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-16'" class="h-screen bg-white p-4 shadow-md transition-all duration-300 relative">
            <!-- Sidebar Content (Logo + Button Toggle + Menu) -->
            <div class="flex flex-col justify-between h-full">
                <!-- Logo FKDT and PDUMDT (hidden when sidebar is closed) -->
                <div class="flex items-center mb-4">
                    <div class="flex items-center ml-12 z-10">
                        <!-- Logo FKDT -->
                        <img x-show="sidebarOpen" src="{{ asset('images/FKDT.png') }}" alt="FKDT Logo" class="w-11 h-11">
                        <!-- Text PDUMDT -->
                        <span x-show="sidebarOpen" class="font-semibold text-gray-900 ml-2">PDUMDT</span>
                    </div>
                </div>

                <!-- Pemisah dengan strip tebal, posisi tetap terjaga saat sidebar terbuka/tutup -->
                <div class="border-t-4 border-gray-300 my-4"></div> <!-- Garis pemisah -->

                <!-- Toggle Button (Positioned to the left when sidebar is open) -->
                <button @click="sidebarOpen = !sidebarOpen" class="sidebar-button p-2 text-gray-600 hover:bg-green-500 rounded absolute top-4 left-4 md:left-4 md:top-4 md:right-auto z-20">
                    <i data-lucide="menu"></i>
                </button>

                <!-- Sidebar Menu (always visible, regardless of the sidebar state) -->
                <nav class="space-y-2 mt-6"> <!-- Menambahkan mt-6 untuk memberi jarak antara ikon dan toggle -->
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
                        <span x-show="sidebarOpen" class="ml-2">Ajian Siswa</span>
                    </a>
                </nav>

                <!-- Menu Icons under the Toggle Button (Positioned relative to sidebar) -->
                <div class="mt-auto flex justify-center">
                    <button @click="sidebarOpen = !sidebarOpen" class="sidebar-button p-2 text-gray-600 hover:bg-green-500 rounded">
                        <i data-lucide="menu"></i>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
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
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
