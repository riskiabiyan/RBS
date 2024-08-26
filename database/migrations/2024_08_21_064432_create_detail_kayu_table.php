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
        Schema::create('detail_kayu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_user', 255);
            $table->string('kode_pengiriman');
            $table->string('jenis_kayu');
            $table->float('tebal_kayu');
            $table->float('lebar_kayu');
            $table->float('panjang_kayu');
            $table->float('isi_kayu');
            $table->float('m3');
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('kode_user')->references('kode_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_kayu');
    }
};
