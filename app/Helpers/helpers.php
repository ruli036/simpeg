<?php

use App\Models\AnggotaBMT;
use App\Models\CicilanPinjaman;
use App\Models\PenarikanWadiah;
use App\Models\PinjamanBmt;
use App\Models\SetoranBMT;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\TemporariSurat;
use Carbon\CarbonInterval;
use Illuminate\Support\Carbon;

define('YEAR', date("Y"));
define('LEMBAGA', 'ALAZCA');
define('SYSTEM_NAME', 'OPENSIMKA'); 
define('COMPANY', 'Al-Azhar Cairo Banda Aceh');

function jumlahSuratTunggukaryawan(){
    $divisi = Auth::user()->divisi;
    if(Auth::user()->status == 1){
        $jumlah =  TemporariSurat::where('rekom1',1)->where('rekom2',1)->where('rekom3',0)->where('sts','!=',9)->count();
    }else if(Auth::user()->status == 2){
        $jumlah =  TemporariSurat::where('rekom1',1)->where('rekom2',0)->where('sts','!=',9)->count();
    }else if(Auth::user()->status == 3){
        if($divisi == "KB-TK"){
            $jumlah =  TemporariSurat::where('rekom1',0)->where('divisi',$divisi)->where('sts','!=',9)->orWhere('divisi','DAYCARE')->count();
        }else{
            $jumlah =  TemporariSurat::where('rekom1',0)->where('divisi',$divisi)->where('sts','!=',9)->count();
        }
    }else if(Auth::user()->status == 4) {
        $jumlah =  TemporariSurat::where('rekom1',0)->where('divisi',$divisi)->where('sts','!=',9)->count();
    } 
    return $jumlah;
    
}
function jumlahSuratTungguOB(){
    if(Auth::user()->status == 1){
        $jumlah =  TemporariSurat::where('rekom1',1)->where('rekom2',1)->where('sts',9)->count();
    }else if(Auth::user()->status == 2){
        $jumlah =  TemporariSurat::where('rekom1',1)->where('rekom2',0)->where('sts',9)->count();
    }
    return $jumlah;
    
}
function jumlahDataBaru(){
    $jumlah =  PenarikanWadiah::where('new',1)->where('setuju1',0)->count();
    return $jumlah;
}
function jumlahPinjamanBaru(){
    $jumlah =  PinjamanBmt::where('sts_transfer',1)->where('setuju1',0)->where('setuju2',0)->count();
    return $jumlah;
}
function jumlahPengajuanPinjaman(){
    if(Auth::user()->status == 7 || Auth::user()->status == 0 ){
        $jumlah =  PinjamanBmt::where('setuju1',1)->count();
    }else if(Auth::user()->status == 1){
        $jumlah =  PinjamanBmt::where('setuju1',0)->where('setuju2',1)->count();
    }
    return $jumlah;
}
function jumlahPenarikanWadiah(){
        $jumlah =  PenarikanWadiah::where('setuju1',1)->count();
    return $jumlah;
}
function totalWadiahDitarik(){
    $jumlah =  PenarikanWadiah::where('setuju1',0)->join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_penarikan_wadiah.id_anggota_bmt')->where('tbl_anggota_bmt.sts_anggota',0)->sum('nominal');
return $jumlah;
}
function totalSetoranWadiah(){
    $jumlah =  SetoranBMT::join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_setoran_bmt.id_anggota_bmt')->where('tbl_anggota_bmt.sts_anggota',0)->sum('nominal_wadiah');
    return $jumlah;
}
function totalTerlambat($seconds){
    $value = $seconds;
    $dt = Carbon::now();
    $days = $dt->diffInDays($dt->copy()->addSeconds($value));
    $hours = $dt->diffInHours($dt->copy()->addSeconds($value)->subDays($days));
    $minutes = $dt->diffInMinutes($dt->copy()->addSeconds($value)->subDays($days)->subHours($hours));
    $second  = $seconds - (($minutes * 60) + ($hours * 60 * 60) + ($days * 24 * 60 * 60)); 
    return CarbonInterval::days($days)->hours($hours)->minutes($minutes)->seconds($second)->forHumans();
}

function Parse_Data($data,$p1,$p2){
	$data=" ".$data;
	$hasil="";
	$awal=strpos($data,$p1);
	if($awal!=""){
		$akhir=strpos(strstr($data,$p1),$p2);
		if($akhir!=""){
			$hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
		}
	}
	return $hasil;	
}
function cekKeanggotaanBmt(){
	$id=Auth::user()->id;
    $hasil = AnggotaBMT::where('id_karyawan',$id)->where('sts_anggota',0)
    ->where('sts_anggota',0)
    ->count();
	return $hasil;	
}
function getIdAnggotaBMT(){
	$id=Auth::user()->id;
    $hasil = AnggotaBMT::where('id_karyawan','=',$id)->first();
	return $hasil->id_anggota_bmt;	
}
function totalSetoranBMTKeBank(){
    $total_pinjaman_dibayar1 = 0;
    $total_pinjaman_dibayar2 = 0;
    $total_pinjaman_dibayar3 = 0;
    $total_pinjaman_dibayar4 = 0;
    $total_pinjaman_dibayar5 = 0;
    $total_pinjaman_dibayar6 = 0;
    $cicilan1 = CicilanPinjaman::select(
        DB::raw("DATE_FORMAT(tgl1, '%Y-%m') new_date1"),
        DB::raw('YEAR(tgl1) year,MONTH(tgl1) month'),
        DB::raw('sum(cicilan1) as total_pinjaman_dibayar1'))
        ->groupBy('month','year')
        ->orderBy('year','DESC')
        ->get();

    $cicilan2 = CicilanPinjaman::select( 
        DB::raw("DATE_FORMAT(tgl2, '%Y-%m') new_date2"),
        DB::raw('YEAR(tgl2) year,MONTH(tgl2) month'),
        DB::raw('sum(cicilan2) as total_pinjaman_dibayar2'))
        ->groupBy('month','year')
        ->orderBy('year','DESC')
        ->get();

    $cicilan3 = CicilanPinjaman::select( 
        DB::raw("DATE_FORMAT(tgl3, '%Y-%m') new_date3"),
        DB::raw('YEAR(tgl3) year,MONTH(tgl3) month'),
        DB::raw('sum(cicilan3) as total_pinjaman_dibayar3'))
        ->groupBy('month','year')
        ->orderBy('year','DESC')
        ->get();

    $cicilan4 = CicilanPinjaman::select(
        DB::raw("DATE_FORMAT(tgl4, '%Y-%m') new_date4"),
        DB::raw('YEAR(tgl4) year,MONTH(tgl4) month'),
        DB::raw('sum(cicilan4) as total_pinjaman_dibayar4'))
        ->groupBy('month','year')
        ->orderBy('year','DESC')
        ->get();

    $cicilan5 = CicilanPinjaman::select(
            DB::raw("DATE_FORMAT(tgl5, '%Y-%m') new_date5"),
            DB::raw('YEAR(tgl5) year,MONTH(tgl5) month'),
            DB::raw('sum(cicilan5) as total_pinjaman_dibayar5'))
            ->groupBy('month','year')
            ->orderBy('year','DESC')
            ->get();
    $cicilan6 = CicilanPinjaman::select(
            DB::raw("DATE_FORMAT(tgl6, '%Y-%m') new_date6"),
            DB::raw('YEAR(tgl6) year,MONTH(tgl6) month'),
            DB::raw('sum(cicilan6) as total_pinjaman_dibayar6'))
            ->groupBy('month','year')
            ->orderBy('year','DESC')
            ->get();
        foreach ($cicilan1 as $key => $cicilan) {
                if(date('Y-m', strtotime(now())) == $cicilan->new_date1){
                     $total_pinjaman_dibayar1 = $cicilan->total_pinjaman_dibayar1;
                }                           
         }
         foreach ($cicilan2 as $key => $cicilan) {
                if(date('Y-m', strtotime(now())) == $cicilan->new_date2){
                     $total_pinjaman_dibayar2 = $cicilan->total_pinjaman_dibayar2;
                }                           
         }
         foreach ($cicilan3 as $key => $cicilan) {
                if(date('Y-m', strtotime(now())) == $cicilan->new_date3){
                     $total_pinjaman_dibayar3 = $cicilan->total_pinjaman_dibayar3;
                }                            
         }
         foreach ($cicilan4 as $key => $cicilan) {
                if(date('Y-m', strtotime(now())) == $cicilan->new_date4){
                     $total_pinjaman_dibayar4 = $cicilan->total_pinjaman_dibayar4;
                }                           
         }foreach ($cicilan5 as $key => $cicilan) {
                if(date('Y-m', strtotime(now())) == $cicilan->new_date5){
                     $total_pinjaman_dibayar5 = $cicilan->total_pinjaman_dibayar5;
                }                           
         }
         foreach ($cicilan6 as $key => $cicilan) {
                if(date('Y-m', strtotime(now())) == $cicilan->new_date6){
                     $total_pinjaman_dibayar6 = $cicilan->total_pinjaman_dibayar6;
                }                           
         }
        $total_bayar = $total_pinjaman_dibayar1 +$total_pinjaman_dibayar2 +$total_pinjaman_dibayar3 +$total_pinjaman_dibayar4 +$total_pinjaman_dibayar5 +$total_pinjaman_dibayar6;

        // return  0;
        return  $total_bayar;
}

function uangBMTBulanIni(){  
    $bulan = date('m', strtotime(now()));
    $tahun = date('Y', strtotime(now()));
    $BMT = SetoranBMT::whereMonth('tgl_setor',$bulan)->whereYear('tgl_setor',$tahun)
    ->sum('nominal_bmt');
    // return  0;
    return  $BMT;
}
function uangWadiahBulanIni(){
    $bulan = date('m-Y', strtotime(now()));
    $tahun = date('Y', strtotime(now()));
    $wadiah = SetoranBMT::whereMonth('tgl_setor',$bulan)->whereYear('tgl_setor',$tahun)
    ->sum('nominal_wadiah');
    // return  0;
    return  $wadiah;
}

function encrypt_url($string) {

    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */        
    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];

    // hash
    $key    = hash("sha256", $secret_key);

    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv     = substr(hash("sha256", $secret_iv), 0, 16);

    //do the encryption given text/string/number
    $result = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($result);
    return $output;
}
function decrypt_url($string) {

    $output = false;
    /*
    * read security.ini file & get encryption_key | iv | encryption_mechanism value for generating encryption code
    */

    $security       = parse_ini_file("security.ini");
    $secret_key     = $security["encryption_key"];
    $secret_iv      = $security["iv"];
    $encrypt_method = $security["encryption_mechanism"];

    // hash
    $key    = hash("sha256", $secret_key);

    // iv – encrypt method AES-256-CBC expects 16 bytes – else you will get a warning
    $iv = substr(hash("sha256", $secret_iv), 0, 16);

    //do the decryption given text/string/number

    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}
 
?>