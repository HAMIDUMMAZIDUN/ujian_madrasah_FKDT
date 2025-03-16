<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class TemplateExport implements FromArray, WithHeadings, WithStyles
{
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
            'No Urut Santri Diniyah',
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
            'NIK Santri'
        ];
    }

    public function array(): array
    {
        return [
            // Tambahkan contoh data agar border bisa diterapkan dengan benar
            ['  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ',  '  '  ],
            ['  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ',  '  '  ],
            ['  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ',  '  '  ],
            ['  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ',  '  '  ],
            ['  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ',  '  '  ],
            ['  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ',  '  '  ],
            ['  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ',  '  '  ],
            ['  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ',  '  '  ],
            ['  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ',  '  '  ],
            ['  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ', '  ', '  ', '  ',  '  ', '  ',  '  '  ],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
        $cellRange = 'A1:' . $highestColumn . $highestRow;

        // Terapkan border ke seluruh tabel
        $sheet->getStyle($cellRange)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // Menebalkan header dan rata tengah
        $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        ]);

        return [];
    }
}
