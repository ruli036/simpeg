<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogEdit extends Model
{
    protected $table = 'tbl_log_edit';
    protected $primaryKey = 'id_log';
    public $timestamps = false;
}
