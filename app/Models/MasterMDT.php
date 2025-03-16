<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class MasterMdt extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $table = 'master_mdt';

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
        'no_peserta_ujian',
        'nis',
        'nisn',
        'no_urut_santri_diniyah',
        'nama_santri',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nama_ayah',
        'nama_ibu',
        'alamat_siswa_kp',
        'alamat_siswa_rt',
        'alamat_siswa_rw',
        'alamat_siswa_desa',
        'alamat_siswa_kec',
        'asal_sekolah_formal',
        'NIK_santri',
    ];
     
}

