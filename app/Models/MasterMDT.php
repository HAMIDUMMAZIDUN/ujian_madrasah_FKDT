<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class MasterMdt extends Model
{
    public $timestamps = false; // Menonaktifkan timestamps

    protected $table = 'master_mdt'; // Nama tabel di database

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

