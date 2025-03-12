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
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

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

        <!--Filter-->
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
                        <h1 class="block text-black font-bold">Filter Berdasarkan : </h1>
                        <br>

                        <!-- Pilih Kecamatan -->
                        <label for="kecamatan" class="block text-black font-semibold">Pilih Kecamatan</label>
                        <select name="kecamatan" id="kecamatan" class="w-full p-2 text-white font-semibold border rounded bg-red-500">
                            <option value="">Semua Kecamatan</option>
                            @foreach($list_kecamatan as $kecamatan)
                                <option value="{{ $kecamatan }}">{{ $kecamatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Desa -->
                    <div class="mb-4">
                        <label for="desa" class="block text-black font-semibold">Pilih Desa</label>
                        <select name="desa" id="desa" class="w-full p-2 text-white font-semibold border rounded bg-red-500">
                            <option value="">Semua Desa</option>
                        </select>
                    </div>

                    <!-- Pilih Kode MDT -->
                    <div class="mb-4">
                        <label for="kode_mdt" class="block text-black font-semibold">Pilih Kode MDT</label>
                        <select name="kode_mdt" id="kode_mdt" class="w-full p-2 text-white font-semibold border rounded bg-red-500">
                            <option value="">Semua Kode MDT</option>
                            @foreach($list_kode_mdt as $kode)
                                <option value="{{ $kode }}">{{ $kode }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Button Filter -->
                    <button type="submit" id="cari-btn" class="w-full bg-green-500 text-white p-2 rounded hover:bg-green-600">
                        Cari
                    </button>
                </form>
                <div x-data="{ openModal: false, formHtml: '' }">

                    <!-- Tombol untuk membuka modal -->
                    <a href="#" @click="openModal = true" 
                    class="flex items-center justify-between p-2 text-gray-300 hover:bg-gray-700 rounded cursor-pointer">
                        <div class="flex items-center">
                            <i data-lucide="building"></i>
                            <span class="ml-2">Data Lembaga</span>
                        </div>
                        <i data-lucide="chevron-down"></i>
                    </a>

                    <!-- Popup Modal Tambah Lembaga -->
                    <div x-show="openModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                            <h2 class="text-xl font-semibold mb-4">Tambah Lembaga</h2>

                            <!-- Form Tambah Lembaga -->
                            <form @submit.prevent="submitForm">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Kode MDT</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded-lg bg-gray-200" placeholder="Otomatis diisi" readonly>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Nama Lembaga MDT</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Masukkan Nama Lembaga">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Alamat Madrasah</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Masukkan Alamat Madrasah">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">RT</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Masukkan RT">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">RW</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Masukkan RW">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Desa</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Masukkan Desa">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Kecamatan</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Masukkan Kecamatan">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">NSDT</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Masukkan NSDT">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">No HP</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Masukkan No HP">
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Nama Kepala MDT</label>
                                    <input type="text" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" placeholder="Masukkan Nama Kepala MDT">
                                </div>
                            </form>

                                <!-- Tombol Simpan -->
                                <div class="flex justify-end space-x-2">
                                    <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Batal</button>
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Simpan</button>
                                </div>
                            </form>
                        </div>
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
    </div>


    <!-- Button Download Excel -->
     <br>
    <div class="flex right mb-4">
        <a href="{{ route('admin.downloadExcel') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Download Excel
        </a>
    </div>

    <!-- TABEL DETAIL DATA -->
<div class="mt-6 bg-white p-6 shadow rounded-lg overflow-auto h-[calc(90vh-90px)]">
    <div class="text-center mt-4">
        @if($data->isEmpty())
            <p class="text-gray-500">Tidak ada data yang ditemukan.</p>
        @else
            @include('database.mastermdt', compact('data'))
        @endif

    <!--Button View All-->
        <button id="view-all-btn" class="bg-blue-500 text-white px-4 py-2 rounded-lg mx-auto block">View All</button>
    </div>

    <div id="hidden-data" class="hidden mt-4 overflow-auto">
    </div>
</div>

<!--Script-->
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

document.addEventListener("DOMContentLoaded", function () {
        const selects = document.querySelectorAll("select");
        const cariButton = document.getElementById("cari-btn");

        selects.forEach(select => {
            select.addEventListener("change", function () {
                if (this.value !== "") {
                    this.classList.remove("bg-red-500");
                    this.classList.add("bg-green-500");
                } else {
                    this.classList.remove("bg-green-500");
                    this.classList.add("bg-red-500");
                }
            });
        });

        document.getElementById("filter-form").addEventListener("submit", function () {
            selects.forEach(select => {
                select.classList.remove("bg-red-500");
                select.classList.add("bg-green-500");
            });
        });
    });
    function submitForm() {
    let formData = {
        kecamatan: document.querySelector('[placeholder="Masukkan Kecamatan"]').value,
        desa: document.querySelector('[placeholder="Masukkan Desa"]').value,
        kode_mdt: document.querySelector('[placeholder="Otomatis diisi"]').value,
        nama_lembaga: document.querySelector('[placeholder="Masukkan Nama Lembaga"]').value,
    };

    fetch("{{ route('admin.simpan_lembaga') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify(formData)
    }).then(response => response.json())
      .then(data => {
          alert("Data berhasil ditambahkan!");
          openModal = false; // Tutup modal setelah sukses
      }).catch(error => console.error("Gagal:", error));

        function fetchForm() {
        fetch("{{ route('lembaga.create') }}")
            .then(response => response.text())
            .then(html => {
                document.querySelector('[x-html="formHtml"]').innerHTML = html;
            });
    }
}
    </script>
</body>
</html>
