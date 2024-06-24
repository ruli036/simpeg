<?php

namespace App\Http\Controllers;

use App\Models\AnggotaBMT;
use App\Models\BiayaADM;
use App\Models\CicilanPinjaman;
use App\Models\PenarikanWadiah;
use App\Models\PengeluaranADM;
use App\Models\PinjamanBmt;
use App\Models\SetoranBMT;
use App\Models\Surat;
use App\Models\TemporariSurat;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check()){
            $datauser = DB::select("SELECT * FROM users where status != '0' AND  status_kerja = 1");
            $divisi = Auth::user()->divisi; 
            
            $aktive = "home";
            $divisi = Auth::user()->divisi;
            if(Auth::user()->status == '7' || Auth::user()->status == '0'|| Auth::user()->status == '4'|| Auth::user()->status == '1'){
                $infoBmt = AnggotaBMT::select(DB::raw('sum(saldo_bmt) as nominal_bmt'),DB::raw('sum(saldo_wadiah) as nominal_wadiah'),)
                ->where('sts_anggota',0)
                ->first();
                $infoPinjaman = PinjamanBmt::select(DB::raw('sum(nominal) as total_pinjaman'),)
                // ->where('sts_pinjaman', '=', 1 )
                ->where('setuju1', '=', 0 )
                ->where('setuju2', '=', 0 )
                ->where('sts_transfer', '=', 0 )
                ->first();
                $totalPinjamanDiabayar = CicilanPinjaman::select(DB::raw('sum(total_bayar) as total_pinjaman_dibayar'))->first();
                $biayaAdmin = BiayaADM::all()->sum('nominal');
                $totalPengeluaranADM = PengeluaranADM::all()->sum('nominal');
                $anggotaBMT = AnggotaBMT::where('sts_anggota',0)->count();
            }else{
                $getid = AnggotaBMT::where('id_karyawan','=',Auth::user()->id)->first();
                $infoBmt = AnggotaBMT::find($getid->id_anggota_bmt??0);
                $infoPinjaman = '';
                $totalPinjamanDiabayar = '';
                $biayaAdmin = '';
                $totalPengeluaranADM = '';
                $anggotaBMT = AnggotaBMT::where('sts_anggota',0)->count();
                
            }
            if(Auth::user()->status == '4' || Auth::user()->status == '7' || Auth::user()->status == '5'|| Auth::user()->status == '0'||Auth::user()->status == '1'||Auth::user()->status == '2' ){
                $jumlahuser = DB::select("SELECT * FROM users where status_kerja = 1 AND status != 0 ");
                $jumlahuserYA = DB::select("SELECT  *  FROM users where status_kerja = 1 AND status != 0  AND divisi like '%".'YAYASAN'."%'");
                $jumlahuserTK = DB::select("SELECT  *  FROM users where status_kerja = 1 AND status != 0   AND divisi like '%".'KB-TK'."%'");
                $jumlahuserSD = DB::select("SELECT *  FROM users where status_kerja = 1 AND status != 0   AND divisi like '%".'SD'."%'");
                $jumlahuserSMP = DB::select("SELECT  *  FROM users where status_kerja = 1 AND status != 0  AND divisi like '%".'SMP'."%'");
                $jumlahuserDAYCARE = DB::select("SELECT  *  FROM users where status_kerja = 1 AND status != 0   AND divisi like '%".'DAYCARE'."%'");
                $jumlahuserGT = DB::select("SELECT  *  FROM users where status_kerja = 1 AND status != 0 AND (status_karyawan like '%".'GTY'."%' || status_karyawan like '%".'KTY'."%') ");
                $jumlahuserGTT = DB::select("SELECT  *  FROM users where status_kerja = 1 AND status != 0  AND (status_karyawan like '%".'GTTY'."%' || status_karyawan like '%".'KTTY'."%') ");
                $jumlahuserTR = DB::select("SELECT  *  FROM users where status_kerja = 1 AND status != 0 AND status_karyawan like '%".'TR'."%' ");
                $jumlahuserGL = DB::select("SELECT *  FROM users where status_kerja = 1 AND status != 0 AND status_karyawan like '%".'GL'."%' ");
                $jumlahusernon = User::where('status_kerja','0')->count();
                $jumlahsurat = Surat::all()->count();
                return view('home',['anggotaBMT'=>$anggotaBMT,'aktive'=>$aktive,'totalPengeluaranADM'=>$totalPengeluaranADM,'biayaAdmin'=>$biayaAdmin,'totalPinjamanDiabayar'=>$totalPinjamanDiabayar,'infoPinjaman'=>$infoPinjaman,'infoBmt'=>$infoBmt,'jumlahuserYA'=>$jumlahuserYA,'jumlahuserTR'=>$jumlahuserTR,'jumlahuserGL'=>$jumlahuserGL,'jumlahuserGT'=>$jumlahuserGT,'jumlahuserGTT'=>$jumlahuserGTT,'jumlahuser'=>$jumlahuser,'jumlahusernon'=>$jumlahusernon,'jumlahsurat'=>$jumlahsurat,'jumlahuserDAYCARE'=>$jumlahuserDAYCARE,'jumlahuserTK'=>$jumlahuserTK,'jumlahuserTK'=>$jumlahuserTK,'jumlahuserSMP'=>$jumlahuserSMP,'jumlahuserSD'=>$jumlahuserSD,'datauser'=>$datauser]);

            }else{
                if(Auth::user()->divisi == 'KB-TK'){
                    $jumlahuser = DB::select("SELECT * FROM users where status_kerja = 1 AND (divisi = '$divisi'|| divisi='DAYCARE') ");
                    $jumlahsurat = "";
                    $jumlahusernon = User::where(['status_kerja'=>'0','divisi'=>$divisi,'divisi'=>'DAYCARE'])->count();
                    $jumlahuserGT = DB::select("SELECT  *  FROM users where status_kerja = 1 AND (divisi = '$divisi'|| divisi='DAYCARE') AND (status_karyawan like '%".'GTY'."%' || status_karyawan like '%".'KTY'."%') ");
                    $jumlahuserGTT = DB::select("SELECT  *  FROM users where status_kerja = 1 AND (divisi = '$divisi'|| divisi='DAYCARE') AND (status_karyawan like '%".'GTTY'."%' || status_karyawan like '%".'KTTY'."%') ");
                    $jumlahuserTR = DB::select("SELECT  *  FROM users where status_kerja = 1 AND (divisi = '$divisi'|| divisi='DAYCARE') AND status_karyawan like '%".'TR'."%' ");
                    $jumlahuserGL = DB::select("SELECT *  FROM users where status_kerja = 1 AND (divisi = '$divisi'|| divisi='DAYCARE') AND status_karyawan like '%".'GL'."%' ");
                 }else{
                    $jumlahuser = DB::select("SELECT * FROM users where status_kerja = 1 AND divisi = '$divisi' ");
                    $jumlahusernon = User::where(['status_kerja'=>'0','divisi'=>$divisi])->count();
                    $jumlahsurat = ''; 
                    $jumlahuserGT = DB::select("SELECT  *  FROM users where status_kerja = 1 AND divisi = '$divisi' AND (status_karyawan like '%".'GTY'."%' || status_karyawan like '%".'KTY'."%') ");
                    $jumlahuserGTT = DB::select("SELECT  *  FROM users where status_kerja = 1 AND divisi = '$divisi' AND (status_karyawan like '%".'GTTY'."%' || status_karyawan like '%".'KTTY'."%') ");
                    $jumlahuserTR = DB::select("SELECT  *  FROM users where status_kerja = 1 AND divisi = '$divisi' AND status_karyawan like '%".'TR'."%' ");
                    $jumlahuserGL = DB::select("SELECT *  FROM users where status_kerja = 1  AND divisi = '$divisi'AND status_karyawan like '%".'GL'."%' ");

                }
                return view('home',['anggotaBMT'=>$anggotaBMT,'aktive'=>$aktive,'totalPengeluaranADM'=>$totalPengeluaranADM,'biayaAdmin'=>$biayaAdmin,'totalPinjamanDiabayar'=>$totalPinjamanDiabayar,'infoPinjaman'=>$infoPinjaman,'infoBmt'=>$infoBmt,'jumlahuserTR'=>$jumlahuserTR,'jumlahuserGL'=>$jumlahuserGL,'jumlahuserGT'=>$jumlahuserGT,'jumlahuserGTT'=>$jumlahuserGTT,'jumlahuser'=>$jumlahuser,'jumlahusernon'=>$jumlahusernon,'jumlahsurat'=>$jumlahsurat,'datauser'=>$datauser]);
             }
          }else{
            return redirect('/');
        }
            
    }   
}