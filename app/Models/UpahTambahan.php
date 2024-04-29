<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpahTambahan extends Model
{
    protected $table = 'tbl_upah_lain';
    protected $primaryKey = 'id_upah';
    public $timestamps = false;
}
