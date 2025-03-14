
<script>
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
    document.getElementById('searchBox').addEventListener('input', function () {
        let query = this.value;
        let resultsBox = document.getElementById('searchResults');
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
                                document.getElementById('searchBox').value = santri.nama;
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
    function generateNoPeserta() {
        fetch("{{ route('generate.no_peserta') }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("noPeserta").innerText = "No Peserta: " + data.no_peserta;
        })
        .catch(error => console.error('Error:', error));
    }
    
</script>