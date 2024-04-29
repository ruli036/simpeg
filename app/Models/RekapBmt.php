<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapBmt extends Model
{
    protected $table = 'tbl_rekap_bmt';
    protected $primaryKey = 'id_rekap_bmt';
    public $timestamps = false;
}
