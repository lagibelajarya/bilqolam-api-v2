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
        Schema::create('lembaga', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('alamat');
            $table->string('email');
            $table->string('no_hp');
            $table->string('no_reg');
            $table->string('no_nsl');
            $table->string('no_npl');
            $table->string('jml_santri');
            $table->string('jml_guru');
            $table->string('status');
            $table->string('kode_kecamatan');
            $table->string('kode_kelurahan');
            $table->string('kode_kabupaten');
            $table->string('kode_provinsi');
            $table->string('kode_pos')->nullable();
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
