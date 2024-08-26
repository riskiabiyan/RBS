<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Surat_angkut extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'surat_angkut';

    protected $fillable = [
        'nomor_surat',
        'kode_user',
        'pbb_id',
        'kendaraan_id',
        'kode_pengiriman',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'bukti_kepemilikan',
        'no_bukti',
        'nama_pengirim',
        'nik_pengirim',
        'alamat_pengirim',
        'tempat_muat',
        'nomor_plat',
        'alat_angkut',
        'penerima',
        'alamat_penerima',
        'hari_berlaku',
        'dari_tanggal',
        'sampai_tanggal',
        
    ];

}
