<script>
    lucide.createIcons();

    document.addEventListener("DOMContentLoaded", function () {
    lucide.createIcons();
        
    // Toggle menu pengguna
     document.getElementById('menu-button').addEventListener('click', function () {
        document.getElementById('dropdown-menu').classList.toggle('hidden');
    });

    // Tampilkan data tersembunyi
    const viewAllButton = document.getElementById('view-all-btn');
    if (viewAllButton) {
        viewAllButton.addEventListener('click', function () {
            document.getElementById('hidden-data')?.classList.toggle('hidden');
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
    document.querySelectorAll("select").forEach(select => {
        select.addEventListener("change", function () {
            this.classList.toggle("bg-green-500", this.value !== "");
            this.classList.toggle("bg-red-500", this.value === "");
        });
    });

    // Perubahan warna saat filter dikirim
    const filterForm = document.getElementById("filter-form");
    if (filterForm) {
        filterForm.addEventListener("submit", function () {
            document.querySelectorAll("select").forEach(select => {
                select.classList.remove("bg-red-500");
                select.classList.add("bg-green-500");
            });
        });
    }

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

                if (response.ok) {
                    Swal.fire({
                        title: "Berhasil!",
                        text: data.message,
                        icon: "success",
                        confirmButtonText: "OK"
                    });
                    this.openModal = false;
                } else {
                    throw new Error(data.message || "Terjadi kesalahan");
                }
            } catch (error) {
                Swal.fire({
                    title: "Error!",
                    text: error.message,
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        }
    }));
});


    // Toggle dropdown import
    document.addEventListener("DOMContentLoaded", function () {
    // Toggle dropdown import
    const importButton = document.getElementById("importDropdown");
    const importMenu = document.getElementById("importMenu");

    if (importButton && importMenu) {
        importButton.addEventListener("click", function (event) {
            event.stopPropagation();
            importMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", function (event) {
            if (!importMenu.contains(event.target) && !importButton.contains(event.target)) {
                importMenu.classList.add("hidden");
            }
        });
    }

    // Update form export saat filter berubah
    const filterForm = document.getElementById("filterForm");

    if (filterForm) {
        filterForm.addEventListener("change", function () {
            document.getElementById("export-kecamatan").value = document.getElementById("kecamatan")?.value || "";
            document.getElementById("export-desa").value = document.getElementById("desa")?.value || "";
            document.getElementById("export-kode_mdt").value = document.getElementById("kode_mdt")?.value || "";

            // Menampilkan notifikasi dengan SweetAlert
            Swal.fire({
                title: "Filter Diperbarui!",
                text: "Data export telah diperbarui sesuai filter yang dipilih.",
                icon: "success",
                confirmButtonText: "OK"
            });
        });
    }
});


    // Search box event listener
    const searchBox = document.getElementById('searchBox');
    const resultsBox = document.getElementById('searchResults');
    
    if (searchBox && resultsBox) {
        searchBox.addEventListener('input', function () {
            let query = this.value;
            if (query.length > 2) {
                fetch(`{{ route('search.santri') }}?q=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        resultsBox.innerHTML = '';
                        if (data.length > 0) {
                            resultsBox.classList.remove('hidden');
                            data.forEach(santri => {
                                let li = document.createElement('li');
                                li.textContent = santri.nama;
                                li.classList.add('p-2', 'hover:bg-gray-200', 'cursor-pointer');
                                li.addEventListener('click', function () {
                                    searchBox.value = santri.nama;
                                    resultsBox.classList.add('hidden');
                                });
                                resultsBox.appendChild(li);
                            });
                        } else {
                            resultsBox.classList.add('hidden');
                        }
                    });
            } else {
                resultsBox.classList.add('hidden');
            }
        });
    }
}); 

        //download excel
        document.addEventListener("DOMContentLoaded", function () {
        // Alert saat menekan tombol Download Excel
        document.getElementById("export-form").addEventListener("submit", function (event) {
            event.preventDefault();
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda akan mengunduh file Excel!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Unduh!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });

        // Alert saat menekan tombol Upload
        document.querySelector("form[action$='import.excel']").addEventListener("submit", function (event) {
            event.preventDefault();
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Anda akan mengunggah file ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Upload!"
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });

    //hapus Semua Data
    function openDeleteModal() { 
        document.getElementById("deleteModal").classList.remove("hidden");
    }

    function closeDeleteModal() {
        document.getElementById("deleteModal").classList.add("hidden");
    }

    function submitDelete() {
        let pin = document.getElementById("deletePin").value;
        
        fetch("/hapus-semua-data", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").getAttribute("content")
            },
            body: JSON.stringify({ pin: pin })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: "Berhasil!",
                    text: "Semua data berhasil dihapus!",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then(() => {
                    closeDeleteModal();
                    location.reload();
                });
            } else {
                Swal.fire({
                    title: "Gagal!",
                    text: "Gagal menghapus data: " + data.message,
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        })
        .catch(error => {
            console.error("Error:", error);
            Swal.fire({
                title: "Error!",
                text: "Terjadi kesalahan saat menghapus data.",
                icon: "error",
                confirmButtonText: "OK"
            });
        });
    }

</script>