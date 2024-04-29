<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanWadiah extends Model
{
    protected $table = 'tbl_penarikan_wadiah';
    protected $primaryKey = 'id_penarikan';
    public $timestamps = false;
}

