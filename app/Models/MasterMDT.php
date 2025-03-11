<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMDT extends Model
{
    use HasFactory;

    protected $table = 'master_mdt';
    protected $guarded = []; // Pastikan semua kolom bisa diisi
}
