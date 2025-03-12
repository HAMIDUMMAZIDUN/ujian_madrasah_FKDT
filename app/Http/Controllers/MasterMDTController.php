<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMdt extends Model
{
    use HasFactory;

    protected $table = 'master_mdt'; // Pastikan tabelnya benar

    protected $fillable = [
        'kode_mdt',
        'nama_lembaga_MDT',
        'alamat_madrasah',
        'rt',
        'rw',
        'desa',
        'kecamatan',
        'nsdt',
        'no_hp',
        'nama_kepala_MDT',
    ];
}
