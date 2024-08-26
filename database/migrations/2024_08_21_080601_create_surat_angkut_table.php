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
        Schema::create('surat_angkut', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_user', 255);
            $table->unsignedBigInteger('pbb_id');
            $table->unsignedBigInteger('kendaraan_id');
            $table->string('kode_pengiriman');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten_kota');
            $table->string('provinsi');
            $table->string('bukti_kepemilikan');
            $table->string('no_bukti');
            $table->string('nama_pengirim');
            $table->string('nik_pengirim');
            $table->string('alamat_pengirim');
            $table->string('tempat_muat');
            $table->string('jenis_dan_identitas');
            $table->string('alat_angkut');
            $table->string('penerima');
            $table->string('alamat_penerima');
            $table->integer('hari_berlaku');
            $table->date('dari_tanggal');
            $table->date('sampai_tanggal');
            $table->timestamps();

            $table->foreign('kode_user')->references('kode_user')->on('users')->onDelete('cascade');
            $table->foreign('pbb_id')->references('id')->on('pbb')->onDelete('cascade');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraan_angkut')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_angkut');
    }
};
