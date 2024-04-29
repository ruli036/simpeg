<?php

namespace App\Http\Controllers;

use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerLogo extends Controller
{
     public function formatsurat(){
        if(Auth::check() ){
            $aktive = "user";
            $formatdata = Logo::all();
            return view('pagesadmin.formatsurat',['aktive'=>$aktive,'formatdata'=>$formatdata]);
         }else{
            return redirect('/');
        }
     }
     public function halamantambah(){
        if(Auth::check()){
            $aktive = "componen";
            return view('pagesadmin.tambahformatsurat',['aktive'=>$aktive]);
         }else{
            return redirect('/');
        }
     }  
     public function editformat($id){
        if(Auth::check()){
            $aktive = "user";
            $formatdata = Logo::where('id',$id)->first();
            return view('pagesadmin.editformatsurat',['aktive'=>$aktive,'formatdata'=>$formatdata]);
         }else{
            return redirect('/');
        }
     } 
     public function tambah(Request $request){
        if(Auth::check()){
             $request->validate([
                'judul' => ['required', 'string'],
                'divisi' => ['required', 'string'],
                'alamat' => ['required', 'string'],
                'email' => ['required', 'string'],
                'hp' => ['required', 'string'],
                'web' => ['required', 'string'],
                'logo' => ['required','max:560'],
            ]);
            $cek = Logo::where('divisi',$request['divisi'])->first();
            if($cek != null){
                return redirect()->back()->with(['warning' => 'Divisi '.$request['divisi'].' Sudah Memilki Format Surat!!']);
            }else{
                $ori_file = $request->logo;
                $nama_file = time()."_".$ori_file->getClientOriginalName();
                $ori_file->move(\public_path().'/img/',$nama_file);
                Logo::insert(
                    [
                        'judul' => $request['judul'],
                        'divisi' =>$request['divisi'],
                        'alamat' => $request['alamat'],
                        'email' => $request['email'],
                        'no_hp' => $request['hp'],
                        'web' => $request['web'],
                        'logo' => $nama_file,
                     ]);
                      
                     return redirect()->back()->with(['info' => 'Format Berhasil Ditambahkan']);
            }
         }else{
            return redirect('/');
        }
     }
 public function editformatsurat($id, Request $request){
        if(Auth::check()){
            $formatdata = Logo::all();
            $request->validate([
                'judul' => ['required', 'string'],
                'divisi' => ['required', 'string'],
                'alamat' => ['required', 'string'],
                'email' => ['required', 'string'],
                'hp' => ['required', 'string'],
                'web' => ['required', 'string'],
                'logo' => ['max:560'],
             ]);
            $cek = Logo::where('divisi',$request['divisi'])->first();
            if($request['logo'] == null){
                $result = Logo::find($id);
                    $result->judul = $request['judul'];
                    $result->divisi = $request['divisi'];
                    $result->alamat = $request['alamat'];
                    $result->email = $request['email'];
                    $result->no_hp = $request['hp'];
                    $result->web = $request['web'];
                    $result->save();
                    return redirect()->back()->with(['info' => 'Format Berhasil Diubah']);
            }else{
                $ori_file = $request->logo;
                $nama_file = time()."_".$ori_file->getClientOriginalName();
                $ori_file->move(\public_path().'/img/',$nama_file);

                $result = Logo::find($id);
                    $result->judul = $request['judul'];
                    $result->divisi = $request['divisi'];
                    $result->alamat = $request['alamat'];
                    $result->email = $request['email'];
                    $result->no_hp = $request['hp'];
                    $result->web = $request['web'];
                    $result->logo = $nama_file;
                    $result->save();
                    return redirect()->back()->with(['info' => 'Format Berhasil Diubah']);
            }
         }else{
            return redirect('/');
        }
     }

      // delete Surat
      public function hapusformat($id){
        $result = Logo::find($id);
        if($result->logo != ''){
            unlink(\public_path().'/img/'.$result->logo);
        }
        $result->delete();
        return redirect()->back();
   }
}
