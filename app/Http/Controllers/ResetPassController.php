<?php

namespace App\Http\Controllers;

use App\Mail\KirimEmail;
use App\Models\ResetPass;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ResetPassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showForgetPasswordForm(){
        return view('auth.passwords.email');
    }
    public function showResetPasswordForm($token){
        date_default_timezone_set('Asia/Jakarta');
        $reset = ResetPass::where('token',$token)->first();
        $time = $reset->created_at;

        $waktu_request = Carbon::createFromFormat('Y-m-d H:i:s', $time);
        $waktu_expire = $waktu_request;
        $waktu_expire->addMinutes(5);
        if(now() >= $waktu_expire ){
            return "Link Expired";
        }else{
            return view('auth.passwords.reset')->with('token',$token);
        }
    }
    public function submitForgetPasswordForm(Request $request){
        date_default_timezone_set('Asia/Jakarta');
        $validasi = $request->validate([
            'email'=>'required',
            'nik'=>'required',
        ]);
        $email = $request->email;
        $validasi['token'] = encrypt_url($request['nik']);
        $validasi['created_at'] = now();

        ResetPass::insert($validasi);
        $details = [
            'kategori' =>   'Penting!',
            'mulai' =>      '3',
            'body' =>       'Mohon untuk menyimpan informasi detail akun Anda dengan baik dan pilih tempat serta kata sandi yang tidak mudah diakses orang lain, jika anda ingin melanjutkan reset password harap klik link di bawah ini! .',
            'link' =>       'https://karyawan.alazcabna.sch.id/reset-password/'.$validasi['token'],
        ];
        try{
            Mail::to($email)->send(new KirimEmail($details));
        } catch (\Exception $e) {
        }
         return redirect('login');
    }
    public function submitResetPasswordForm(Request $request){
       $request->validate([
            'token'=>'required',
            'password' => ['required', 'string', 'confirmed'],
        ]);
        
        $reset = ResetPass::where('token',$request['token'])->first();
        $nik = $reset->nik;
        $email= $reset->email;
        $passnew = Hash::make($request['password']);
        $cek = User::where('nik',$nik)->first();
        if($cek == ''){
            return redirect()->back()->with(['info'=>'NIK Anda Tidak di Temukan!']);
        }else{
            if($cek->email == "alazca758@gmail.com"){
                User::where('nik',$nik)->update([
                    'password' => $passnew
                ]);
            }else{
                if($email == $cek->email){
                    User::where('nik',$nik)->update([
                        'password' => $passnew
                    ]);
                    if($cek->sts_lms == 'Y'){
                        Http::post(env('APP_URLLMS').'resetPassword',[
                        'id' => $cek->id,
                        'pass' => $passnew,
                        ]);
                    } 
                    
                     if($cek->stts_nse == 'Y'){
                        $data = [
                            'password_hash' => $passnew,
                            'updated_at' => now()
                         ];
                         DB::connection('nse')->table('users')->where('id_karyawan',$cek->id)->update($data);
                    }
                }else{
                    return redirect()->back()->with(['info'=>'Email Akun Anda dan Email Reset Password Tidak Cocok!']);
                }
            }
          
        }
       
        return redirect('login');
    }
}
