<table class="table-auto w-full border-collapse border border-gray-300">
    <thead>
        <tr class="bg-gray-200">
            <th class="border border-gray-300 px-4 py-2">NO</th>
            <th class="border border-gray-300 px-4 py-2">Kode MDT</th>
            <th class="border border-gray-300 px-4 py-2">Nama Lembaga</th>
            <th class="border border-gray-300 px-4 py-2">Alamat Madrasah</th>
            <th class="border border-gray-300 px-4 py-2">RT</th>
            <th class="border border-gray-300 px-4 py-2">RW</th>
            <th class="border border-gray-300 px-4 py-2">Desa</th>
            <th class="border border-gray-300 px-4 py-2">Kecamatan</th>
            <th class="border border-gray-300 px-4 py-2">NSDT</th>
            <th class="border border-gray-300 px-4 py-2">No HP</th>
            <th class="border border-gray-300 px-4 py-2">Nama Kepala Madrasah</th>
            <th class="border border-gray-300 px-4 py-2">No Peserta Ujian</th>
            <th class="border border-gray-300 px-4 py-2">NIS</th>
            <th class="border border-gray-300 px-4 py-2">NISN</th>
            <th class="border border-gray-300 px-4 py-2">NIK Santri</th>
            <th class="border border-gray-300 px-4 py-2">No Urut Santri Lembaga Diniyah</th>
            <th class="border border-gray-300 px-4 py-2">Nama santri</th>
            <th class="border border-gray-300 px-4 py-2">Jenis Kelamin</th>
            <th class="border border-gray-300 px-4 py-2">Tempat Lahir</th>
            <th class="border border-gray-300 px-4 py-2">Tanggal Lahir</th>
            <th class="border border-gray-300 px-4 py-2">Nama Ayah</th>
            <th class="border border-gray-300 px-4 py-2">Nama Ibu</th>
            <th class="border border-gray-300 px-4 py-2">Alamat Santri</th>
            <th class="border border-gray-300 px-4 py-2">Alamat Santri RT</th>
            <th class="border border-gray-300 px-4 py-2">Alamat Santri RW</th>
            <th class="border border-gray-300 px-4 py-2">Alamat Santri Desa</th>
            <th class="border border-gray-300 px-4 py-2">Alamat Santri Kecamatan</th>
            <th class="border border-gray-300 px-4 py-2">Asal Sekolah Formal</th>
            <th class="border border-gray-300 px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->kode_mdt}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nama_lembaga_MDT }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->alamat_madrasah}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->rt}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->rw}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->desa}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->kecamatan }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nsdt}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->no_hp }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nama_kepala_MDT }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->no_peserta_ujian}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nis }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nisn}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->NIK_Santri}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->no_peserta ?? 'Belum Digenerate' }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nama_santri}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->jenis_kelamin}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->tempat_lahir }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->tanggal_lahir}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nama_ayah}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nama_ibu}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->alamat_siswa_kp}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->alamat_siswa_rt}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->alamat_siswa_rw}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->alamat_siswa_desa}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->alamat_siswa_kec}}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->asal_sekolah_formal}}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">
                <button onclick="openEditModal({{ $item->id }}, '{{ $item->kode_mdt }}', '{{ $item->nama_lembaga_MDT }}', '{{ $item->alamat_madrasah }}', '{{ $item->kecamatan }}')" class="bg-blue-500 text-white px-3 py-1 rounded">Edit</button>
                <form action="{{ route('delete', $item->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal Edit -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-xl font-bold mb-4">Edit Lembaga</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" id="editId" name="id">

            <div class="mb-4">
            <label class="block text-gray-700">Kode MDT</label>
            <input type="text" id="editKode" name="kode_mdt" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Nama Lembaga</label>
                <input type="text" id="editNama" name="nama_lembaga_MDT" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Alamat Madrasah</label>
                <input type="text" id="editAlamat" name="alamat_madrasah" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">RT</label>
                <input type="text" id="editRT" name="rt" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">RW</label>
                <input type="text" id="editRW" name="rw" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Desa</label>
                <input type="text" id="editDesa" name="desa" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Kecamatan</label>
                <input type="text" id="editKecamatan" name="kecamatan" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">NSDT</label>
                <input type="text" id="editNsdt" name="nsdt" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">No HP</label>
                <input type="text" id="editNoHp" name="no_hp" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Nama Kepala MDT</label>
                <input type="text" id="editKepala" name="nama_kepala_MDT" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">No Peserta Ujian</label>
                <input type="text" id="editNoPeserta" name="no_peserta_ujian" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">NIS</label>
                <input type="text" id="editNIS" name="nis" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">NISN</label>
                <input type="text" id="editNISN" name="nisn" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">No Urut Santri Diniyah</label>
                <input type="text" id="editNoUrut" name="no_urut_santri_diniyah" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Nama Santri</label>
                <input type="text" id="editNamaSantri" name="nama_santri" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Jenis Kelamin</label>
                <input type="text" id="editJenisKelamin" name="jenis_kelamin" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Tempat Lahir</label>
                <input type="text" id="editTempatLahir" name="tempat_lahir" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Tanggal Lahir</label>
                <input type="date" id="editTanggalLahir" name="tanggal_lahir" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Nama Ayah</label>
                <input type="text" id="editNamaAyah" name="nama_ayah" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Nama Ibu</label>
                <input type="text" id="editNamaIbu" name="nama_ibu" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Asal Sekolah Formal</label>
                <input type="text" id="editAsalSekolah" name="asal_sekolah_formal" class="w-full border p-2 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">NIK Santri</label>
                <input type="text" id="editNIKSantri" name="NIK_Santri" class="w-full border p-2 rounded">
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
            </div>

        </form>
    </div>
</div>

<!-- Script Modal -->
<script>
    function openEditModal(id, kode, nama, alamat, kecamatan) {
        document.getElementById('editId').value = id;
        document.getElementById('editKode').value = kode;
        document.getElementById('editNama').value = nama;
        document.getElementById('editAlamat').value = alamat;
        document.getElementById('editKecamatan').value = kecamatan;

        document.getElementById('editForm').action = "/update/" + id;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
