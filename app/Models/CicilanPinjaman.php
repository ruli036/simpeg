<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicilanPinjaman extends Model
{
    protected $table = 'tbl_cicilan_pinjaman';
    protected $primaryKey = 'id_cicilan';
    public $timestamps = false;
}
