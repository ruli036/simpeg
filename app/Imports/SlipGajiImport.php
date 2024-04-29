<?php

namespace App\Imports;

use App\Jobs\SendNotificationGajiFix;
use App\Jobs\SendUsersImportedNotificationJob;
use App\Mail\KirimEmail;
use App\Models\MasterItemGaji;
use App\Models\RiwayatGaji;
use App\Models\User;
use App\Notifications\EmailNotification;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToCollection;

class SlipGajiImport implements ToCollection 
{private $inputan;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
     */
    
     public function __construct($inputan)
    {
        $this->inputan = $inputan;        
    }
    public function collection(Collection $collection)
    {
        $emails = [];
        date_default_timezone_set('Asia/Jakarta');
        $masterItem = MasterItemGaji::where('stts','A')->get();
        foreach ($collection as $key => $row) {
             if($key>=1){
                if($row['1'] != '' || $row['1'] == '1' ){
                    $insertData = array();
                    foreach ($masterItem as $value) {  
                      $user = User::where('nik',$row['1'])->first();  
                        if ($row[$value->colom] > 0) {        
                                $insertData[] =  array(
                                        'id_karyawan' => $user->id,
                                        'id_componen_gaji' => $value->id,
                                        'jabatan' => $row['3'],
                                        'divisi' => $row['5'],
                                        'stts_karyawan' => $row['6'],
                                        'periode' =>$row['7'],
                                        'amount' =>$row[$value->colom],
                                      );
                        }  
                    }
                RiwayatGaji::insert($insertData);
               
                }
              }
        }
        if($this->inputan == 'B'){
          SendUsersImportedNotificationJob::dispatch();
        }else{
          SendNotificationGajiFix::dispatch();
        }
       
        return redirect()->back()->with(['info'=>'Berhasil Mengimport Data']);

    }

}