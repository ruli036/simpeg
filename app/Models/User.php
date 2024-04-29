<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'nik',
        'nuptk',
        'jk',
        'tempat',
        'tgl_lahir',
        'lulusan',
        'jurusan',
        'universitas',
        'thn_tamat',
        'no_hp',
        'tgl_mulai_bekerja',
        'pernikahan',
        'alamat',
        'status_kerja',
        'status_karyawan',
        'divisi',
        'status',
        'jabatan',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
  
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function anggotaBmt(): BelongsTo
    {
        return $this->belongsTo(AnggotaBMT::class, 'id_karyawan', 'id');
    }
}
