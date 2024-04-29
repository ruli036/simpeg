<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatAproval extends Model
{
    protected $table = 'riwayat_aproval_gaji';
    public $timestamps = false;
    protected $fillable = [
        'tgl_aproval',
        'user_aproval',
        'ket',
        'stts_aproval',
    ];
}
