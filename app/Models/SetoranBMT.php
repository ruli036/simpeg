<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SetoranBMT extends Model
{
    protected $table = 'tbl_setoran_bmt';
    protected $primaryKey = 'id_setoran';
    public $timestamps = false;

    public function anggotabmt(): BelongsTo
    {
        return $this->belongsTo(AnggotaBMT::class, 'id_anggota_bmt', 'id_anggota_bmt');
    }
     
   
}
