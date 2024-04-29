<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterItemGaji extends Model
{
    protected $table = 'master_item_gaji';
    public $timestamps = false;
    protected $fillable = [
        'colom',
        'nama',
        'akun_debet',
        'akun_credit',
        'flag',
        'stts',
    ];
}
