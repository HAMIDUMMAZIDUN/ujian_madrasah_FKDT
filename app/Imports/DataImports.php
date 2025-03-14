<?php
namespace App\Imports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Santri([
            'kode_mdt' => $row['kode_mdt'],
            'nama_lembaga_MDT' => $row['nama_lembaga_mdt'],
            'alamat_madrasah' => $row['alamat_madrasah'],
            'kecamatan' => $row['kecamatan'],
            'nama_santri' => $row['nama_santri'],
            'nis' => $row['nis'],
            'NIK_Santri' => $row['nik_santri'],
        ]);
    }
}
