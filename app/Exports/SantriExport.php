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
        // Query dengan filter
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

        return $query->get();
    }

    public function headings(): array
    {
        return ["ID", "Nama", "Kecamatan", "Desa", "Kode MDT", "Tanggal Lahir"];
    }
}




