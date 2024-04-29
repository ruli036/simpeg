<?php

namespace App\Imports;

use App\Models\AnggotaBMT;
use App\Models\CicilanPinjaman;
use App\Models\LogEdit;
use App\Models\PenarikanWadiah;
use App\Models\PinjamanBmt;
use App\Models\SetoranBMT;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;


HeadingRowFormatter::default('none');
class BmtImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
    // try{
        date_default_timezone_set('Asia/Jakarta');
        $array = [];
        foreach ($collection as $key => $row) {         
            if($key>=1){
                
                $no = $key + 1;
            if($row['1'] != ''){
                $user = User::select('id')->where('nik','=',$row['1'])->first();
                if($user == null){
                    $error= $row['1'].'-'.$row['2'];
                    array_push($array,$error);
                }else{
                  $id = $user->id;
                  $anggotaBMT = AnggotaBMT::where('id_karyawan','=',$id)->first();
 
                      if($anggotaBMT != null){
                        DB::transaction(function () use($anggotaBMT,$row) {
                            SetoranBMT::insert([
                                'id_anggota_bmt' => $anggotaBMT->id_anggota_bmt,
                                'nominal_bmt' => str_replace(',', '',$row['7']??'0'),
                                'nominal_wadiah' => str_replace(',', '',$row['8']??'0'),
                                'tgl_setor' => $row['6'],
                                'tgl_input' => now()
                            ]);
      
                            $totalSaldo = SetoranBMT::select(DB::raw('sum(nominal_bmt) as saldo_bmt'),DB::raw('sum(nominal_wadiah) as saldo_wadiah'))
                            ->where('id_anggota_bmt','=',$anggotaBMT->id_anggota_bmt)
                            ->first();
                            $update = AnggotaBMT::find($anggotaBMT->id_anggota_bmt);
                            $totalPenarikan = PenarikanWadiah::where('id_anggota_bmt','=',$anggotaBMT->id_anggota_bmt)->sum('nominal');
                            $update->saldo_bmt = $totalSaldo->saldo_bmt;
                            $update->saldo_wadiah = ($totalSaldo->saldo_wadiah - $totalPenarikan);
                            $update->save();
      
                        });
                           
                          if($row['9'] != 0){
                            $cicilan = "cicilan".$row['9'];
                            $tgl = "tgl".$row['9'];
    
                            $id_cicilan = PinjamanBmt::join('tbl_cicilan_pinjaman','tbl_cicilan_pinjaman.id_pengajuan','=','tbl_pengajuan_pinjaman.id_pengajuan')
                            ->where('tbl_pengajuan_pinjaman.id_anggota_bmt','=',$anggotaBMT->id_anggota_bmt)
                            ->where('tbl_pengajuan_pinjaman.sts_pinjaman','=',1)
                            ->first();
                            if($id_cicilan == null){
                              //   return redirect()->back()->with(['warning'=>'Data Pinjaman Tidak Ditemukan '.$no.' - '.$row['1'].' - '.$row['2']]);
                            }else{
                                DB::transaction(function () use($id_cicilan,$cicilan,$tgl,$row) {
                                    $update = CicilanPinjaman::find($id_cicilan->id_cicilan);
                                    $update->$cicilan = str_replace(',', '',$row['10']??'0');
                                    // $update->$tgl = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['6']);
                                    $update->$tgl = $row['6'];
                                    $update->save();
                    
                                    $cekCicilan = CicilanPinjaman::find($id_cicilan->id_cicilan);
                                    $totalCicilan = $cekCicilan->cicilan1 + $cekCicilan->cicilan2 + $cekCicilan->cicilan3 + $cekCicilan->cicilan4 + $cekCicilan->cicilan5 + $cekCicilan->cicilan6;
                    
                                    $update->total_bayar = $totalCicilan;
                                    $update->save();
                                    
                                    $cekTotalCicilan = CicilanPinjaman::where('id_cicilan',$id_cicilan->id_cicilan)->first();
                                    $data = PinjamanBmt::find($cekCicilan->id_pengajuan);
                                    $stsPinjaman = 1;
                                    if($cekTotalCicilan->total_bayar >= $data->nominal){
                                        $stsPinjaman = 0;
                                    }else{
                                        $stsPinjaman = 1;
                                    }
                                    $data->sts_pinjaman = $stsPinjaman;
                                    $data->save();
                                });
                                 
                            }
                           
                          }
                        }else{
                            return redirect()->back()->with(['warning'=>'NIK Tidak Terdaftar Sebagai Anggota BMT '.$no.' - '.$row['1'].' - '.$row['2']]);
                        }
                }
            }
            }

        }
        LogEdit::insert([
            'id_karyawan' => Auth::user()->id,
            'nama' => Auth::user()->name,
            'keterangan' => 'Mengimput File Setoran Bmt Tanggal'.$collection[1]['6'],
            'date' => now(),
        ]);
        if(count($array)== 0){
            return redirect()->back()->with(['info'=>'Berhasil Mengimport Data']);
        }else{
            return redirect()->back()->with(['warning'=>'Berhasil Mengimport Data, Terdapat Beberapa Data Yang Tidak Terimput :  '.implode('/ ',$array)]);
        }
    // } catch (\Exception $e) {
    //     return redirect()->back()->with(['warning'=>'Gagal Import Data']);               
    // }
    }
}
