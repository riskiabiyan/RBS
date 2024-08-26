<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Kendaraan_angkut extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'kendaraan_angkut';

    protected $fillable = [
        'kode_user',
        'nomor_plat',
        'jenis_kendaraan',
        'foto_kendaraan',
    ];
}
