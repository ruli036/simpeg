<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapAbsensi extends Model
{
    protected $table = 'tbl_rekap_absen';
    protected $primaryKey = 'id_rekap';
    public $timestamps = false;
}
