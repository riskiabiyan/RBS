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
        Schema::create('data_pengiriman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_user', 255);
            $table->string('kode_pengiriman');
            $table->unsignedBigInteger('surat_id')->nullable();
            $table->string('jenis_kayu');
            $table->float('jumlah_kayu');
            $table->float('total_kubikasi');
            $table->timestamps();

            $table->foreign('surat_id')->references('id')->on('surat_angkut')->onDelete('cascade');
            $table->foreign('kode_user')->references('kode_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pengiriman');
    }
};
