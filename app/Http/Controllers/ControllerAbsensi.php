<?php

namespace App\Http\Controllers;
use App\Exports\AbsensiKaryawanExport;
use App\Exports\BmtExport;
use App\Exports\FormatSlipGaji;
use App\Models\Absensi;
use App\Models\AbsensiSah;
use App\Models\CommandLog;
use App\Models\LogEdit;
use App\Models\Mesin;
use App\Models\RekapAbsensi;
use App\Models\User;
use App\Models\Waktu;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ControllerAbsensi extends Controller
{
    public function absensiMasukHarian(Request $request){
        if(Auth::check() && (Auth::user()->status == 2 || Auth::user()->status == 4 || Auth::user()->status == 10|| Auth::user()->status == 0)){
            $aktive = "absensi";
            $now = date('Y-m-d');
            
            if(Auth::user()->status == 10){
                $divisi = Auth::user()->divisi;
            }else{
                $divisi = $request['divisi']??'YAYASAN';
            }
            
                if($request['divisi'] == 'ALL'){
                    $data = AbsensiSah::join('users','users.id_absensi_karyawan', '=','tbl_absensi_sah.id_absensi_karyawan')
                    ->whereDate('tbl_absensi_sah.tgl_absen','=', $now)
                    ->groupBy('tbl_absensi_sah.id_absensi_karyawan')
                    ->orderBy('tbl_absensi_sah.id_absensi_karyawan',"ASC")
                    ->get();  
                }else{
                $data = AbsensiSah::join('users','users.id_absensi_karyawan', '=','tbl_absensi_sah.id_absensi_karyawan')
                    ->where('users.divisi','=', $divisi)
                    ->whereDate('tbl_absensi_sah.tgl_absen','=', $now)
                    ->groupBy('tbl_absensi_sah.id_absensi_karyawan')
                    ->orderBy('tbl_absensi_sah.id_absensi_karyawan',"ASC")
                    ->get();  
                }
            
            return view('fingerprint.dataAbsensiHarianView',['aktive'=>$aktive,'data'=>$data,'divisi'=>$divisi]);
          
        }else{
            return redirect('/');
        }
    }

    public function viewFormAddUserAbsensi(){
        if(Auth::check() &&  Auth::user()->status == 0){
            $aktive = "absensi";
            $datas = User::where('status','!=',0)->where('status_kerja','!=',0)->get();
            $mesinAbsensi = Mesin::all();
            return view('fingerprint.formAddUserAbsen',['aktive'=>$aktive,'datas'=>$datas,'mesinAbsensi'=>$mesinAbsensi]);
        }else{
            return redirect('/');
        } 
    }
     public function viewFormAddDataAbsensi(){
        if(Auth::check() &&  (Auth::user()->status == 4 || Auth::user()->status == 0)){
            $aktive = "absensi";
            $datas = User::where('status','!=',0)->where('status_kerja','!=',0)->get();
            $mesinAbsensi = Mesin::all();
            return view('fingerprint.formAddAbsensi',['aktive'=>$aktive,'datas'=>$datas,'mesinAbsensi'=>$mesinAbsensi]);
        }else{
            return redirect('/');
        } 
    }
    public function addUserAbsensi(Request $request){
        if(Auth::check() &&  Auth::user()->status == 0){
            $request->validate([
                'nama' => 'required',
                'id_absensi' => 'required',
                'mesin' => 'required',
            ]);
            $id_absensi = $request['id_absensi'];
            $nama = $request['nama'];
            $idmesin = $request['mesin'];

                        $gtid =  DB::select("SELECT max(cmd_id)+1 as `idm` from command_log where idmesin='".$idmesin."'");

                        $data = array(
                                'idmesin' => $idmesin,
                                'cmd_id' => !$gtid[0]->idm?1:$gtid[0]->idm,
                                'perintah' => "C:".(!$gtid[0]->idm?1:$gtid[0]->idm).":DATA UPDATE USERINFO PIN=".$id_absensi."\tName=".$nama."\tPasswd=\tCard=\tGrp=\tTZ=\tPri=0",
                                'nilai_res' => '0'
                            );
                        CommandLog::insert($data); 
            return redirect('form-add-user-absensi-view')->with(['info'=>'User Berhasil Ditambahkan Ke Mesin']);
        }else{
            return redirect('/');
        } 
    }
    public function addDataAbsensi(Request $request){
        if(Auth::check() && (Auth::user()->status == 4 || Auth::user()->status == 0)){
            $request->validate([
                'nama' => 'required',
                'id_absensi' => 'required',
                'tgl' => 'required',
                'status_masuk' => 'required',
            ]);
            $id_absensi = $request['id_absensi'];
            $nama = $request['nama'];
            $tgl = $request['tgl'];
            $jam_fingert = date('H:i:s', strtotime($tgl));
            $tanggal = date('Y-m-d', strtotime($tgl));
            $status_masuk = $request['status_masuk'];
            $user = User::where('id_absensi_karyawan',$id_absensi)->first();
            $waktu = Waktu::where('divisi',$user->divisi)->first();
            $cekData = AbsensiSah::where('id_absensi_karyawan','=',$user->id_absensi_karyawan)->whereDate('tgl_absen','=',$tanggal)->first();
            
                    if($status_masuk == 0){
                        if($jam_fingert <= $waktu->masuk){
                            $total_telat = '0'; 
                        }else{
                            $to = Carbon::createFromFormat('H:i:s', $waktu->masuk);
                            $from = Carbon::createFromFormat('H:i:s', $jam_fingert);

                            $telat = $to->diffInSeconds($from);
                            $total_telat = $telat;								
                        }
                        if ($cekData == null) {
                            AbsensiSah::insert([
                                'id_mesin' => '3',
                                'id_absensi_karyawan' => $user->id_absensi_karyawan,
                                'jumlah_hadir' => 0,
                                'tgl_absen' => date('Y-m-d', strtotime($tgl)),
                                'jam_masuk' => $jam_fingert,
                                'jam_pulang' => '00:00:00',
                                'telat_masuk' => $total_telat, 
                                'cepat_pulang' => '0',
                            ]); 
                        }else{
                            $cekData->jam_masuk = $jam_fingert;
                            $cekData->telat_masuk = $total_telat;
                            $cekData->save();
                        }
                        
                    }else{
                        if($jam_fingert >= $waktu->pulang){
                            $total_telat = '0';
                        }else if($jam_fingert >= '12:00:00' && date('l', strtotime($tgl)) == 'Friday' && $user->divisi != 'YAYASAN'){
                            $total_telat = '0';
                        }else{
                            if(date('l', strtotime($tgl)) == 'Friday'  && $user->divisi != 'YAYASAN'){
                                $to = Carbon::createFromFormat('H:i:s', "12:00:00");
                                $from = Carbon::createFromFormat('H:i:s', $jam_fingert);

                                $telat = $to->diffInSeconds($from);
                                $total_telat = $telat;
                            }else{
                                $to = Carbon::createFromFormat('H:i:s', $waktu->pulang);
                                $from = Carbon::createFromFormat('H:i:s', $jam_fingert);

                                $telat = $to->diffInSeconds($from);
                                $total_telat = $telat;
                            }
                           
                            
                        }     
                        if ($cekData != null) {
                            $cekData->jam_pulang = $jam_fingert;
                            $cekData->cepat_pulang = $total_telat;
                            $cekData->save();
                        }else{
                            AbsensiSah::insert([
                                'id_mesin' => '3',
                                'id_absensi_karyawan' => $user->id_absensi_karyawan,
                                'jumlah_hadir' => 0,
                                'tgl_absen' => date('Y-m-d', strtotime($tgl)),
                                'jam_pulang' => $jam_fingert,
                                'jam_masuk' => '00:00:00',
                                'cepat_pulang' => $total_telat,
                                'telat_masuk' => '0',
                            ]); 
                        }
                        
                    }
                    $cekDataLagi = AbsensiSah::where('id_absensi_karyawan','=',$user->id_absensi_karyawan)
                    ->whereDate('tgl_absen','=',$tanggal)
                    ->where('jam_masuk','!=',"00:00:00")
                    ->where('jam_pulang','!=',"00:00:00")
                    ->count();  
                    if($cekDataLagi > 0){
                        $cekData->jumlah_hadir = 1;
                        $cekData->save();
                    } 
            return redirect('form-add-data-absensi-view')->with(['info'=> $nama.' Berhasil Ditambahkan Kehadiran '.$tgl]);
        }else{
            return redirect('/');
        } 
    }
        
    public function rekapAbsensiView(){
        if(Auth::check() && (Auth::user()->status == 2 || Auth::user()->status == 4 || Auth::user()->status == 10|| Auth::user()->status == 0)){
            $aktive = "absensi";
            $data =[];
            $mulai = ""; 
            $akhir = "";  
            return view('fingerprint.rekapAbsensiViews',['aktive'=>$aktive,'data'=>$data,'mulai'=>$mulai,'akhir'=>$akhir]);
        }else{
            return redirect('/');
        }
    }
    public function Kehadiran(){
            $aktive = "absensi";
            $data =[];
            $mulai = ""; 
            $akhir = ""; 
            return view('fingerprint.absensiPribadi',['aktive'=>$aktive,'data'=>$data,'mulai'=>$mulai,'akhir'=>$akhir]);
    }
    
     public function rekapAbsensiBulanan(Request $request){
        if(Auth::check() && (Auth::user()->status == 2 || Auth::user()->status == 4  || Auth::user()->status == 10|| Auth::user()->status == 0)){
            $request->validate([
                'mulai' => ['required'],
                'akhir' => ['required'],
            ]);
            $aktive = "absensi";
            $divisi = Auth::user()->divisi;
            $mulai = $request['mulai']; 
            $akhir = $request['akhir']; 
            $select  = "a.id_absensi_karyawan,a.nik,a.name,a.jabatan,a.jk,a.tgl_mulai_bekerja,a.divisi,a.status_karyawan,SUM(IF(b.jumlah_hadir = 1,b.jumlah_hadir, 0)) as kehadiran,
            COALESCE(SUM(b.telat_masuk), 0) as total_terlambat,
            COALESCE(SUM(b.telat_kembali), 0) as total_telat_siang,
            COALESCE(SUM(b.jumlah_hadir), 0) as total_kehadiran,
            COALESCE(SUM(b.cepat_pulang), 0) as total_cepat_pulang";
           
                if(Auth::user()->status == 2 || Auth::user()->status == 0){
              
                        $data = DB::table('users as a')
                        ->selectRaw($select)
                        ->leftJoin('tbl_absensi_sah as b', function ($join) use ($mulai, $akhir) {
                            $join->on('a.id_absensi_karyawan', '=', 'b.id_absensi_karyawan')
                                    ->whereRaw('b.tgl_absen >= ? AND b.tgl_absen <= ?', [$mulai, $akhir])
                                    ->orWhereNull('b.tgl_absen');
                        })
                        ->where('a.status_kerja', '=', 1)
                        ->where('a.status', '!=', 0)
                        ->groupBy('a.id_absensi_karyawan')
                        ->orderBy('a.divisi','ASC') 
                        ->orderBy('a.status','ASC') 
                        ->get();
                }elseif(Auth::user()->divisi == 'KB-TK'){
                     
                        $data = DB::table('users as a')
                        ->selectRaw($select)
                        ->leftJoin('tbl_absensi_sah as b', function ($join) use ($mulai, $akhir) {
                            $join->on('a.id_absensi_karyawan', '=', 'b.id_absensi_karyawan')
                                 ->whereRaw('b.tgl_absen >= ? AND b.tgl_absen <= ?', [$mulai, $akhir])
                                 ->orWhereNull('b.tgl_absen');
                        })
                        ->where('a.status_kerja', '=', 1)
                        ->where('a.status', '!=', 0)
                        ->where('a.divisi','=', "DAYCARE")
                        ->orWhere('a.divisi','=', $divisi)
                        ->groupBy('a.id_absensi_karyawan')
                        ->orderBy('a.divisi','ASC') 
                        ->orderBy('a.status','ASC') 
                        ->get();
                }else{
                        $data = DB::table('users as a')
                        ->selectRaw($select)
                        ->leftJoin('tbl_absensi_sah as b', function ($join) use ($mulai, $akhir) { 
                            $join->on('a.id_absensi_karyawan', '=', 'b.id_absensi_karyawan')
                                    ->whereRaw('b.tgl_absen >= ? AND b.tgl_absen <= ?', [$mulai, $akhir])
                                    ->orWhereNull('b.tgl_absen');
                        })
                        ->where('a.status_kerja', '=', 1)
                        ->where('a.status', '!=', 0)
                        ->where('a.divisi','=', $divisi)
                        ->groupBy('a.id_absensi_karyawan')
                        ->orderBy('a.divisi','ASC') 
                        ->orderBy('a.status','ASC') 
                        ->get();
                }
               
   
            return view('fingerprint.rekapAbsensiViews',['aktive'=>$aktive,'data'=>$data,'mulai'=>$mulai,'akhir'=>$akhir]);
        }else{
            return redirect('/');
        }
    }
      public function kehadiranKaryawan(Request $request){
            $request->validate([
                'mulai' => ['required'],
                'akhir' => ['required'],
            ]);
            $aktive = "absensi";
            $iduser = Auth::user()->id;
            $mulai = $request['mulai']; 
            $akhir = $request['akhir']; 
            $select  = "a.id_absensi_karyawan,a.nik,a.name,a.jabatan,a.jk,a.tgl_mulai_bekerja,a.divisi,a.status_karyawan,SUM(IF(b.jumlah_hadir = 1,b.jumlah_hadir, 0)) as kehadiran,
            COALESCE(SUM(b.telat_masuk), 0) as total_terlambat,
            COALESCE(SUM(b.telat_kembali), 0) as total_telat_siang,
            COALESCE(SUM(b.jumlah_hadir), 0) as total_kehadiran,
            COALESCE(SUM(b.cepat_pulang), 0) as total_cepat_pulang";
              
            $data = DB::table('users as a')
            ->selectRaw($select)
            ->leftJoin('tbl_absensi_sah as b', function ($join) use ($mulai, $akhir) {
                $join->on('a.id_absensi_karyawan', '=', 'b.id_absensi_karyawan')
                        ->whereRaw('b.tgl_absen >= ? AND b.tgl_absen <= ?', [$mulai, $akhir])
                        ->orWhereNull('b.tgl_absen');
            })
            ->where('a.id', $iduser)
            ->groupBy('a.id_absensi_karyawan')
            ->orderBy('a.divisi','ASC') 
            ->orderBy('a.status','ASC') 
            ->get();
   
            return view('fingerprint.absensiPribadi',['aktive'=>$aktive,'data'=>$data,'mulai'=>$mulai,'akhir'=>$akhir]);
        
    }

    public function detailAbsensiKaryawan($id_absensi,$tgl_awal,$tgl_akhir){
            $aktive = "absensi";            
            $data = AbsensiSah::join('users','users.id_absensi_karyawan', '=','tbl_absensi_sah.id_absensi_karyawan')
            ->select('tbl_absensi_sah.*','users.name','users.divisi','users.jabatan')
            ->where('tbl_absensi_sah.id_absensi_karyawan', '=',$id_absensi )
            ->whereDate('tbl_absensi_sah.tgl_absen', '>=',$tgl_awal)
            ->whereDate('tbl_absensi_sah.tgl_absen', '<=',$tgl_akhir)
            ->orderBy('tbl_absensi_sah.tgl_absen',"ASC")
            ->get();
            return view('fingerprint.detailAbsensiKaryawanView',['aktive'=>$aktive,'data'=>$data,'id_absensi'=>$id_absensi,'tgl_awal'=>$tgl_awal,'tgl_akhir'=>$tgl_akhir]);
    }
    public function exportAbsensi($tgl_awal,$tgl_akhir,$divisi){
        if(Auth::check() && ( Auth::user()->status == 2 || Auth::user()->status == 10|| Auth::user()->status == 0)){
            try{
                return Excel::download(new AbsensiKaryawanExport($tgl_awal,$tgl_akhir), 'Rekap Absensi '.Auth::user()->divisi.'.xlsx');
            }catch(Exception $e){
                return redirect()->back()->with(['warning'=>$e->getMessage()]);
            }
             
        }else{
            return redirect()->back()->with(['warning'=>'Tentukan Periode Absesensi Sebelum Export']);
        }
        
    }
    public function formatExportAbsensiSlipGaji($tgl_awal,$tgl_akhir){
        if(Auth::check() && ( Auth::user()->status == 2 || Auth::user()->status == 10|| Auth::user()->status == 0)){
            try{
                return Excel::download(new FormatSlipGaji($tgl_awal,$tgl_akhir), 'Format Slip Gaji '.date('m Y').'.xlsx');
            }catch(Exception $e){
                return redirect()->back()->with(['warning'=>$e->getMessage()]);
            }
             
        }else{
            return redirect()->back()->with(['warning'=>'Tentukan Periode Absesensi Sebelum Export']);
        }
        
    }
    public function exportLaporanBulananBMT(){ 
        if(Auth::check()){
            try{             
                return Excel::download(new BmtExport(), 'Rekap Laporan Bulanan BMT.xlsx');
            }catch(Exception $e){
                return redirect()->back()->with(['warning'=>'Gagal Mendownload Data']);

            }
    
             
        }else{
            return redirect()->back()->with(['warning'=>'Tentukan Periode Absesensi Sebelum Export']);
        }
        
    }
}
