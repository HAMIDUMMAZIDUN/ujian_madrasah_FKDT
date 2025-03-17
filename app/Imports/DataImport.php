<?php
namespace App\Imports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use App\Models\MasterMDT;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class DataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new MasterMDT([
            
            'kode_mdt' => $row['kode_mdt'],
            'nama_lembaga_MDT' => $row['nama_lembaga_mdt'],
            'alamat_madrasah' => $row['alamat_madrasah'],
            'rt'=> !empty($row['rt']) ? (int) $row['rt'] : null,  
            'rw'=> !empty($row['rw']) ? (int) $row['rw'] : null,
            'desa' => $row['desa'],
            'kecamatan' => $row['kecamatan'],
            'nsdt' => $row['nsdt'],
            'no_hp' => $row['no_hp'],
            'nama_kepala_MDT' => $row['nama_kepala_mdt'],
            'no_peserta_ujian' => $row['no_peserta_ujian'],
            'nisn' => !empty($row['nisn']) ? (int) $row['nisn'] : null,
            'nis' => !empty($row['nis']) ? (int) $row['nis'] : null,
            'no_urut_santri_diniyah' => $row['no_urut_santri_diniyah'],
            'nama_santri' => $row['nama_santri'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tempat_lahir' => $row['tempat_lahir'],
            'tanggal_lahir'     => isset($row['tanggal_lahir']) 
            ? (is_numeric($row['tanggal_lahir']) 
                ? Date::excelToDateTimeObject($row['tanggal_lahir'])->format('Y-m-d') 
                : date('Y-m-d', strtotime($row['tanggal_lahir'])))
            : null,
            'nama_ayah' => $row['nama_ayah'],
            'nama_ibu' => $row['nama_ibu'],
            'alamat_siswa_kp' => $row['alamat_siswa_kp'],
            'alamat_siswa_rt' => !empty($row['alamat_siswa_rt']) ? (int) $row['alamat_siswa_rt'] : null,
            'alamat_siswa_rw'   => !empty($row['alamat_siswa_rw']) ? (int) $row['alamat_siswa_rw'] : null,
            'alamat_siswa_desa' => $row['alamat_siswa_desa'],
            'alamat_siswa_kec' => $row['alamat_siswa_kec'],
            'asal_sekolah_formal' => $row['asal_sekolah_formal'],
            'NIK_santri' => !empty($row['NIK_santri']) ? (int) $row['NIK_santri'] : null,
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
