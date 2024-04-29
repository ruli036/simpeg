<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AnggotaBMT extends Model
{
    protected $table = 'tbl_anggota_bmt';
    protected $primaryKey = 'id_anggota_bmt';
    public $timestamps = false;

    public function setoranBmt(): HasMany
    {
        return $this->hasMany(SetoranBMT::class, 'id_anggota_bmt', 'id_anggota_bmt');
    }
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_karyawan', 'id');
    }
}
