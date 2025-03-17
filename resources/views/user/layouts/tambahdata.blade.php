<div x-data="{ openModal: false }">
    <!-- Tombol untuk membuka modal -->
    <a href="#" @click="openModal = true" 
       class="flex items-center justify-between p-2 text-gray-300 hover:bg-gray-700 rounded cursor-pointer">
        <div class="flex items-center">
            <i data-lucide="building"></i>
            <span class="ml-2">Tambah Data</span>
        </div>
    </a>

    <!-- Popup Modal Tambah Lembaga -->
    <div x-show="openModal" x-cloak class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-5xl h-[90vh] overflow-y-auto" @click.away="openModal = false">
            <h2 class="text-2xl text-black font-semibold mb-4 text-center">Tambah Data</h2>
            <button @click="openModal = false" class="absolute top-2 right-2 text-black">✖</button>

            <!-- Form -->
            <form action="{{ route('lembaga.store') }}" method="POST">
                @csrf
                <div>
                    <label class="text-black">Kode MDT:</label>
                    <input type="text" name="kode_mdt" required class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Nama Lembaga MDT:</label>
                    <input type="text" name="nama_lembaga_MDT" required class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Alamat Madrasah:</label>
                    <input type="text" name="alamat_madrasah" required class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
            <div class="grid grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="text-black">RT:</label>
                    <input type="number" name="rt" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">RW:</label>
                    <input type="number" name="rw" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Desa:</label>
                    <input type="text" name="desa" required class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Kecamatan:</label>
                    <input type="text" name="kecamatan" required class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">NSDT:</label>
                    <input type="number" name="nsdt" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">No HP:</label>
                    <input type="number" name="no_hp" required class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Nama Kepala MDT:</label>
                    <input type="text" name="nama_kepala_MDT" required class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">NIS:</label>
                    <input type="number" name="nis" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">NISN:</label>
                    <input type="number" name="nisn" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">No Urut Santri Diniyah:</label>
                    <input type="number" name="no_urut_santri_diniyah" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Nama Santri:</label>
                    <input type="text" name="nama_santri" required class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Jenis Kelamin:</label>
                    <select name="jenis_kelamin" class="border p-2 rounded w-full text-black">
                        <option value="-">-</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="text-black">Tempat Lahir:</label>
                    <input type="text" name="tempat_lahir" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Tanggal Lahir:</label>
                    <input type="date" name="tanggal_lahir" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Nama Ayah:</label>
                    <input type="text" name="nama_ayah" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Nama Ibu:</label>
                    <input type="text" name="nama_ibu" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Alamat Siswa KP:</label>
                    <input type="text" name="alamat_siswa_kp" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Alamat Siswa RT:</label>
                    <input type="number" name="alamat_siswa_rt" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Alamat Siswa RW:</label>
                    <input type="number" name="alamat_siswa_rw" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Alamat Siswa Desa:</label>
                    <input type="text" name="alamat_siswa_desa" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Alamat Siswa Kecamatan:</label>
                    <input type="text" name="alamat_siswa_kecamatan" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">Asal Sekolah Formal:</label>
                    <input type="text" name="asal_sekolah_formal" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
                <div>
                    <label class="text-black">NIK Santri:</label>
                    <input type="number" name="NIK_Santri" class="border p-2 rounded w-full text-white" oninput="this.style.backgroundColor = this.value ? 'green' : 'white'">
                </div>
            </div>
            <div class="mt-4 text-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded text-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>
</div>
</nav>
</aside>
