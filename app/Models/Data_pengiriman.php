<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Data_pengiriman extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'data_pengiriman';

    protected $fillable = [
        'kode_user',
        'kode_pengiriman',
        'surat_id',
        'jenis_kayu',
        'jumlah_kayu',
        'panjang_kayu',
        'total_kubikasi',
    ];
}
