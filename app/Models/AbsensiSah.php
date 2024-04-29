<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiSah extends Model
{
    protected $table = 'tbl_absensi_sah';
    protected $primaryKey = 'id_absensi_sah';
    public $timestamps = false;
}
