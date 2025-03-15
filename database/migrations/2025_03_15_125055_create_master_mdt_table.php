<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('master_mdt', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mdt')->unique();
            $table->string('nama_lembaga_MDT');
            $table->string('alamat_madrasah');
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('desa');
            $table->string('kecamatan'); // Pastikan kolom ini ada
            $table->string('nsdt')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('nama_kepala_MDT')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('master_mdt');
    }
};

