<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mdt');
            $table->string('nama_lembaga_MDT');
            $table->string('alamat_madrasah');
            $table->string('kecamatan');
            $table->string('nama_santri');
            $table->string('nis')->nullable();
            $table->string('NIK_Santri')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('santris');
    }
};
