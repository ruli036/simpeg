<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatGaji extends Model
{
    protected $table = 'riwayat_gaji';
    public $timestamps = false;
    protected $fillable = [
        'id_karyawan',
        'id_componen_gaji',
        'jabatan',
        'divisi',
        'periode',
        'amount',
        'stts_karyawan',
        'id_aprov',
        'aprov',
        'sync',
    ];
}
