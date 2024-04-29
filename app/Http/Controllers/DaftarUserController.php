<?php

namespace App\Http\Controllers;

use App\Models\CommandLog;
use App\Models\Daftaruser;
use App\Models\Jabatan;
use App\Models\Mesin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Notifications\Notification;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class DaftarUserController extends Controller
{
    public function DaftarUser(Request $request)
    {
        try{
        $request->validate([
            'email' => ['required', 'string', 'max:255','email'],
            'nik' => ['required', 'string', 'max:255','unique:users'],
            'nuptk' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'lulusan' => 'required',
            'jk' => 'required',
            'tgl_mulai_bekerja' => ['required', 'string', 'max:255'],
            'divisi' => 'required',
            'jabatan' => 'required',
            'status_karyawan' => 'required',
        ]);
        $datajabatan = Jabatan::where('id_jabatan',$request['jabatan'])->first();
        $bekerja = date('d-m-Y', strtotime($request['tgl_mulai_bekerja']));
       
            $lastID = User::orderBy('created_at', 'DESC')->first();
            $idAbsensi = $lastID->id +1;
            Daftaruser::insert(
                [
                    'nik' => $request['nik'],
                    'id_absensi_karyawan' => $idAbsensi,
                    'nuptk' => $request['nuptk'],
                    'name' => $request['name'],
                    'foto' => '-',
                    'jk' => $request['jk'],
                    'tempat' => "-",
                    'tgl_lahir' => now(),
                    'email' => $request['email'],
                    'lulusan' => $request['lulusan'],
                    'jurusan' => "-",
                    'universitas' => "-",
                    'thn_tamat' => "0000",
                    'tgl_mulai_bekerja' => $bekerja,
                    'pernikahan' => "-",
                    'no_hp' => '000',
                    'divisi' => $request['divisi'],
                    'jabatan' => $datajabatan->jabatan,
                    'alamat' => "-",
                    'status' => $datajabatan->level,
                    'status_kerja' => "1",
                    'status_karyawan' => $request['status_karyawan'],
                    'password' => Hash::make('12345678'),
                    'created_at'=>now(),
                    'updated_at'=>now(),
                     
                ]);
            $nik = $request['nik'];
            $nama = $request['name'];
            $getmesin = Mesin::all();
                      
                        $gtid =  DB::select("SELECT max(cmd_id)+1 as `idm` from command_log where idmesin='".$getmesin[0]->Id."'");
                        $data = array(
                                'idmesin' => $getmesin[0]->Id,
                                'cmd_id' => !$gtid[0]->idm?1:$gtid[0]->idm,
                                'perintah' => "C:".(!$gtid[0]->idm?1:$gtid[0]->idm).":DATA UPDATE USERINFO PIN=".$nik."\tName=".$nama."\tPasswd=\tCard=\tGrp=\tTZ=\tPri=0",
                                'nilai_res' => '0'
                            );
                        CommandLog::insert($data); 
             
            return redirect()->back()->with(['info' => 'Akun Berhasil Dibuat']);
        }catch (\Exception $e) {
            return redirect()->back()->with(['warning' => $e->getMessage()]);
        }               
     }
      //profile karyawan tampilan untuk admin
      public function profile2($id){
        if(Auth::check()){
            $aktive = "home";
              $datauser =  User::where("id",$id)->first();
              $jabatan = Jabatan::orderBy('jabatan','ASC')->get();
        return view('pagesadmin.editdatauser',['datauser'=>$datauser,'aktive'=>$aktive,'jabatan'=>$jabatan]);
        }else{
            return redirect('/');
        }
      
    }
      // edit user dari admin
      public function editdatauser($id,Request $request){
        try{
        $request->validate([
            'email' => ['required', 'string', 'max:255','email'],
            'nik' => ['required', 'string', 'max:255'],
            'nuptk' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'jk' => ['required', 'string', 'max:255'],
            'tempat' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required'],
            'lulusan' => ['required', 'string', 'max:255'],
            'jurusan' => ['required', 'string', 'max:255'],
            'universitas' => ['required', 'string', 'max:255'],
            'thn_tamat' => ['required', 'string', 'max:255'],
            'tgl_mulai_bekerja' => ['required'],
            'pernikahan' => ['required', 'string', 'max:255'],
            'hp' => ['required', 'string', 'max:255'],
            'divisi' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'status_karyawan' => ['required', 'string', 'max:255'],
        ]);
        $lahir = date('d-m-Y', strtotime($request['tgl_lahir']));
        $bekerja = date('d-m-Y', strtotime($request['tgl_mulai_bekerja']));
        $datajabatan = Jabatan::where('id_jabatan',$request['jabatan'])->first();
       
            $result = User::find($id);
            $result->nik=  $request['nik'];
            $result->nuptk=  $request['nuptk'];
            $result->name=  $request['name'];
            $result->jk=  $request['jk'];
            $result->tempat=  $request['tempat'];
            $result->tgl_lahir=  $lahir;
            $result->email=  $request['email'];
            $result->lulusan=  $request['lulusan'];
            $result->jurusan=  $request['jurusan'];
            $result->universitas=  $request['universitas'];
            $result->thn_tamat=  $request['thn_tamat'];
            $result->tgl_mulai_bekerja=  $bekerja;
            $result->pernikahan=  $request['pernikahan'];
            $result->no_hp=  $request['hp'];
            $result->divisi=  $request['divisi'];
            $result->jabatan=  $datajabatan->jabatan;
            $result->alamat=  $request['alamat'];
            $result->status=   $datajabatan->level;
            $result->status_karyawan=  $request['status_karyawan'];
            $result->save();

                Http::post(env('APP_URLLMS').'updateUser',[
                    'id' => $result->id,
                    'name' => $request['name'],
                    'email' => $request['email'],
                    ]);
            return redirect()->back()->with(['info' => 'Data User Berhasil Diubah']);
        }catch(\Exception $e){
            return redirect()->back()->with(['info' => $e->getMessage()]);
        }
           
         
    }
    // nonaktifkan karayawan
    public function nonaktif($id){    
        $result = User::find($id);
        $result->status_kerja = 0;
        $result->save();
        return redirect()->back()->with(['info' => 'Data User Berhasil Diubah']);
    } 
    // aktifkan karayawan
    public function aktif($id){
        $result = User::find($id);
        $result->status_kerja = 1;
        $result->save();
        return redirect()->back()->with(['info' => 'Data User Berhasil Diubah']);
    }

    // DAFTAR USER
    public function datauser(){
        $aktive = 'users';
        $keyword = '';
        if(Auth::check()  && (Auth::user()->status == 1||Auth::user()->status == 2||Auth::user()->status == 4||Auth::user()->status == 0)){
            $datauser = User::where('status','!=','0')->where('status_kerja','1')->get();
            return response()->json($datauser);
        return view('pagesadmin.datauser ',['datauser'=>$datauser,'aktive'=>$aktive,'keyword'=>$keyword]);
        }else{
            return redirect('/');
        }
       
    } 
    public function searchuser(Request $request){
        $aktive = 'users';
        $keyword = $request->cari;
        if(Auth::check()  && (Auth::user()->status == 1||Auth::user()->status == 2||Auth::user()->status == 4||Auth::user()->status == 0)){
            $datauser = User::where('name', 'like', '%' . $keyword . '%')->where('status','!=','0')->where('status_kerja','1')->paginate(10);
        return view('pagesadmin.datauser ',['datauser'=>$datauser,'aktive'=>$aktive,'keyword'=>$keyword]);
        }else{
            return redirect('/');
        }
       
    } 
        
        
    public function Registrasi(){
        if(Auth::check()){
            $aktive = "componen";
            $jabatan = Jabatan::orderBy('jabatan','ASC')->get();
            return view('pagesadmin.registeruser',['aktive'=>$aktive,'jabatan'=>$jabatan]);
        }else{
            return redirect('/');
        }
    
    } 
        
   
    // data karyawan nonaktif
    public function datausernonaktif(){
        if(Auth::check()){  
            $aktive= 'user';
            $datauser =  DB::select("SELECT * from users where status != '0' AND status_kerja = '0' ");
            return view('pagesadmin.datausernonaktif ',['datauser'=>$datauser,'aktive'=>$aktive]);

         }else{
            return redirect('/');
        }
    }
    // delete user
    public function hapususer($id){
            $result = User::find($id);
            $result->delete();
            return redirect()->back();
       }

    public function editpassuser($id){
            $result = User::find($id);
            $passnew = Hash::make(12345678);
            $result->password = $passnew;
            $result->save();
            if($result->sts_lms == 'Y'){
                Http::post(env('APP_URLLMS').'resetPassword',[
                'id' => $id,
                'pass' => $passnew,
                ]);
            }
             if($result->stts_nse == 'Y'){
                $data = [
                    'password_hash' => $passnew,
                    'updated_at' => now()
                 ];
                 DB::connection('nse')->table('users')->where('id_karyawan',$id)->update($data);
             }
            
                return redirect()->back()->with(['info' => 'Password '.$result->name.' Telah Direset']);
        
    }

    public function uploudfoto(Request $request){
        $request->validate([
            'foto'=>['required','max:2480'],
        ]);
        $file = $request['foto'];
        $id = Auth::user()->id;
        $data = User::find($id);
        try{
            unlink(\public_path().'/img_profil/'.$data->foto);
        }catch(\Exception $e){

        }
        try{
            $namafile = time().'_'.$file->getClientOriginalName();
            $file->move('img_profil',$namafile); 
            
              $result = User::find($id);
              $result->foto = $namafile;
              $result->save();
  
              return redirect()->back();
         } catch (\Exception $e) {
            return redirect()->back()->with(['warning'=>'Format File Excel Anda Expired']);               
       }
    }
    public function nonAktifkanUserLMS($id){  
        try{
            $respone = Http::post(env('APP_URLLMS').'userNonAktif',[
                'id' => $id
            ]);
            if($respone->json('code',401) == 200){
                $users = User::find($id);
                $users->sts_lms = 'K';
                $users->save();
                return redirect()->back()->with(['info'=>$respone->json('message',"200")]);
            }else{
                return redirect()->back()->with(['info'=>$respone->json('message',"401")]);
            }
            
         } catch (\Exception $e) {
            return redirect()->back()->with(['info'=>'Ada Kesalahan Pada API Anda, Mohon Cek Alamat URL Anda!']);               
       }
    }
     public function aktifkanUserLMS($id){  
        try{
            $respone = Http::post(env('APP_URLLMS').'userAktif',[
                'id' => $id
            ]);
            if($respone->json('code',401) == 200){
                $users = User::find($id);
                $users->sts_lms = 'Y';
                $users->save();
                return redirect()->back()->with(['info'=>$respone->json('message',"200")]);
            }else{
                return redirect()->back()->with(['info'=>$respone->json('message',"401")]);
            }
             
         } catch (\Exception $e) {
            return redirect()->back()->with(['info'=>'Ada Kesalahan Pada API Anda, Mohon Cek Alamat URL Anda!']);               
       }
    }
    public function daftarLMS($id){  
        try{
            $users = User::find($id);
            
            if($users->foto == '-'){
                $urlImg = env('APP_URLFOTO').'img_profil/logo.png';
            }else{
                $urlImg = env('APP_URLFOTO').'img_profil/'.$users->foto;
            }
            $respone = Http::post(env('APP_URLLMS').'addUser',[
                'id' => $id,
                'nik' => $users->nik,
                'name' => $users->name,
                'pass' => $users->password,
                'foto' => $urlImg,
                'email' => $users->email,
                'sts' => $users->status,
            ]);
 
            if($respone->json('code',401) == 200){      
                $users->sts_lms = 'Y';
                $users->save();
                return redirect()->back()->with(['info'=>$respone->json('message',"401")]);
            }else{
                return redirect()->back()->with(['info'=>$respone->json('message',"Gagal Mendaftarkan User")]);
            }
            return $respone->json('code',401);
         } catch (\Exception $e) {
            return redirect()->back()->with(['info'=>'Ada Kesalahan Pada API Anda, Mohon Cek Alamat URL Anda!']);               
       }
    }
    public function daftarNSE($id, Request $request){  
        try{
            $users = User::find($id);
            $role = $request->role;
            if($users->divisi == 'KB-TK'){
                $divisi = '1';
            }else if($users->divisi == 'SD'){
                $divisi = '4';
            }else if($users->divisi == 'SMP'){
                $divisi = '5';
            }else{
                $divisi = '6'; 
            }
            $data =[
                'id_karyawan' => $id,
                'username' => $users->nik,
                'phone' => $users->no_hp,
                'password_hash' => $users->password,
                'divisi' => $divisi,
                'email' => $users->email,
                'active' => '1',
            ];
            $results = DB::connection('nse')->table('users')->insertGetId($data);
 
            if($results){      
                $role = [
                    'group_id' => $role,
                    'user_id'  => $results
                ];
                DB::connection('nse')->table('auth_groups_users')->insert($role);
                $users->stts_nse = 'Y';
                $users->save();
                return redirect()->back()->with(['info'=>"Akun berhasil dibuat"]); 
            }else{
                return redirect()->back()->with(['info'=>"Gagal Mendaftarkan User"]);
            }
         } catch (\Exception $e) {
            return redirect()->back()->with(['info'=>$e->getMessage()]);               
       }
    }
    public function deleteAkunNse($id){  
        try{
            $results = DB::connection('nse')->table('users')->where('id_karyawan', $id)->delete();
            if($results){
                $users = User::find($id);
                $users->stts_nse = 'D';
                $users->save();
                return redirect()->back()->with(['info'=>"Akun berhasil dihapus"]); 
            }else{
                return redirect()->back()->with(['info'=>"Gagal di hapus"]);
            }
         } catch (\Exception $e) {
            return redirect()->back()->with(['info'=>$e->getMessage()]);               
       }
    }
    
}
