<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Surat extends Model
{
    protected $table = 'tbl_surat';
    protected $primaryKey = 'id_surat';
    public $timestamps = false;
    
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_karyawan', 'id');
    }
    public function cuti(): BelongsTo
    {
        return $this->belongsTo(JenisCuti::class, 'id_cuti', 'id_cuti');
    }
}
