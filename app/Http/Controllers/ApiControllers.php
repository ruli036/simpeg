<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ApiFormat;
use App\Models\Absensi;
use App\Models\CommandLog;
use App\Models\MasterItemGaji;
use App\Models\Mesin;
use App\Models\RiwayatGaji;
use App\Models\SlipGaji;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ApiControllers extends Controller
{

    public function sendData(Request $request)
    {
        try{
            $request->validate([
                'divisi' => 'required',
                'idmesin' => 'required',
            ]);
            $data = User::Where('divisi','=',$request['divisi'])
            ->Where('status_kerja','=',1)
            ->Where('status','!=',0)
            ->get();
            $idmesin = $request['idmesin'];
            $getmesin = Mesin::all();

                    foreach ($data as $value) {
                        $id = $value->id_absensi_karyawan;
                        $nama = $value->name;
                        $gtid =  DB::select("SELECT max(cmd_id)+1 as `idm` from command_log where idmesin='".$getmesin[$idmesin]->Id."'");

                        $data = array(
                                'idmesin' => $getmesin[$idmesin]->Id,
                                'cmd_id' => !$gtid[0]->idm?1:$gtid[0]->idm,
                                'perintah' => "C:".(!$gtid[0]->idm?1:$gtid[0]->idm).":DATA UPDATE USERINFO PIN=".$id."\tName=".$nama."\tPasswd=\tCard=\tGrp=\tTZ=\tPri=0",
                                'nilai_res' => '0'
                            );
                        CommandLog::insert($data); 
                    }
               
            echo 'berhasil input';
        
        }catch(Exception $e){
                echo 'Gagal';
        }
           
        
    }
     public function insertID()
    {
         
        $data = User::all();
        foreach ($data as $value) {
             $update = User::find($value->id);

             $update->id_absensi = $value->id;
             $update->save();
            # code...
        }

        echo "OK";
        
    }
    public function getkarywan(Request $request)
    {
        $request->validate([
            'nik' => 'required'
        ]);
        $data = User::where('nik',$request['nik'])->get();
        if(count($data) == 0){
            return ApiFormat::buatApiFormat(401,false,'Data NIK Tidak Ditemukan!',$data);        
        }else{
            return ApiFormat::buatApiFormat(200,true,'Data Ditemukan!',$data);        

        }
    }
    public function getDataAproval(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'bulan' => 'required'
        ]);
        $bln = $request['bulan'];
        $thn = $request['tahun'];
        $Judul = MasterItemGaji::orderBy('flag','ASC')->get();
        
        $select  = "b.id as id_riwayat_gaji, a.nik, a.name,c.akun_debet,c.akun_credit, b.jabatan, a.tgl_mulai_bekerja, b.divisi,a.status_karyawan,b.periode";
        foreach ($Judul as  $value) {
             $select.= ",SUM(IF(c.id = '".$value->id."', b.amount, 0)) as `".$value->nama."`";
        }
        $select.= ",SUM(IF(c.flag = 'P', b.amount, 0)) as subtotal, 
        SUM(IF(c.flag = 'M', b.amount, 0)) as potongan, 
        SUM(IF(c.flag = 'P', b.amount, 0)) - SUM(IF(c.flag = 'M', b.amount, 0)) as total";
        $data = DB::table('users as a')
        ->selectRaw($select)
        ->join('riwayat_gaji as b', function ($join) use($bln,$thn) {
            $join->on('a.id', '=', 'b.id_karyawan')
                ->whereMonth('b.periode', '=', $bln)
                ->whereYear('b.periode', '=', $thn)
                ->where('b.aprov','Y')->where('b.sync','N');
        })
        ->join('master_item_gaji as c', 'b.id_componen_gaji', '=', 'c.id')
        ->groupBy('a.id')
        ->get();
         
        if(count($data) == 0){
            return ApiFormat::buatApiFormat(401,false,'Data Tidak Ditemukan!',$data);        
        }else{
            return ApiFormat::buatApiFormat(200,true,'Data Ditemukan!',$data);        
        }
    }
    public function syncGaji(Request $request)
    {
        try{
            $request->validate([
                'id' => 'required',
            ]);
            $id = $request['id'];
            $update = RiwayatGaji::find($id);
           
            if ($update->sync == "N") {
                $update->sync = "Y";
                $update->save();
                return ApiFormat::buatApiFormat(200,true,'Berhasil di singkron');        
            }else if($update->sync == "Y"){
                return ApiFormat::buatApiFormat(404,true,'Data Sudah Disinkron');      
            }else{
                return ApiFormat::buatApiFormat(404,true,'Data Tidak Ditemukan');  
            }
        }catch(Exception $e){
            return ApiFormat::buatApiFormat(401,false,$e->getMessage());        
        }
    }
     public function divisi()
    {
       $data = User::select('divisi')->distinct()->get();
       if(count($data) == 0){
        return ApiFormat::buatApiFormat(401,false,'Data Tidak Ditemukan!',$data);        
    }else{
        return ApiFormat::buatApiFormat(200,true,'Data Ditemukan!',$data);        
    }      
    }
     public function getImgProfile(Request $request)
    {
        try{
            $request->validate([
                'id' => 'required',
            ]);
            $id = $request['id'];
            $get = User::find($id);
            if ($get != null) {
                $foto = 'https://karyawan.alazharcairobna.sch.id/img_profil/'.$get->foto;
                $response = Http::get($foto);
                $imageData = base64_encode($response->getBody());
                return $imageData; 
            }else{
                 $foto = 'https://karyawan.alazharcairobna.sch.id/img/undraw_profile.svg';
                $response = Http::get($foto);
                $imageData = base64_encode($response->getBody());
                return $imageData;        
             
            }
           
        }catch(Exception $e){
            return $e->getMessage();        
        }
    }
     public function getProfile(Request $request)
    {
        try{
            $request->validate([
                'id' => 'required',
            ]);
            $id = $request['id'];
            $get = User::find($id);
            if ($get != null) {
                return ApiFormat::buatApiFormat(401,false,'berhasil',$get);
            }else{
                 
                return ApiFormat::buatApiFormat(401,false,'Not Found');      
             
            }
           
        }catch(Exception $e){
            return ApiFormat::buatApiFormat(401,false,$e->getMessage());        
        }
    }
}
