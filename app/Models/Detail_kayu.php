<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Detail_kayu extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'detail_kayu';

    protected $fillable = [
        'kode_user',
        'kode_pengiriman',
        'jenis_kayu',
        'tebal_kayu',
        'lebar_kayu',
        'panjang_kayu',
        'isi_kayu',
        'm3',
        'keterangan',
    ];
}
