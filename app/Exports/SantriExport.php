<?php
namespace App\Exports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SantriExport implements FromCollection, WithHeadings
{
    protected $kecamatan;
    protected $desa;
    protected $kode_mdt;

    public function __construct($kecamatan, $desa, $kode_mdt)
    {
        $this->kecamatan = $kecamatan;
        $this->desa = $desa;
        $this->kode_mdt = $kode_mdt;
    }

    public function collection()
    {
        $query = Santri::query();

        if ($this->kecamatan) {
            $query->where('kecamatan', $this->kecamatan);
        }

        if ($this->desa) {
            $query->where('desa', $this->desa);
        }

        if ($this->kode_mdt) {
            $query->where('kode_mdt', $this->kode_mdt);
        }

        return $query->get()->map(function ($santri) {
            return [
                $santri->kode_mdt,
                $santri->nama_lembaga_MDT,
                $santri->alamat_madrasah,
                $santri->rt,
                $santri->rw,
                $santri->desa,
                $santri->kecamatan,
                $santri->nsdt,
                $santri->no_hp,
                $santri->nama_kepala_MDT,
                $santri->no_peserta_ujian,
                $santri->nis,
                $santri->nisn,
                $santri->no_urut_santri_diniyah,
                $santri->nama_santri,
                $santri->jenis_kelamin,
                $santri->tempat_lahir,
                $santri->tanggal_lahir,
                $santri->nama_ayah,
                $santri->nama_ibu,
                $santri->alamat_siswa_kp,
                $santri->alamat_siswa_rt,
                $santri->alamat_siswa_rw,
                $santri->alamat_siswa_desa,
                $santri->alamat_siswa_kec,
                $santri->asal_sekolah_formal,
                $santri->NIK_santri,
            ];
        });
    }
        public function headings(): array
        {
            return [
                'Kode MDT',
                'Nama Lembaga MDT',
                'Alamat Madrasah',
                'RT',
                'RW',
                'Desa',
                'Kecamatan',
                'NSDT',
                'No HP',
                'Nama Kepala MDT',
                'No Peserta Ujian',
                'NIS',
                'NISN',
                'No Urut santri Diniyah ',
                'Nama Santri',
                'Jenis Kelamin',
                'Tempat Lahir',
                'Tanggal Lahir',
                'Nama Ayah',
                'Nama Ibu',
                'Alamat Siswa KP',
                'Alamat Siswa RT',
                'Alamat Siswa RW',
                'Alamat Siswa Desa',
                'Alamat Siswa Kec',
                'Asal Sekolah Formal',
                'NIK Santri',
        ];
    }
}





