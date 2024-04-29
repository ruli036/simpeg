<?php

namespace App\Http\Controllers;

use App\Mail\KirimEmail;
use App\Models\Daftaruser;
use App\Models\JenisCuti;
use App\Models\Surat;
use App\Models\TemporariSurat;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ControllerCek extends Controller
{
     // DAFTAR Karayawan Baerdasarkan DIVISI
     public function daftartarkaryawan(){
        if(Auth::check() && (Auth::user()->status == 1||Auth::user()->status == 2||Auth::user()->status == 3||Auth::user()->status == 4||Auth::user()->status == 0)){
            $aktive = 'divisi';
           $divisi = Auth::user()->divisi; 
             if(Auth::user()->divisi == 'KB-TK'){
                $datauser = DB::select("SELECT * FROM users where status_kerja = 1 AND (divisi = '$divisi'|| divisi= 'DAYCARE') ");
            }else{
                $datauser = DB::select("SELECT * FROM users where status_kerja = 1 AND divisi = '$divisi'");
            }
     
            return view('pagesadmin.datauser ',['datauser'=>$datauser,'aktive'=>$aktive]);  
        }else{
            return redirect('/');
        }
        
        } 
    public function halamangantipass(){
        if(Auth::check()){
            $aktive = "home";
                return view('umum.gantipass',['aktive'=>$aktive]);
            }else{
                return redirect('/');
            }

        }  
        
        public function halamanajukansurat(){
            if(Auth::check()){
                $aktive = "users";
                $mulaiMasuk = Auth::user()->tgl_mulai_bekerja;
                $tanggalNow = date('d-m-Y', strtotime(now()));
                $tgl1 = strtotime($mulaiMasuk); 
                $tgl2 = strtotime($tanggalNow); 
                $jarak = $tgl2 - $tgl1;
                $hari = $jarak / 60 / 60 / 24;
                $jk = Auth::user()->jk;
               
                if(Auth::user()->divisi=='YAYASAN'){
                    if(Auth::user()->status_karyawan == 'KTY' || Auth::user()->status_karyawan == 'GTY'){
                            $cutis = JenisCuti::whereIn('jk',['all',Auth::user()->jk])->get();
                    }else if($hari < 366){
                            $cutis = JenisCuti::where('kategori_karyawan','umum')->whereIn('jk',['all',Auth::user()->jk])->get();
                    }else{
                            $cutis = JenisCuti::where('id_cuti','!=','11')->whereIn('jk',['all',Auth::user()->jk])->get();
                    }  
                }else{
                    if(Auth::user()->status_karyawan == 'KTY' || Auth::user()->status_karyawan == 'GTY'){
                        $cutis = JenisCuti::where('kategori','0')->whereIn('jk',['all',Auth::user()->jk])->get();
                    }else if($hari < 366 ){
                        $cutis = JenisCuti::where('kategori_karyawan','umum')->where('kategori','0')->whereIn('jk',['all',Auth::user()->jk])->get();
                    }else{
                        $cutis = JenisCuti::where('id_cuti','!=','11')->where('kategori','0')->whereIn('jk',['all',Auth::user()->jk])->get();
                    }
                   
                }
                return view('cuti.formajukansurat',['aktive'=>$aktive,'cutis'=>$cutis]);
            }else{
                return redirect('/');
            }
        }
        
    public function dataftarsurattunggu(){
        if(Auth::check() && (Auth::user()->status == 1||Auth::user()->status == 2||Auth::user()->status == 3||Auth::user()->status == 4) ){
            $aktive = 'suratCuti';
            $divisi = Auth::user()->divisi;
            $status = Auth::user()->status;
            if($status == '3'){
                if($divisi == "KB-TK"){
                    $datauser =  TemporariSurat::where('rekom1',0)->where('divisi',$divisi)->where('sts','!=',9)->orWhere('divisi','DAYCARE')->get();
                }else{
                    $datauser =  TemporariSurat::where('rekom1',0)->where('divisi',$divisi)->where('sts','!=',9)->get();
                }
            }elseif($status == '2'){
                $datauser =  TemporariSurat::where('rekom1',1)->where('rekom2',0)->where('sts','!=',9)->get();
            }elseif($status == '4'){
                $datauser =  TemporariSurat::where('rekom1',0)->where('divisi',$divisi)->where('sts','!=',9)->get();
            }else{
                $datauser =  TemporariSurat::where('rekom1',1)->where('rekom2',1)->where('rekom3',0)->where('sts','!=',9)->get();
            }
           
        return view('cuti.daftarSuratTungguKaryawan ',['datauser'=>$datauser,'aktive'=>$aktive]);
         }else{
            return redirect('/');
        }
       
        }   
    public function dataftarsurattungguOB(){
             $aktive = 'suratCuti';
        if(Auth::check() && (Auth::user()->status == 1||Auth::user()->status == 2)){
            $status = Auth::user()->status;
            $divisi = Auth::user()->divisi;
        if($status == '2'){
            $datauserOB =  TemporariSurat::where('rekom1',1)->where('rekom2',0)->where('rekom3',0)->where('sts',9)->get();
        }else{
            $datauserOB =  TemporariSurat::where('rekom1',1)->where('rekom2',1)->where('rekom3',0)->where('sts',9)->get();
           
         }
            return view('cuti.daftarSuratTungguOB ',['datauserOB'=>$datauserOB,'aktive'=>$aktive]);
         }else{
            return redirect('/');
        }
       
    }  
         
        
    public function setuju($id,Request $request){
            $request->validate([
                'ket'=>'required'
            ]);
            $tahun = date('Y');
        try{
            $datakaryawan =  TemporariSurat::where('id_surat',$id)->first();
            $ket ='';
            if(Auth::user()->status == '3'||Auth::user()->status == '4'){
                $datapimpinan =  Daftaruser::where("status",2)->first();
                $email = $datapimpinan->email;
                    $result = TemporariSurat::find($id);
                    $result->rekom1= '1';
                    $result->ket_rekom1= $request['ket'];
                    $result->save();
                    $ket = $datakaryawan->ket;   
             }elseif(Auth::user()->status == '2'){
                $datapimpinan =  Daftaruser::where("status",1)->first();
                $email = $datapimpinan->email;
                $result = TemporariSurat::find($id);
                $result->rekom2= '1';
                $result->ket_rekom2= $request['ket'];
                $result->save();   
                $ket = $datakaryawan->ket;              
             }else{
                $ket = 'Telah Di Setujui Oleh Pimpinan yayasan';
                $id_karyawana = $datakaryawan->id_karyawan;
                $emailkaryawan =  User::find($id_karyawana);
                $email = $emailkaryawan->email;
                date_default_timezone_set('Asia/Jakarta');
                $tahun = date('Y');
                $cek = Surat::all()->count();
               
                    if($datakaryawan->divisi == "DAYCARE"){
                        $divisi = '01';
                    }elseif($datakaryawan->divisi == "KB-TK"){
                        $divisi = '02';
                    }elseif($datakaryawan->divisi == "SD"){
                        $divisi = '03';
                    }elseif($datakaryawan->divisi == "SMP"){
                        $divisi = '04';
                    }else{
                        $divisi = '05';
                    }
                
                
                if($cek == 0){
                    $no_surat = $tahun.$divisi."1"; 
                }else{
                    $nodata = Surat::all()->last();
                    $idd = $nodata->id_surat + 1;
                    $no_surat = $tahun.$divisi.$idd; 
                }
                $data = TemporariSurat::where('id_surat',$id)->first();
                
                    $simpan = Surat::insert(
                        [
                            'no_surat' => $no_surat,
                            'id_karyawan' => $data->id_karyawan,
                            'id_cuti' => $data->id_cuti,
                            'tgl_mulai' =>  date('Y-m-d ', strtotime($data->tgl_mulai)),
                            'tgl_akhir' => date('Y-m-d ', strtotime($data->tgl_akhir)),
                            'sisa' =>$data->sisa,
                            'jumlah' => $data->jumlah,
                            'ket' =>$data->ket,
                            'file' =>$data->file,
                            'rekom1' => '1',
                            'ket_rekom1' => $data->ket_rekom1,
                            'rekom2' => '1',
                            'ket_rekom2' => $data->ket_rekom2,
                            'rekom3' => '1',
                            'ket_rekom3' => $request['ket'],
                            'tgl_surat' => now(),
                            'created_at' => now()
                        ]);
                
               
                        if($simpan > 0){
                            $result = TemporariSurat::find($id);
                            $result->delete();
                        }
                 }
                    $details = [
                        'name' =>       $datakaryawan->users->name,
                        'divisi' =>     $datakaryawan->users->divisi,
                        'jabatan' =>    $datakaryawan->users->jabatan,
                        'kategori' =>   $datakaryawan->cuti->jenis,
                        'mulai' =>      $datakaryawan->tgl_mulai,
                        'akhir' =>      $datakaryawan->tgl_akhir,
                        'jumlah' =>     $datakaryawan->jumlah,
                        'sisa' =>       $datakaryawan->sisa ,
                        'body' =>       $ket,
                        
                    ];
                    try{
                        Mail::to($email)->send(new KirimEmail($details));
                    } catch (\Exception $e) {
                    }    

                return redirect()->back()->with(['info'=>'Data Berhasil Di Simpan']);
            }catch(Exception $e){
                return  redirect()->back()->with(['warning'=>'Error']);
            } 
                
                
                
    }   
    public function setujuOb($id, Request $request){
        $request->validate([
            'ket'=>'required'
        ]);
        
        $datakaryawan =  TemporariSurat::where('id_surat',$id)->first();
      
        try{
            $ket = "";
            if(Auth::user()->status == '2'){
                $datapimpinan =  Daftaruser::where("status",1)->first();
                $email = $datapimpinan->email;
                $result = TemporariSurat::find($id);
                $result->rekom2= '1';
                $result->ket_rekom2= $request['ket'];
                $result->save();        
                $ket = $datakaryawan->ket;      
             }else{
                $id_karyawana = $datakaryawan->id_karyawan;
                $emailkaryawan =  User::find($id_karyawana);
                $email = $emailkaryawan->email;
                date_default_timezone_set('Asia/Jakarta');
                $tahun = date('Y');
                $cek = Surat::all()->count();
               
                    if($datakaryawan->divisi == "DAYCARE"){
                        $divisi = '01';
                    }elseif($datakaryawan->divisi == "KB-TK"){
                        $divisi = '02';
                    }elseif($datakaryawan->divisi == "SD"){
                        $divisi = '03';
                    }elseif($datakaryawan->divisi == "SMP"){
                        $divisi = '04';
                    }else{
                        $divisi = '05';
                    }
                
                
                if($cek == 0){
                    $no_surat = $tahun.$divisi."1"; 
                }else{
                    $nodata = Surat::all()->last();
                    $idd = $nodata->id_surat + 1;
                    $no_surat = $tahun.$divisi.$idd; 
                }
                $data = TemporariSurat::where('id_surat',$id)->first();
                
                    $simpan = Surat::insert(
                        [
                            'no_surat' => $no_surat,
                            'id_karyawan' => $data->id_karyawan,
                            'id_cuti' => $data->id_cuti,
                            'tgl_mulai' => $data->tgl_mulai,
                            'tgl_akhir' => $data->tgl_akhir,
                            'sisa' =>$data->sisa,
                            'jumlah' => $data->jumlah,
                            'ket' =>$data->ket,
                            'file' =>$data->file,
                            'rekom1' => '1',
                            'ket_rekom1' => $data->ket_rekom1,
                            'rekom2' => '1',
                            'ket_rekom2' => $data->ket_rekom2,
                            'rekom3' => '1',
                            'ket_rekom3' => $request['ket'],
                            'tgl_surat' =>  now(),
                            'created_at' => now()
                        ]);
               
                        if($simpan > 0){
                            $result = TemporariSurat::find($id);
                            $result->delete();
                        }
                        $ket = 'Telah Di Setujui Oleh Pimpinan yayasan';
                        
             }
                $details = [
                    'name' =>       $datakaryawan->users->name,
                    'divisi' =>     $datakaryawan->users->divisi,
                    'jabatan' =>    $datakaryawan->users->jabatan,
                    'kategori' =>   $datakaryawan->cuti->jenis,
                    'mulai' =>      $datakaryawan->tgl_mulai,
                    'akhir' =>      $datakaryawan->tgl_akhir,
                    'jumlah' =>     $datakaryawan->jumlah,
                    'sisa' =>       $datakaryawan->sisa ,
                    'body' =>       $ket,
                    
                ];
                try{
                    Mail::to($email)->send(new KirimEmail($details));
                } catch (\Exception $e) {
                }   
                return redirect()->back(); 
            }catch(Exception $e){
                return  redirect()->back()->with(['warning'=>'Error']);
            }   

             
    }
   
    public function ditolak($id, Request $request)
    {
                $request->validate([
                            'ket' => 'required',
                        ]);
            try{
                $datakaryawan =  TemporariSurat::where('id_surat',$id)->first();
                $id_karyawana = $datakaryawan->id_karyawan;
                $emailkaryawan =  User::find($id_karyawana);
                $email = $emailkaryawan->email;
                
                 
                    if(Auth::user()->status == '3'||Auth::user()->status == '4'){
                        $result = TemporariSurat::find($id);
                        $result->rekom1= '2';
                        $result->ket_rekom1= $request['ket'];
                        $result->save();
                     }elseif(Auth::user()->status == '2'){
                        $result = TemporariSurat::find($id);
                        $result->rekom2= '2';
                        $result->ket_rekom2= $request['ket'];
                        $result->save();
                     }else{
                        $result = TemporariSurat::find($id);
                        $result->rekom3= '2';
                        $result->ket_rekom3= $request['ket'];
                        $result->save();
                     }
                     $details = [
                        'name' =>       $datakaryawan->users->name,
                        'divisi' =>     $datakaryawan->users->divisi,
                        'jabatan' =>    $datakaryawan->users->jabatan,
                        'kategori' =>   $datakaryawan->cuti->jenis,
                        'mulai' =>      $datakaryawan->tgl_mulai,
                        'akhir' =>      $datakaryawan->tgl_akhir,
                        'jumlah' =>     $datakaryawan->jumlah,
                        'sisa' =>       $datakaryawan->sisa ,
                        'body' =>       "Mohon Maaf, Pengajuan cuti anda telah ditolak!",
                    ];
                    try{
                        Mail::to($email)->send(new KirimEmail($details));
                    } catch (\Exception $e) {
                    }    
                    return redirect()->back();   
            } catch (\Exception $e) {
            } 
                    
        } 

        public function ditolakOb($id, Request $request){
                $request->validate([
                            'ket' => 'required',
                        ]);
            try{
                $datakaryawan =  TemporariSurat::where('id_surat',$id)->first();
                $id_karyawana = $datakaryawan->id_karyawan;
                $emailkaryawan =  User::find($id_karyawana);
                $email = $emailkaryawan->email;
                
                    if(Auth::user()->status == '2'){
                        $result = TemporariSurat::find($id);
                        $result->rekom2= '2';
                        $result->ket_rekom2= $request['ket'];
                        $result->save();
                     }else{
                        $result = TemporariSurat::find($id);
                        $result->rekom3= '2';
                        $result->ket_rekom3= $request['ket'];
                        $result->save();
                     }
                        $details = [
                            'name' =>       $datakaryawan->users->name,
                            'divisi' =>     $datakaryawan->users->divisi,
                            'jabatan' =>    $datakaryawan->users->jabatan,
                            'kategori' =>   $datakaryawan->cuti->jenis,
                           'mulai' =>      $datakaryawan->tgl_mulai,
                           'akhir' =>      $datakaryawan->tgl_akhir,
                           'jumlah' =>     $datakaryawan->jumlah,
                           'sisa' =>       $datakaryawan->sisa ,
                           'body' =>       "Pengajuan cuti anda telah ditolak!",
                        ];
                           
                        try{
                            Mail::to($email)->send(new KirimEmail($details));
                        } catch (\Exception $e) {
                        }   
                 return redirect()->back();   
            } catch (\Exception $e) {
            } 
                        
        } 
}
