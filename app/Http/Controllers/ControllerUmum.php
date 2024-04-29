<?php

namespace App\Http\Controllers;

use App\Models\JenisCuti;
use App\Models\Logo;
use App\Models\SlipGaji;
use App\Models\Surat;
use App\Models\UpahTambahan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ControllerUmum extends Controller
{
    
      // Generate PDF
      public function generatePDF($id) {
        $datacuti = Surat::where('id_surat',$id)->first();
        $sesi_cuti = JenisCuti::where('id_cuti',$datacuti->id_cuti)->first();

          $divisi = $datacuti->divisi;
          $format = Logo::where('divisi',$divisi)->first();
          if($format != null){
               $datas = [
            'title' => $format->judul,
            'divisi' => $format->divisi,
            'alamat' => $format->alamat,
            'hp' => $format->no_hp,
            'email' => $format->email,
            'web' => $format->web,
            'logo' => $format->logo,
            'tgl' => $datacuti->tgl_surat,
            'no_surat' => $datacuti->no_surat,
            'tgl_mulai' => $datacuti->tgl_mulai,
            'tgl_akhir' => $datacuti->tgl_akhir,
            'nama' => $datacuti->users->name,
            'jabatan' => $datacuti->users->jabatan,
            'ket_rekom1' => Str::ucfirst($datacuti->ket_rekom1),
            'ket_rekom2' => Str::ucfirst($datacuti->ket_rekom2),
            'ket_rekom3' => Str::ucfirst($datacuti->ket_rekom3),
            'cuti' => $datacuti->kategori_cuti,
            'jumlah' => $datacuti->jumlah,
            'sisa' => $datacuti->sisa,
            'keterangan' => $datacuti->ket,
            'status' => $datacuti->status,
            'sesi_cuti' => $sesi_cuti->sesi,
        ];
        if($divisi=='DAYCARE'){
            $pdf = PDF::loadView('desainsurat.daycare', $datas)->setPaper([0, 0, 1010, 595], 'landscape');
        }elseif($divisi=='YAYASAN'){
            $pdf = PDF::loadView('desainsurat.yayasan', $datas)->setPaper([0, 0, 1000, 595], 'landscape');
        }else{
            $pdf = PDF::loadView('desainsurat.sekolah', $datas)->setPaper([0, 0, 1000, 595], 'landscape');
        }
        try{
            return $pdf->download($datacuti->no_surat.'/'.time().'/Surat Pengajuan Cuti.pdf'); 
        } catch (\Exception $e) {
          return redirect()->back()->with(['warning'=>'Gagal Mendownload File']);               
        }
          
          }else{
            return redirect()->back()->with(['info' => 'Tidak Bisa Mencetak Surat, Format Belum Tersedian']);
          }
      
        
      }
       public function SlipGajiPdf($id,$periode) {
        set_time_limit(120);
        $datas = DB::table('master_item_gaji as a')->leftJoin('riwayat_gaji as b', 'a.id', '=', 'b.id_componen_gaji')->join('users as c', 'b.id_karyawan', '=', 'c.id')
        ->selectRaw("b.amount,b.periode,b.jabatan,b.divisi,a.nama,a.flag,c.name")
        ->where('a.flag','Z')
        ->where('b.id_karyawan',$id)
        ->where('b.periode',$periode)
        ->get();
        
        $masukan = DB::table('master_item_gaji as a')->leftJoin('riwayat_gaji as b', 'a.id', '=', 'b.id_componen_gaji')->join('users as c', 'b.id_karyawan', '=', 'c.id')
        ->selectRaw("b.id as iditem,b.id_karyawan,b.stts_karyawan,b.id_aprov,b.aprov, b.sync, b.amount,b.periode,b.jabatan,b.divisi,a.nama,a.flag,c.name")
        ->where('a.flag','P')
        ->where('b.id_karyawan',$id)
        ->where('b.periode',$periode)
        ->get();

        
        $potongan = DB::table('master_item_gaji as a')->leftJoin('riwayat_gaji as b', 'a.id', '=', 'b.id_componen_gaji')
        ->selectRaw("b.id as iditem,b.id_karyawan, b.amount,b.periode,a.nama,a.flag")
        ->where('a.flag','M')
        ->where('b.id_karyawan',$id)
        ->where('b.periode',$periode)
        ->get();
        // return $masukan;
        $img = Logo::where('divisi',$masukan[0]->divisi)->first();

        $bendahara  = User::where('status',2)->first();
        if($masukan[0]->divisi=="YAYASAN"){
           $nama_divisi = 'Yayasan';
        }else if($masukan[0]->divisi=="DAYCARE"){
          $nama_divisi = 'Daycare';
        }else{
          $nama_divisi = $masukan[0]->divisi;
        }
        try{
          return view('desainsurat.pdfslipgaji',['img'=>$img,'nama_divisi'=>$nama_divisi,'bendahara'=>$bendahara,'datas'=>$datas,'masukan'=>$masukan,'potongan'=>$potongan]);
        } catch (\Exception $e) {
          return redirect()->back()->with(['warning'=>'Gagal Mendownload File']);               
     }
          
      
        
      }
  
    
  
   
     

}
