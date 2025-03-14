<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class TemplateExport implements FromArray
{
    public function array(): array
    {
        return [
            ['kode_mdt', 'nama_lembaga_MDT', 'alamat_madrasah', 'kecamatan', 'nama_santri', 'nis', 'NIK_Santri'],
        ];
    }
}
