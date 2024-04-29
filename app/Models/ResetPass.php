<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPass extends Model
{
    protected $table = 'password_resets';
    public $timestamps = false;
    protected $guarded = [
        'id',
        'email'
    ];
}
