<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waktu extends Model
{
    protected $table = 'tbl_waktu';
    protected $primaryKey = 'id_waktu';
    public $timestamps = false;
}
