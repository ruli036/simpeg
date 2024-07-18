<?php

namespace App\Http\Controllers;

use App\Exports\SlipGajiExport;
use App\Exports\TemplateFormatSlipGaji;
use App\Imports\SlipGajiImport;
use App\Jobs\SendUsersImportedNotificationJob;
use App\Mail\KirimEmail;
use App\Models\LogEdit;
use App\Models\MasterItemGaji;
use App\Models\RiwayatAproval;
use App\Models\RiwayatGaji;
use App\Models\RiwayatSlipGaji;
use App\Models\SlipGaji;
use App\Models\UpahTambahan;
use App\Models\User;
use App\Notifications\EmailNotification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ControllerSlipGaji extends Controller
{
    public function daftarslipgaji(){
        if(Auth::check() && (Auth::user()->status == 0 ||Auth::user()->status == 1||Auth::user()->status == 2||Auth::user()->status == 4)){
            $cari ='';
            $no = 1;
            $aktive ="slipGaji";
            $select  = "a.id,a.nik, a.name, a.divisi,a.jabatan,b.periode,SUM(IF(c.flag = 'P', b.amount, 0)) as subtotal, 
            SUM(IF(c.flag = 'M', b.amount, 0)) as potongan, 
            SUM(IF(c.flag = 'P', b.amount, 0)) - SUM(IF(c.flag = 'M', b.amount, 0)) as total";
            $datas = DB::table('users as a')
            ->selectRaw($select)
            ->join('riwayat_gaji as b', function ($join) {
                $join->on('a.id', '=', 'b.id_karyawan');
            })
            ->join('master_item_gaji as c', 'b.id_componen_gaji', '=', 'c.id')
            ->groupBy('a.id','b.periode')
            ->orderBy('b.periode','DESC')
            ->orderBy('a.name','ASC')
            ->paginate(15)->withQueryString();
       
            return view('slipGaji.daftarslipgaji',['aktive'=>$aktive,'datas'=>$datas,'cari'=>$cari,'no'=>$no]);
         }else{
            return redirect('/');
        }
     }
     public function pencarianSlipGaji(Request $request){
        
        if(Auth::check() && (Auth::user()->status == 0 ||Auth::user()->status == 1||Auth::user()->status == 2||Auth::user()->status == 4)){
            $cari = $request['cari'];
            $no = 1;
            $aktive ="daftarslip";
            
             $select  = "a.id,a.nik, a.name, a.divisi,a.jabatan,b.periode,SUM(IF(c.flag = 'P', b.amount, 0)) as subtotal, 
             SUM(IF(c.flag = 'M', b.amount, 0)) as potongan, 
             SUM(IF(c.flag = 'P', b.amount, 0)) - SUM(IF(c.flag = 'M', b.amount, 0)) as total";
             $datas = DB::table('users as a')
             ->selectRaw($select)
             ->join('riwayat_gaji as b', function ($join) {
                 $join->on('a.id', '=', 'b.id_karyawan');
             })
             ->join('master_item_gaji as c', 'b.id_componen_gaji', '=', 'c.id')
             ->where('a.name', 'like', "%{$cari}%")
             ->orWhere('a.nik', 'like', "%{$cari}%")
             ->orWhere('b.divisi', 'like', "%{$cari}%")
             ->orWhere('b.jabatan', 'like', "%{$cari}%")
             ->groupBy('a.id','b.periode')
             ->orderBy('b.periode','DESC')
             ->orderBy('a.name','ASC')
             ->paginate(15)->withQueryString();
            return view('slipGaji.daftarslipgaji',['aktive'=>$aktive,'datas'=>$datas,'cari'=>$cari,'no'=>$no]);
         }else{
            return redirect('/');
        }
     }
     public function componentGaji(){
        if(Auth::check()){
            $aktive ="slipGaji";
            $keyword ='';
             $datas = MasterItemGaji::orderBy('stts','ASC')->orderBy('colom','ASC')->get();      
             $kodeRek =   DB::connection('finance')->table('rekening')->selectRaw("kode,nama")->orderBy('kode','ASC')->get();    
                // return $kodeRek;
             return view('slipGaji.componentGaji',['aktive'=>$aktive,'datas'=>$datas,'kodeRek'=>$kodeRek,'keyword'=>$keyword]);
         }else{
            return redirect('/');
        }
     }
     public function searchcomponen(Request $request){
        $aktive = 'users';
        $keyword = $request->cari;
            $datas = MasterItemGaji::where('nama', 'like', '%' . $keyword . '%')->orderBy('colom','ASC')->paginate(10);      
            $kodeRek =   DB::connection('finance')->table('rekening')->selectRaw("kode,nama")->orderBy('kode','ASC')->get();    
            return view('slipGaji.componentGaji',['aktive'=>$aktive,'datas'=>$datas,'kodeRek'=>$kodeRek,'keyword'=>$keyword]);
       
    } 
      public function addComponentGaji(Request $request){
        if(Auth::check()){
            $validate = $request->validate([
                'nama' =>'required',
                'colom' =>'required',
                'akun_debet' =>'required',
                'akun_credit' =>'required',
            ]);
          
            MasterItemGaji::create($validate);
            
            return redirect()->route('component');
         }else{
            return redirect('/');
        }
     }
     public function editComponentGaji($id,Request $request){
        if(Auth::check()){
            $validate = $request->validate([
                'e_nama' =>'required',
                'e_colom' =>'required',
                'e_flag' =>'required',
                'e_akun_debet' =>'required',
                'e_akun_credit' =>'required',
            ]);
            if($request->e_akun_debet == $request->e_akun_credit){
                return redirect()->back()->with(['warning'=>'Akun debet tidak boleh sama dengan akun credit !']);
            }
            MasterItemGaji::find($id)->update([
                'nama' => $request->e_nama,
                'colom' => $request->e_colom,
                'flag' => $request->e_flag,
                'akun_debet' =>$request->e_akun_debet,
                'akun_credit' =>$request->e_akun_credit,
            ]);
            // return $validate;
            return redirect()->route('component');
         }else{
            return redirect('/');
        }
     }
     public function hapusComponentGaji(Request $request){
        $component = MasterItemGaji::find($request->idcomponent);
        if($request->centang == 'y'){
            $component->delete();
        }else{
            if($component->stts == 'A'){
                // dd('non');
                $component->stts = "N";
                $component->save();
            }else{
                // dd('ak');
                $component->stts = "A";
                $component->save();
            }
        }
       
        return redirect('item-gaji');
    }
      public function halamanexport(){
        if(Auth::check()){
            $aktive ="slipGaji";
             $datas = [];          
             $bln = '';
             $thn = '';
             $divisi = '';
             $totalSeluruhGaji= 0;
             return view('slipGaji.exportslipgaji',['aktive'=>$aktive,'datas'=>$datas,'totalSeluruhGaji'=>$totalSeluruhGaji,'bln'=>$bln,'thn'=>$thn,'divisi'=>$divisi]);
         }else{
            return redirect('/');
        }
     }
      public function riwayatimport(){
        if(Auth::check()){
            $aktive ="slipGaji";
             $datas = RiwayatSlipGaji::select('tbl_riwayat_slip.*', DB::raw("DATE_FORMAT(tgl, '%m-%Y') new_date"),
             DB::raw('YEAR(tgl) year,MONTH(tgl) month'))
             ->orderBy('year','DESC')
             ->orderBy('month','DESC')
             ->get();  
             $divisi = Auth::user()->divisi;
             return view('slipGaji.riwayatslipgaji',['aktive'=>$aktive,'datas'=>$datas,'divisi'=>$divisi]);
         }else{
            return redirect('/');
        }
     }
      public function filter(Request $request){
        if(Auth::check()){
            $request->validate([
                'bulan' =>'required',
                'tahun' =>'required',
                'divisi' =>'required',
            ]);
            $aktive ="slipGaji";
            $bln = $request['bulan'];
            $thn = $request['tahun'];
            $divisi = $request['divisi'];
            $select  = "a.id,a.nik, a.name, a.divisi,a.jabatan,b.periode,SUM(IF(c.flag = 'P', b.amount, 0)) as subtotal, 
            SUM(IF(c.flag = 'M', b.amount, 0)) as potongan, 
            SUM(IF(c.flag = 'P', b.amount, 0)) - SUM(IF(c.flag = 'M', b.amount, 0)) as total";
            if($divisi == 'all'){
                $datas = DB::table('users as a')
                    ->selectRaw($select)
                    ->join('riwayat_gaji as b', function ($join) use($bln,$thn){
                        $join->on('a.id', '=', 'b.id_karyawan')
                        ->whereMonth('b.periode', $bln)
                        ->whereYear('b.periode', $thn);
                    })
                    ->join('master_item_gaji as c', 'b.id_componen_gaji', '=', 'c.id')
                    ->groupBy('a.id')
                    ->orderBy('b.divisi','DESC')
                    ->orderBy('a.name','ASC')
                    ->get();
               
                    $totalSeluruhGaji =   DB::table('riwayat_gaji as a')
                    ->selectRaw("SUM(IF(b.flag = 'P', a.amount, 0)) - SUM(IF(b.flag = 'M', a.amount, 0)) as total")
                    ->whereMonth('a.periode',$bln)->whereYear('a.periode',$thn)
                    ->join('master_item_gaji as b', 'a.id_componen_gaji', '=', 'b.id')->first(); 
            }else{
                $datas = DB::table('users as a')
                ->selectRaw($select)
                ->join('riwayat_gaji as b', function ($join) use($bln,$thn,$divisi){
                    $join->on('a.id', '=', 'b.id_karyawan')
                    ->where('b.divisi',$divisi)
                    ->whereMonth('b.periode', $bln)
                    ->whereYear('b.periode', $thn);
                })
                ->join('master_item_gaji as c', 'b.id_componen_gaji', '=', 'c.id')
                ->groupBy('a.id')
                ->orderBy('a.name','ASC')
                ->get();
                
              $totalSeluruhGaji =   DB::table('riwayat_gaji as a')
             ->selectRaw("SUM(IF(b.flag = 'P', a.amount, 0)) - SUM(IF(b.flag = 'M', a.amount, 0)) as total")
             ->whereMonth('a.periode',$bln)->whereYear('a.periode',$thn)->where('a.divisi',$divisi)
             ->join('master_item_gaji as b', 'a.id_componen_gaji', '=', 'b.id')->first(); 
              }
            if(count($datas)>0){
                return view('slipGaji.exportslipgaji',['aktive'=>$aktive,'datas'=>$datas,'totalSeluruhGaji'=>$totalSeluruhGaji->total,'divisi'=>$divisi,'thn'=>$thn,'bln'=>$bln]);
            }else{
                return redirect()->back()->with(['info'=>'Data Tidak Ditemukan']);
            }
         }else{
            return redirect('/');
        }
     }
        public function daftarslipgajikaryawan(){
        if(Auth::check()){
            $aktive ="users";
            $id = Auth::user()->id;
            $select  = "a.id,a.nik, a.name, a.divisi,a.jabatan,b.periode,SUM(IF(c.flag = 'P', b.amount, 0)) as subtotal, 
            SUM(IF(c.flag = 'M', b.amount, 0)) as potongan, 
            SUM(IF(c.flag = 'P', b.amount, 0)) - SUM(IF(c.flag = 'M', b.amount, 0)) as total";
            $datas = DB::table('users as a')
            ->selectRaw($select)
            ->join('riwayat_gaji as b', function ($join) {
                $join->on('a.id', '=', 'b.id_karyawan');
            })
            ->join('master_item_gaji as c', 'b.id_componen_gaji', '=', 'c.id')
            ->where('a.id',$id)
            ->groupBy('a.id','b.periode')
            ->orderBy('b.periode','DESC')
            ->orderBy('a.name','ASC')
            ->get();
            
            
            // $datas = SlipGaji::where('nik',$id)->orderBy('bulan','DESC')->get();   
             return view('slipGaji.slipgaji',['aktive'=>$aktive,'datas'=>$datas]);
         }else{
            return redirect('/');
        }
     }
       public function aprovalSlipGajiView(){
        if(Auth::check() && (Auth::user()->status == 0 ||Auth::user()->status == 4)){
            $aktive ="daftarslip";
            $divisi ="";
            $bulan ="";
            $tahun ="";
            $totalSeluruhGaji = 0;
            $datas= [];
             return view('slipGaji.aprovalSlipGaji',['aktive'=>$aktive,'datas'=>$datas,'divisi'=>$divisi,'bulan'=>$bulan,'tahun'=>$tahun,'totalSeluruhGaji'=>$totalSeluruhGaji]);
         }else{
            return redirect('/');
        }
     }
   
    //   public function formslipgaji(Request $request){
    //     if(Auth::check()){
    //         $aktive ="daftarslip";
    //         $datas = DB::select("SELECT * from users where status != '0' AND status_kerja = '1' order by name asc ");
    //          return view('slipGaji.formslipgaji',['aktive'=>$aktive,'datas'=>$datas]);
    //      }else{
    //         return redirect('/');
    //     }
    //  }
    //   public function editslip($id){
    //     if(Auth::check()){
    //         $aktive ="daftarslip";
    //         $dataitem = SlipGaji::where('id_slip',$id)->first();
    //         $upah_tambahan = UpahTambahan::where('id_slip',$id)->get();
    //         $tahun = date('Y', strtotime($dataitem->bulan));
    //         $bulan = date('m', strtotime($dataitem->bulan));
    //          return view('slipGaji.editslipgaji',['aktive'=>$aktive,'dataitem'=>$dataitem,'upah_tambahan'=>$upah_tambahan,'tahun'=>$tahun,'bulan'=>$bulan]);
    //      }else{
    //         return redirect('/');
    //     }
    // }
     public function edit_upah($id,Request $request){
         $id_slip = UpahTambahan::where('id_upah',$id)->first();
        $result = UpahTambahan::find($id);
        $result->ket = $request['_ket'];
        $result->jumlah = str_replace(',', '',$request['_upah_tambahan']);
        $result->save();
 
        if($result){
              $upah_tambah = UpahTambahan::where('id_slip',$id_slip->id_slip)->sum('jumlah');
            $result1 = SlipGaji::find($id_slip->id_slip);
            $result1->total_upah_lain = $upah_tambah;
            $result1->save();
        }
      
        return redirect()->back()->with(['info_upah' => 'Upah Berhasil Diubah']);
     } 
     public function detailslipgaji($id,$periode){
        if(Auth::check()){
            $aktive ="users";
            
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

            $masterGaji = MasterItemGaji::where('stts','A')->get();

            return view('slipGaji.detailslipgaji',['aktive'=>$aktive,'masterGaji'=>$masterGaji,'masukan'=>$masukan,'potongan'=>$potongan,'datas'=>$datas]);
         }else{
            return redirect('/');
        }
     }
     public function addItemGaji(Request $request){
        $validate = $request->validate([
            'id_componen_gaji' =>'required',
            'amount' =>'required',
            'id_karyawan' =>'required',
            'jabatan' =>'required',
            'divisi' =>'required',
            'periode' =>'required',
            'stts_karyawan' =>'required',
            'id_aprov' =>'required',
            'aprov' =>'required',
            'sync' =>'required',
        ]);
        $cek = RiwayatGaji::where('id_componen_gaji',$request['id_componen_gaji'])
        ->where('id_karyawan',$request['id_karyawan'])
        ->where('periode',$request['periode'])
        ->count();
        if($cek > 0){
            return redirect()->back()->with(['warning'=>'Duplikat komponen gaji, komponen yang anda pilih sudah ada!']);
        }else{
             unset($validate['amount']);
            $validate['amount'] = str_replace(',', '',$request['amount']);
            RiwayatGaji::create($validate);
        return redirect()->back()->with(['info'=>'Berhasil menambahkan komponen gaji']);
        }
       
     }
    public function editItemGaji(Request $request){
         $request->validate([
            'iditem' =>'required',
            'amount' =>'required',
        ]);
        $cek = RiwayatGaji::find($request['iditem']);
        $cek->amount = str_replace(',', '',$request['amount']);
        $cek->save();
        
       return redirect()->back()->with(['info'=>'Berhasil mengubah data']);
     }
    public function deleteItemGaji($id){
         
        $cek = RiwayatGaji::find($id);
        $cek->delete();
        
       return redirect()->back()->with(['info'=>'Berhasil menghapus komponen gaji']);
     }
   
        // delete Slip
        public function hapusslip($id,$periode){
            try{
                
                RiwayatGaji::where('id_karyawan',$id)->where('periode',$periode)->delete();
                 
                LogEdit::insert([
                    'id_karyawan' => Auth::user()->id,
                    'nama' => Auth::user()->name,
                    'keterangan' => 'menghapus slip gaji',
                    'date' => now(),
                ]);
                return redirect()->back()->with(['info' => 'Data Berhasil Dihapus']);
            }catch(Exception $e){
                return  redirect()->back()->with(['warning'=>'Error']);
            } 
       } 
        // delete Slip
        public function hapusriwayatimport($id){
            $result = RiwayatSlipGaji::find($id);
            $result->delete();
            try{
                 unlink(\public_path().'/slipgaji/'.$result->file);
            }catch (\Exception $e) {
                
            }
                    
            return redirect()->back()->with(['warning' => 'Riwayat Inmport Telah Dihapus']);
       } 
       public function hapus_upah($id){
        $id_slip = UpahTambahan::where('id_upah',$id)->first();
            $result = UpahTambahan::find($id);
            $result->delete();

            if($result){
                  $upah_tambah = UpahTambahan::where('id_slip',$id_slip->id_slip)->sum('jumlah');
                $result1 = SlipGaji::find($id_slip->id_slip);
                $result1->total_upah_lain = $upah_tambah;
                $result1->save();
            }
            return redirect()->back()->with(['warning_upah' => 'Upah Berhasil Dihapus']);
       }
         public function hapusbanyakdata(Request $request){
             $request->validate([
                 'divisi'=>'required',
                 'bulan'=>'required',
                 'tahun'=>'required',
                 'centang'=>'required',
             ]);
            $bln = $request['bulan'];
            $thn = $request['tahun'];
            $divisi = $request['divisi'];
            $format = $thn.'-'.$bln.'-01';
            $tgl = date('F Y', strtotime($format));
            if($divisi == 'all'){
                RiwayatGaji::whereMonth('periode',$bln)->whereYear('periode',$thn)->delete();
            }else{
                RiwayatGaji::where('divisi',$divisi)->whereMonth('periode',$bln)->whereYear('periode',$thn)->delete();
            }
            
            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'menghapus slip gaji rekapan ',
                'date' => now(),
            ]);
            return redirect()->back()->with(['info' => 'Data Berhasil Dihapus Periode '.$tgl.' Divisi '.$divisi ]);
       }
       public function filterAprovalSlipGaji(Request $request){
        if(Auth::check() && (Auth::user()->status == 0 ||Auth::user()->status == 4)){
             $request->validate([
                 'divisi'=>'required',
                 'bulan'=>'required',
                 'tahun'=>'required',
              ]);
            $aktive='daftarslip';
            $bln = $request['bulan'];
            $thn = $request['tahun'];
            $divisi = $request['divisi'];
            $select  = "a.id,a.nik, a.name, a.divisi,a.jabatan,b.periode,SUM(IF(c.flag = 'P', b.amount, 0)) as subtotal, 
            SUM(IF(c.flag = 'M', b.amount, 0)) as potongan, 
            SUM(IF(c.flag = 'P', b.amount, 0)) - SUM(IF(c.flag = 'M', b.amount, 0)) as total";
            if($divisi == 'all'){
                $datas = DB::table('users as a')
                    ->selectRaw($select)
                    ->join('riwayat_gaji as b', function ($join) use($bln,$thn){
                        $join->on('a.id', '=', 'b.id_karyawan')
                        ->whereMonth('b.periode', $bln)
                        ->whereYear('b.periode', $thn)
                        ->where('b.aprov','N');
                    })
                    ->join('master_item_gaji as c', 'b.id_componen_gaji', '=', 'c.id')
                    ->groupBy('a.id')
                    ->orderBy('b.divisi','DESC')
                    ->orderBy('a.name','ASC')
                    ->get();
               
                    $totalSeluruhGaji =   DB::table('riwayat_gaji as a')
                    ->selectRaw("SUM(IF(b.flag = 'P', a.amount, 0)) - SUM(IF(b.flag = 'M', a.amount, 0)) as total")
                    ->whereMonth('a.periode',$bln)->whereYear('a.periode',$thn)->where('a.aprov','N')
                    ->join('master_item_gaji as b', 'a.id_componen_gaji', '=', 'b.id')->first(); 
            }else{
                $datas = DB::table('users as a')
                ->selectRaw($select)
                ->join('riwayat_gaji as b', function ($join) use($bln,$thn,$divisi){
                    $join->on('a.id', '=', 'b.id_karyawan')
                    ->where('b.divisi',$divisi)
                    ->whereMonth('b.periode', $bln)
                    ->whereYear('b.periode', $thn)
                    ->where('b.aprov','N');
                })
                ->join('master_item_gaji as c', 'b.id_componen_gaji', '=', 'c.id')
                ->groupBy('a.id')
                ->orderBy('a.name','ASC')
                ->get();
                
              $totalSeluruhGaji =   DB::table('riwayat_gaji as a')
             ->selectRaw("SUM(IF(b.flag = 'P', a.amount, 0)) - SUM(IF(b.flag = 'M', a.amount, 0)) as total")
             ->whereMonth('a.periode',$bln)->whereYear('a.periode',$thn)->where('a.divisi',$divisi)->where('a.aprov','N')
             ->join('master_item_gaji as b', 'a.id_componen_gaji', '=', 'b.id')->first(); 
              }
             return view('slipGaji.aprovalSlipGaji',['aktive'=>$aktive,'datas'=>$datas,'divisi'=>$divisi,'bulan'=>$bln,'tahun'=>$thn,'totalSeluruhGaji'=>$totalSeluruhGaji->total]);
        }else{
            return redirect('/');
        }
       }
       public function ApprovedSlipGaji($divisi,$tahun,$bulan){
        $emails = [];
             if($divisi == 'all'){
                $datas = RiwayatGaji::whereMonth('periode', $bulan)
                ->whereYear('periode', $tahun)
                ->where('aprov','N')
                ->groupBy('id_karyawan')
                ->get();
                
                $id = [];
                foreach ($datas as $value) {
                    array_push($id,$value->id); 
                    try{
                        $dataUser = User::select('email')->where('id',$value->id_karyawan)->first();
                        if($dataUser->email != 'alazca758@gmail.com'){
                            array_push($emails, $dataUser->email);
                          }  
                     } catch (\Exception $e) {
                    } 
                    
                 }
                 $riwayatAproval = RiwayatAproval::create([
                    'tgl_aproval' => now(), 
                    'user_aproval' => Auth::user()->id, 
                    'ket' => "Melakukan aproval gaji Untuk semua divisi", 
                 ]);
                 
                 RiwayatGaji::whereMonth('periode', $bulan)
                 ->whereYear('periode', $tahun)
                 ->where('aprov','N')
                 ->update([
                    'id_aprov' => $riwayatAproval->id, 
                    'aprov' => 'Y', 
                ]);
                
                
            }else{
                 $datas = RiwayatGaji::whereMonth('periode', $bulan)
                ->whereYear('periode', $tahun)
                ->where('divisi',$divisi)
                ->where('aprov','N')
                ->groupBy('id_karyawan')
                ->get();
                
                $id = [];
                foreach ($datas as $value) {
                    array_push($id,$value->id); 
                    $dataUser = User::select('email')->where('id',$value->id_karyawan)->first();
                    // return $dataUser;
                    if($dataUser->email != 'alazca758@gmail.com'){
                        array_push($emails, $dataUser->email);
                      }  
                 }
                 $riwayatAproval = RiwayatAproval::create([
                    'tgl_aproval' => now(), 
                    'user_aproval' => Auth::user()->id, 
                    'ket' => "Melakukan aproval gaji untuk divisi ".$divisi, 
                 ]);
                 
                 RiwayatGaji::whereMonth('periode', $bulan)
                 ->whereYear('periode', $tahun)
                 ->where('divisi',$divisi)
                 ->where('aprov','N')
                 ->update([
                    'id_aprov' => $riwayatAproval->id, 
                    'aprov' => 'Y', 
                ]);
             }
             $date = $tahun.'-'.$bulan.'-'.date('d', strtotime(now()));
             $details = [
                'kategori' =>   'Gaji Bulan '.date('F Y', strtotime($date)),
                'mulai' =>      '2',
                'akhir' =>      '-',
                'sisa' =>       '-',
                'jumlah' =>     '-',
                'bulan' =>      date('F Y', strtotime($date)),
                'body' =>       'Gaji Anda Sudah Di Transfer, Semoga Berkah :)',
            ];
            try{
                // Mail::to($emails)->send(new KirimEmail($details));
            } catch (\Exception $e) {
            }        
            return redirect('/aproval-slip-gaji-view')->with(['info'=>'Data Berhasil Disetujui ']);
        }
          
        // export Slip
        public function export(){
            date_default_timezone_set('Asia/Jakarta');
            return Excel::download(new TemplateFormatSlipGaji(), 'Format Slip Gaji '.date('m Y').'.xlsx');    
        }

        public function exportslip(Request $request){
            if($request['bln'] != '' || $request['thn'] != ''){
                $bln = $request['bln'];
                $thn = $request['thn'];
                $divisi = $request['divisi'];   
                return Excel::download(new SlipGajiExport($bln,$thn,$divisi), 'Slip Gaji Bulan '.$bln.' '.$thn.'.xlsx');
            }else{
                return redirect()->back()->with(['warning'=>'Tentukan Divisi,Bulan dan Tahun Sebelum Export']);
            }
            
        }
       
      public function importexcel(Request $request){
        $request->validate([
            'file' => 'required',
            'inputan' => 'required',
        ]);
    
        $file = $request->file('file');
        $fileName = time() . '_' . date('MY') . '_' . $file->getClientOriginalName();
    
        try {
            $file->move('slipgaji', $fileName);
            $file_patch = public_path('/slipgaji/' . $fileName);
    
            Excel::import(new SlipGajiImport($request->input('inputan')), $file_patch);
    
            RiwayatSlipGaji::insert([
                'file' => $fileName,
                'tgl' => now(),
            ]);
    
            return redirect()->back();
        } catch (\Exception $e) { 
            return redirect()->back()->with(['warning' => $e->getMessage()]);
        }
        
          }
       
      
}
