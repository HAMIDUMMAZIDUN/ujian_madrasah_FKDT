<?php
namespace App\Imports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class DataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Santri([
            'kode_mdt' => $row['kode_mdt'] ?? null,
            'nama_lembaga_MDT' => $row['nama_lembaga_mdt'] ?? null,
            'alamat_madrasah' => $row['alamat_madrasah'] ?? null,
            'rt' => $row['rt'] ?? null,
            'rw' => $row['rw'] ?? null,
            'desa' => $row['desa'] ?? null,
            'kecamatan' => $row['kecamatan'] ?? null,
            'nsdt' => $row['nsdt'] ?? null,
            'no_hp' => $row['no_hp'] ?? null,
            'nama_kepala_MDT' => $row['nama_kepala_mdt'] ?? null,
            'no_peserta_ujian' => !empty($row['no_peserta_ujian']) ? $row['no_peserta_ujian'] : null,
            'nis' => $row['nis'] ?? null,
            'nisn' => $row['nisn'] ?? null,
            'no_urut_santri_diniyah' => $row['no_urut_santri_diniyah'] ?? null,
            'nama_santri' => $row['nama_santri'] ?? null,
            'jenis_kelamin' => $row['jenis_kelamin'] ?? null,
            'tempat_lahir' => $row['tempat_lahir'] ?? null,
            'tanggal_lahir' => isset($row['tanggal_lahir']) ? $this->transformDate($row['tanggal_lahir']) : null,
            'nama_ayah' => $row['nama_ayah'] ?? null,
            'nama_ibu' => $row['nama_ibu'] ?? null,
            'alamat_siswa_kp' => $row['alamat_siswa_kp'] ?? null,
            'alamat_siswa_rt' => $row['alamat_siswa_rt'] ?? null,
            'alamat_siswa_rw' => $row['alamat_siswa_rw'] ?? null,
            'alamat_siswa_desa' => $row['alamat_siswa_desa'] ?? null,
            'alamat_siswa_kec' => $row['alamat_siswa_kec'] ?? null,
            'asal_sekolah_formal' => $row['asal_sekolah_formal'] ?? null,
            'NIK_santri' => $row['nik_santri'] ?? null,
        ]);
    }

    private function transformDate($date)
    {
        if (is_numeric($date)) {
            return Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime('1899-12-30 +' . $date . ' days')));
        }
        return $date;
    }
}
