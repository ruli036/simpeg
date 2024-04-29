<?php

namespace App\Http\Controllers;

use App\Models\JenisCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControllerJenisCuti extends Controller
{
    public function tambahjeniscuti(){
        if(Auth::check()){
            $aktive = "componen";
                 return view('pagesadmin.tambahjeniscuti',['aktive'=>$aktive]);
            }else{
                return redirect('/');
            }
     }
     public function daftarjeniscuti(){
        if(Auth::check()){
            $aktive = "user";
            $datas = JenisCuti::all()->sortBy('id_cuti');
            return view('pagesadmin.daftarcuti',['aktive'=>$aktive,'datas'=>$datas]);
         }else{
            return redirect('/');
        }
     }
     public function editjeniscuti($id){
        if(Auth::check()){
            $aktive = "user";
            $datas = JenisCuti::find($id);
            return view('pagesadmin.editjeniscuti',['aktive'=>$aktive,'datas'=>$datas]);
         }else{
            return redirect('/');
        }
     }
     public function simpanjeniscuti(Request $request){
         $request->validate([
             'jenis_cuti'=>'required',
             'max_cuti'=>'required',
             'kategori_karyawan'=>'required',
             'kategori'=>'required',
             'file'=>'required',
             'sesi'=>'required',
             'jk'=>'required',
         ]);
         $simpan = JenisCuti::insert([
             'jenis'=>$request['jenis_cuti'],
             'jumlah_hari'=>$request['max_cuti'],
             'jk'=>$request['jk'],
             'file'=>$request['file'],
             'kategori'=>$request['kategori'],
             'kategori_karyawan'=>$request['kategori_karyawan'],
             'sesi'=>$request['sesi'],
         ]);
         if($simpan>0){
             return redirect()->back()->with(['info'=>'Jenis Cuti Berhasil Ditambahkan']);
         }else{
            return redirect()->back()->with(['warning'=>'terjadi Kesalahan']);
         }
         
     }
      public function simpaneditjeniscuti($id,Request $request){
         $request->validate([
             'jenis_cuti'=>'required',
             'max_cuti'=>'required',
             'kategori'=>'required',
             'file'=>'required',
             'jk'=>'required',
             'sesi'=>'required',
         ]);
         $simpan = JenisCuti::find($id);
            $simpan->jenis = $request['jenis_cuti'];
            $simpan->jumlah_hari = $request['max_cuti'];
            $simpan->jk = $request['jk'];
            $simpan->file = $request['file'];
            $simpan->kategori = $request['kategori'];
            $simpan->sesi = $request['sesi'];
            $simpan->save();
            return redirect()->back()->with(['info' => 'Data Berhasil Diubah']);
     }
      // delete Surat
      public function hapusjeniscuti($id){
        $result = JenisCuti::find($id);
        $result->delete();
        return redirect()->back();
   }
}
