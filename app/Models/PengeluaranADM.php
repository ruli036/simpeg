<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengeluaranADM extends Model
{
    protected $table = 'tbl_pengeluaran_adm';
    protected $primaryKey = 'id_pengeluaran';
    public $timestamps = false;
}
