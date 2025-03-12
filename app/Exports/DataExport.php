<?php
namespace App\Exports;

use App\Models\MasterMDT;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataExport implements FromCollection
{
    public function collection()
    {
        return MasterMDT::all(); // Ambil semua data dari database
    }
}

