<?php

namespace App\Http\Controllers;

use App\Mail\KirimEmail;
use App\Models\Daftaruser;
use App\Models\Jabatan;
use App\Models\Surat;
use App\Models\TemporariSurat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ControllerJabatan extends Controller
{
     public function tambahjabatan(){
        if(Auth::check()){
            $aktive = "componen";
                 return view('pagesadmin.tambahjabatan',['aktive'=>$aktive]);
            }else{
                return redirect('/');
            }
     }
      public function simpanjabatan(Request $request){
        if(Auth::check()){
            $request->validate([
                'jabatan' => ['required', 'string'],
                'level' => ['required', 'string'],
                
            ]);
                 
            Jabatan::insert(
                [
                    'jabatan' => $request['jabatan'],
                    'level' =>$request['level'],
                    
                    ]);
                    
                    return redirect()->back()->with(['info' => 'Data Berhasil Ditambahkan']);
            
            }else{
                return redirect('/');
            }
     }
     public function daftarjabatan(){
        if(Auth::check()){
            $aktive = "user";
            $formatdata = Jabatan::all()->sortBy('level');
            return view('pagesadmin.daftarjabatan',['aktive'=>$aktive,'formatdata'=>$formatdata]);
         }else{
            return redirect('/');
        }
     }

     public function editjabatan($id){
        if(Auth::check()){
            $aktive = "user";
            $formatdata = Jabatan::where('id_jabatan',$id)->first();
            return view('pagesadmin.editjabatan',['aktive'=>$aktive,'formatdata'=>$formatdata]);
        }else{
                return redirect('/');
            }
     }
      public function simpaneditjabatan($id,Request $request){
             if(Auth::check()){
                $request->validate([
                    'jabatan' => ['required', 'string'],
                    'level' => ['required', 'string'],
                    
                ]);
                     
                $result = Jabatan::find($id);
                    $result->jabatan = $request['jabatan'];
                    $result->level = $request['level'];
                    $result->save();
                    return redirect()->back()->with(['info' => 'Data Berhasil Diubah']);
                
                }else{
                    return redirect('/');
                }
      }
        // delete Surat
        public function hapusjabatan($id){
            $result = Jabatan::find($id);
            $result->delete();
            return redirect()->back();
       }
}
