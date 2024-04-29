<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinjamanBmt extends Model
{
    protected $table = 'tbl_pengajuan_pinjaman';
    protected $primaryKey = 'id_pengajuan';
    public $timestamps = false;
}
