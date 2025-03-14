<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
use App\Exports\TemplateExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ImportController extends Controller
{
    // Fungsi untuk mengunduh template Excel
    public function downloadTemplate(): BinaryFileResponse
    {
        return Excel::download(new TemplateExport, 'template.xlsx');
    }

    // Fungsi untuk mengimport file Excel ke database
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new DataImport, $request->file('file'));

        return back()->with('success', 'Data berhasil diimport!');
    }
}
