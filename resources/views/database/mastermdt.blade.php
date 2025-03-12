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
        </tr>
        @endforeach
    </tbody>
</table>
