<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandLog extends Model
{
    protected $table = 'command_log';
    // protected $primaryKey = 'id';
    public $timestamps = false;
}
