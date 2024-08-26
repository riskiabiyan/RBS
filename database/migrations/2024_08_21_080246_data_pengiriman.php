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
        Schema::create('data_kayu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_user', 255);
            $table->unsignedBigInteger('surat_angkut_id')->nullable();
            $table->string('kode_pengiriman');
            $table->string('jenis_kayu');
            $table->integer('jumlah_kayu');
            $table->float('total_kubikasi');
            $table->timestamps();

            $table->foreign('kode_user')->references('kode_user')->on('users')->onDelete('cascade');
            $table->foreign('surat_angkut_id')->references('id')->on('surat_angkutan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
