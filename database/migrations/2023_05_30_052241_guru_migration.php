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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama_guru');
            $table->string('nama_ayah');
            $table->string('no_hp');
            $table->string('email');
            $table->string('ttl');
            $table->string('alamat');
            $table->string('kode_provinsi');
            $table->string('kode_kabupaten');
            $table->string('kode_kecamatan');
            $table->string('kode_kelurahan');
            $table->string('syahadah');
            $table->string('pendidikan');
            $table->string('id_lembaga');
            $table->enum('sertifikat_training', ['sudah', 'belum']);
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
