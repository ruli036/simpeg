<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlipGaji extends Model
{
    protected $table = 'tbl_slip_gaji';
    protected $primaryKey = 'id_slip';
    public $timestamps = false;
    protected $fillable = [
        'nik', 
        'nama',
        'jabatan',
        'thn_mulai',
        'divisi',
        'status_karyawan',
        'hari_kerja',
        'jam',
        'gaji_pokok' ,
        'uang_makan',
        'uang_trans',
        'uang_harian',
        'uang_mengajar',
        'uang_kerja' ,
        'lembur_s' ,
        'lembur_m',
        'uang_l',
        'ka_waka',
        'wali_kelas',
        'koordi',
        'pic',
        'mentor',
        'jam_kerja',
        'tahfiz',
        'pelatihan',
        'pendamping',
        'thr',
        'keluarga',
        'beras',
        'masa_kerja',
        'total_tunjangan',
        'total_upah_lain',
        'spp',
        'bpjs_ketenaga_kerjaan',
        'bpjs_kesehatan',
        'hikmah_wakilah',
        'bmt',
        'dana_sosial',
        'potongan',
        'total',
        'bulan',
        'tgl_input',
        'tgl_update',
 ];
}
