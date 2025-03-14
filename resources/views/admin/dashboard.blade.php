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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


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
        <h1 class="block text-black font-bold">Filter Berdasarkan:</h1>
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

    <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Terapkan Filter</button>
</form>
                <div x-data="{ openModal: false, formHtml: '' }">
                <!--tambah lembaga-->
                <div x-data="{ openModal: false }">

                            <!-- Tombol untuk membuka modal -->
                            <a href="#" @click="openModal = true" 
                            class="flex items-center justify-between p-2 text-gray-300 hover:bg-gray-700 rounded cursor-pointer">
                                <div class="flex items-center">
                                    <i data-lucide="building"></i>
                                    <span class="ml-2">Tambah Data</span>
                                </div>
                                <i data-lucide="chevron-down"></i>
                            </a>

                            <!-- Popup Modal Tambah Lembaga -->
                            <div x-show="openModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-5xl h-[90vh] overflow-y-auto" @click.away="openModal = false">
                                <h2 class="text-2xl text-black font-semibold mb-4 text-center">Tambah Data</h2>

                                <!-- Form Tambah Lembaga -->
                                <form action="{{ route('lembaga.store') }}" method="POST">
                                    @csrf
                                    <div class="grid grid-cols-3 gap-4">
                                        <div>
                                            <label class="text-black">Kode MDT:</label>
                                            <input type="text" name="kode_mdt" required class="border p-2 rounded w-full">
                                        </div>
                                        <div>
                                            <label class="text-black">Nama Lembaga MDT:</label>
                                            <input type="text" name="nama_lembaga_MDT" required class="border p-2 rounded w-full">
                                        </div>
                                        <div>
                                            <label class="text-black">Alamat Madrasah:</label>
                                            <input type="text" name="alamat_madrasah" required class="border p-2 rounded w-full">
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-3 gap-4 mt-4">
                                        <div>
                                            <label class="text-black">RT:</label>
                                            <input type="text" name="rt" class="border p-2 rounded w-full">
                                        </div>
                                        <div>
                                            <label class="text-black">RW:</label>
                                            <input type="text" name="rw" class="border p-2 rounded w-full">
                                        </div>
                                        <div>
                                            <label class="text-black">Desa:</label>
                                            <input type="text" name="desa" required class="border p-2 rounded w-full">
                                        </div>
                                        <div>
                                            <label class="text-black">Kecamatan:</label>
                                            <input type="text" name="kecamatan" required class="border p-2 rounded w-full">
                                        </div>
                                        <div>
                                            <label class="text-black">NSDT:</label>
                                            <input type="text" name="nsdt" class="border p-2 rounded w-full">
                                        </div>
                                        <div>
                                            <label class="text-black">No HP:</label>
                                            <input type="text" name="no_hp" required class="border p-2 rounded w-full">
                                        </div>
                                        <div>
                                            <label class="text-black">Nama Kepala MDT:</label>
                                            <input type="text" name="nama_kepala_MDT" required class="border p-2 rounded w-full">
                                        </div>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded text-lg">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
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
        <div class="dropdown">
            <button class="btn text-white fw-bold px-4 py-2" type="button" id="importDropdown"
                onclick="toggleImportDropdown()"
                style="background: #007bff; border: none; border-radius: 8px;">
                Import
            </button>

            <div id="importMenu" class="dropdown-menu p-3 shadow text-center"
                style="border-radius: 10px; min-width: 250px; display: none;">
                
                <!-- Button Download Template -->
                <button class="btn btn-primary w-100 mb-2 fw-bold" onclick="window.location.href='{{ route('download.template') }}'">
                    Download Template
                </button>

                <!-- Form Upload File -->
                <form action="{{ route('import.excel') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" class="form-control mb-2" required>
                    <button type="submit" class="btn text-white fw-bold w-100 py-2"
                        style="background: linear-gradient(90deg, #28a745 0%, #218838 100%);
                        border: none; border-radius: 6px;">
                        Upload File
                    </button>
                </form>
            </div>
        </div>
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

    <div id="hidden-data" class="hidden mt-4 overflow-auto">
    </div>
</div>

<!--Script--><script>
    document.addEventListener("DOMContentLoaded", () => {
        lucide.createIcons();

        // Toggle menu pengguna
        const userMenuButton = document.getElementById('user-menu-button');
        const userMenu = document.getElementById('user-menu');

        userMenuButton.addEventListener('click', () => {
            userMenu.classList.toggle('hidden');
        });

        document.addEventListener('click', (event) => {
            if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });

        // Tampilkan data tersembunyi
        const viewAllButton = document.getElementById('view-all-btn');
        if (viewAllButton) {
            viewAllButton.addEventListener('click', function () {
                document.getElementById('hidden-data').classList.toggle('hidden');
                this.style.display = 'none';
            });
        }

        // Event listener perubahan pada select kecamatan
        const kecamatanSelect = document.getElementById('kecamatan');
        const desaSelect = document.getElementById('desa');

        if (kecamatanSelect && desaSelect) {
            kecamatanSelect.addEventListener('change', function () {
                fetchDesa(this.value, desaSelect);
            });
        }

        // Event listener perubahan warna pada select
        const selects = document.querySelectorAll("select");
        selects.forEach(select => {
            select.addEventListener("change", function () {
                this.classList.toggle("bg-green-500", this.value !== "");
                this.classList.toggle("bg-red-500", this.value === "");
            });
        });

        // Perubahan warna saat filter dikirim
        const filterForm = document.getElementById("filter-form");
        if (filterForm) {
            filterForm.addEventListener("submit", function () {
                selects.forEach(select => {
                    select.classList.remove("bg-red-500");
                    select.classList.add("bg-green-500");
                });
            });
        }
    });

    // Fungsi untuk mengambil daftar desa berdasarkan kecamatan
    function fetchDesa(kecamatan, desaDropdown) {
        desaDropdown.innerHTML = '<option value="">Semua Desa</option>';

        if (kecamatan) {
            fetch(`/get-desa?kecamatan=${encodeURIComponent(kecamatan)}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(desa => {
                        let option = document.createElement('option');
                        option.value = desa;
                        option.textContent = desa;
                        desaDropdown.appendChild(option);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    }

    // jQuery untuk pengambilan desa
    $(document).ready(function () {
        $('#kecamatan').change(function () {
            var kecamatan = $(this).val();
            $('#desa').html('<option>Loading...</option>');

            $.ajax({
                url: '/get-desa',
                type: 'GET',
                data: { kecamatan: kecamatan },
                success: function (data) {
                    $('#desa').html('<option value="">Semua Desa</option>');
                    $.each(data, function (index, desa) {
                        $('#desa').append('<option value="' + desa + '">' + desa + '</option>');
                    });
                }
            });
        });
    });

    // Alpine.js untuk modal tambah lembaga
    document.addEventListener('alpine:init', () => {
        Alpine.data('tambahLembaga', () => ({
            openModal: false,
            form: {
                kode_mdt: 'MDT' + Date.now(),
                nama_lembaga_MDT: '',
                alamat_madrasah: '',
                rt: '',
                rw: '',
                desa: '',
                kecamatan: '',
                nsdt: '',
                no_hp: '',
                nama_kepala_MDT: '',
            },
            get isFormValid() {
                return this.form.nama_lembaga_MDT && this.form.alamat_madrasah && this.form.desa && this.form.kecamatan;
            },
            async submitForm() {
                try {
                    let response = await fetch("{{ route('admin.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify(this.form)
                    });

                    let data = await response.json();
                    alert(data.message);
                    this.openModal = false;
                } catch (error) {
                    console.error("Error:", error);
                }
            }
        }));
    });
    function toggleImportDropdown() {
        var menu = document.getElementById("importMenu");
        menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "block" : "none";
    }

    // Close dropdown when clicking outside
    document.addEventListener("click", function(event) {
        var dropdown = document.getElementById("importMenu");
        var button = document.getElementById("importDropdown");
        if (!button.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = "none";
        }
    });
      // Update form download dengan filter yang dipilih
      document.getElementById("filter-form").addEventListener("change", function() {
        document.getElementById("export-kecamatan").value = document.getElementById("kecamatan").value;
        document.getElementById("export-desa").value = document.getElementById("desa").value;
        document.getElementById("export-kode_mdt").value = document.getElementById("kode_mdt").value;
    });

    // Update nilai filter ke form export saat halaman dimuat ulang
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("export-kecamatan").value = document.getElementById("kecamatan").value;
        document.getElementById("export-desa").value = document.getElementById("desa").value;
        document.getElementById("export-kode_mdt").value = document.getElementById("kode_mdt").value;
    });
</script>

</body>
</html>
