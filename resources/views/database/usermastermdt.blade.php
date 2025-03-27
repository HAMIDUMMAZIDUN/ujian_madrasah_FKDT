@php
    use Illuminate\Support\Facades\Auth;
@endphp

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
            <th class="border border-gray-300 px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data->where('kecamatan', Auth::user()->name) as $item)
        <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->kode_mdt }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nama_lembaga_MDT }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->alamat_madrasah }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->rt }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->rw }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->desa }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->kecamatan }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nsdt }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->no_hp }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->nama_kepala_MDT }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $item->no_peserta_ujian ?? 'Belum Digenerate' }}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">
                <button onclick="openEditModal({{ json_encode($item) }})"
                        class="bg-blue-500 text-white px-3 py-1 rounded">Edit</button>
                <form action="{{ route('delete', $item->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
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
        <form id="editForm" action="{{ route('master_mdt.update') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editId" name="id">

            <div class="container mx-auto p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-gray-700">Kode MDT</label>
                        <input type="text" id="editKode" name="kode_mdt" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Nama Lembaga</label>
                        <input type="text" id="editNama" name="nama_lembaga_MDT" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Alamat Madrasah</label>
                        <input type="text" id="editAlamat" name="alamat_madrasah" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">RT</label>
                        <input type="text" id="editRT" name="rt" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">RW</label>
                        <input type="text" id="editRW" name="rw" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Desa</label>
                        <input type="text" id="editDesa" name="desa" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Kecamatan</label>
                        <input type="text" id="editKecamatan" name="kecamatan" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">NSDT</label>
                        <input type="text" id="editNsdt" name="nsdt" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">No HP</label>
                        <input type="text" id="editNoHp" name="no_hp" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Nama Kepala MDT</label>
                        <input type="text" id="editKepala" name="nama_kepala_MDT" class="w-full border p-2 rounded">
                    </div>
                    <div>
                    <label class="block text-gray-700">No Peserta Ujian</label>
                    <div class="flex gap-2">
                        <input type="text" id="editNoPeserta" name="no_peserta_ujian" class="w-full border p-2 rounded">
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700">NIS</label>
                        <input type="text" id="editNIS" name="nis" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">NISN</label>
                        <input type="text" id="editNISN" name="nisn" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">NIK Santri</label>
                        <input type="text" id="editniksantri" name="NIK_santri" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">No Urut Santri Diniyah</label>
                        <input type="text" id="editNoUrut" name="no_urut_santri_diniyah" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Nama Santri</label>
                        <input type="text" id="editnamasantri" name="nama_santri" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Janis Kelamin</label>
                        <input type="text" id="editjeniskelamin" name="jenis_kelamin" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Tempat Lahir</label>
                        <input type="text" id="edittempatlahir" name="tempat_lahir" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Tanggal Lahir</label>
                        <input type="text" id="edittanggallahir" name="tanggal_lahir" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Nama Ayah</label>
                        <input type="text" id="editnamaayah" name="nama_ayah" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Nama Ibu</label>
                        <input type="text" id="editnamaibu" name="nama_ibu" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Alamat Siswa Kp</label>
                        <input type="text" id="editalamatsiswakp" name="alamat_siswa_kp" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Alamat Siswa Rt</label>
                        <input type="text" id="editalamatsiswart" name="alamat_siswa_rt" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Alamat Siswa Rw</label>
                        <input type="text" id="editalamatsiswarw" name="alamat_siswa_rw" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Alamat Siswa Desa</label>
                        <input type="text" id="editalamatsiswadesa" name="alamat_siswa_desa" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Alamat Siswa Kecamatan</label>
                        <input type="text" id="editalamatsiswakec" name="alamat_siswa_kec" class="w-full border p-2 rounded">
                    </div>
                    <div>
                        <label class="block text-gray-700">Asal Sekolah Formal </label>
                        <input type="text" id="editasalsekolahformal" name="asal_sekolah_formal" class="w-full border p-2 rounded">
                    </div>
                </div>
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
    function openEditModal(data) {
        document.getElementById('editKode').value = data.kode_mdt || '';
        document.getElementById('editNama').value = data.nama_lembaga_MDT || '';
        document.getElementById('editAlamat').value = data.alamat_madrasah || '';
        document.getElementById('editRT').value = data.rt || '';
        document.getElementById('editRW').value = data.rw || '';
        document.getElementById('editDesa').value = data.desa || '';
        document.getElementById('editKecamatan').value = data.kecamatan || '';
        document.getElementById('editNsdt').value = data.nsdt || '';
        document.getElementById('editNoHp').value = data.no_hp || '';
        document.getElementById('editKepala').value = data.nama_kepala_MDT || '';
        document.getElementById('editNoPeserta').value = window.data?.no_peserta_ujian || '';
        document.getElementById('editNIS').value = data.nis || '';
        document.getElementById('editNISN').value = data.nisn || '';
        document.getElementById('editniksantri').value = data.NIK_Santri || '';
        document.getElementById('editNoUrut').value = data.no_urut_santri_diniyah || '';
        document.getElementById('editnamasantri').value = data.nama_santri || '';
        document.getElementById('editjeniskelamin').value = data.jenis_kelamin || '';
        document.getElementById('edittempatlahir').value = data.tempat_lahir || '';
        document.getElementById('edittanggallahir').value = data.tanggal_lahir || '';
        document.getElementById('editnamaayah').value = data.nama_ayah || '';
        document.getElementById('editnamaibu').value = data.nama_ibu || '';
        document.getElementById('editalamatsiswakp').value = data.alamat_siswa_kp || '';
        document.getElementById('editalamatsiswart').value = data.alamat_siswa_rt || '';
        document.getElementById('editalamatsiswarw').value = data.alamat_siswa_rw || '';
        document.getElementById('editalamatsiswadesa').value = data.alamat_siswa_desa || '';
        document.getElementById('editalamatsiswakec').value = data.alamat_siswa_kec || '';
        document.getElementById('editasalsekolahformal').value = data.asal_sekolah_formal || '';

        
        document.getElementById('editForm').action = `/update/${data.id}`;
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
