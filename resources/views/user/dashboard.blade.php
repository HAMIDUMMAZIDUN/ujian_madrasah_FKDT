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
        
        <!--sidebar-->
        @include('admin.layouts.sidebar')
        <div x-data="{ openModal: false, formHtml: '' }">

        <!--tambahData-->
        @include('admin.layouts.tambahdata')
       
        <!-- Main Content -->
        @include('admin.layouts.maincontent')

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
