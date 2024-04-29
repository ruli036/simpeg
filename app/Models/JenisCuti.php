<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    protected $table = 'tbl_cuti';
    protected $primaryKey = 'id_cuti';
    public $timestamps = false;
}
