
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Kartu Peserta</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; text-align: center; }
        .card { border: 1px solid #000; padding: 10px; margin-bottom: 20px; }
        img { width: 100px; height: 120px; }
    </style>
</head>
<body>
    <div class="container">
        @if(isset($santris) && count($santris) > 0)
            @foreach($santris as $p)
                <div class="card">
                    <div class="header"><strong>KARTU PESERTA UJIAN MADRASAH</strong></div>
                    <p><strong>Nama Peserta :</strong> {{ $p->nama_santri }}</p>
                    <p><strong>Jenis Kelamin :</strong> {{ $p->jenis_kelamin }}</p>
                    <p><strong>Tempat, Tanggal Lahir :</strong> {{ $p->tempat_lahir }}, {{ $p->tanggal_lahir }}</p>
                    <p><strong>NIK Santri :</strong> {{ $p->NIK_santri }}</p>
                    <p><strong>NIS :</strong> {{ $p->nis }}</p>
                    <p><strong>NISN :</strong> {{ $p->nisn }}</p>
                    <p><strong>No Urut Santri Diniyah :</strong> {{ $p->no_urut_santri_diniyah }}</p>
                    <p><strong>Nomor Peserta Ujian :</strong> {{ $p->no_peserta_ujian }}</p>
                    <p><strong>Nomor Peserta :</strong> {{ $p->no_peserta }}</p>

                    <h3>Data Madrasah</h3>
                    <p><strong>Kode MDT :</strong> {{ $p->kode_mdt }}</p>
                    <p><strong>Nama Lembaga MDT :</strong> {{ $p->nama_lembaga_MDT }}</p>
                    <p><strong>Nama Madrasah :</strong> {{ $p->madrasah }}</p>
                    <p><strong>Alamat Madrasah :</strong> {{ $p->alamat_madrasah }}</p>
                    <p><strong>RT/RW :</strong> {{ $p->rt }}/{{ $p->rw }}</p>
                    <p><strong>Desa/Kecamatan :</strong> {{ $p->desa }}, {{ $p->kecamatan }}</p>
                    <p><strong>NSDT :</strong> {{ $p->nsdt }}</p>
                    <p><strong>No HP :</strong> {{ $p->no_hp }}</p>
                    <p><strong>Nama Kepala MDT :</strong> {{ $p->nama_kepala_MDT }}</p>

                    <h3>Data Orang Tua</h3>
                    <p><strong>Nama Ayah :</strong> {{ $p->nama_ayah }}</p>
                    <p><strong>Nama Ibu :</strong> {{ $p->nama_ibu }}</p>

                    <h3>Alamat Siswa</h3>
                    <p><strong>Alamat :</strong> {{ $p->alamat_siswa_kp }}</p>
                    <p><strong>RT/RW :</strong> {{ $p->alamat_siswa_rt }}/{{ $p->alamat_siswa_rw }}</p>
                    <p><strong>Desa/Kecamatan :</strong> {{ $p->alamat_siswa_desa }}, {{ $p->alamat_siswa_kec }}</p>

                    <h3>Pendidikan</h3>
                    <p><strong>Asal Sekolah Formal :</strong> {{ $p->asal_sekolah_formal }}</p>

                    <p><img src="{{ asset('storage/foto/'.$p->foto) }}" alt="Foto Peserta"></p>
                    <p>BANDUNG, 16 Maret 2025</p>
                    <p>Kepala Madrasah</p>
                    <p><strong>DRS ASEP HASAN IDRIS</strong></p>
                </div>
            @endforeach
        @else
            <p><strong>Tidak ada data santri yang tersedia!</strong></p>
        @endif
    </div>
</body>

