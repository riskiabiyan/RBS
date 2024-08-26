<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pbb extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'pbb';

    protected $fillable = [
        'kode_user',
        'nomor_pbb',
        'foto_pbb',
    ];
}
