<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->id();
            $table->string('nama_santri');
            $table->string('nama_ayah');
            $table->string('ttl');
            $table->string('alamat');
            $table->string('kode_provinsi');
            $table->string('kode_kabupaten');
            $table->string('kode_kecamatan');
            $table->string('kode_kelurahan');
            $table->string('telp_wali');
            $table->string('id_lembaga');
            $table->string('pend_terakhir');
            $table->string('jilid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
