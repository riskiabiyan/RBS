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
        Schema::create('kendaraan_angkut', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_user', 255);
            $table->string('nomor_plat');
            $table->string('jenis_kendaraan');
            $table->string('foto_kendaraan');
            $table->timestamps();

            $table->foreign('kode_user')->references('kode_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kendaraan_angkut');
    }
};
