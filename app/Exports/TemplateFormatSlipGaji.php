<?php

namespace App\Exports;

use App\Models\MasterItemGaji;
use App\Models\RekapAbsensi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TemplateFormatSlipGaji implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize, WithEvents
{

    /**
    * @return \Illuminate\Support\Collection
    
    */
     public function registerEvents(): array
    {
        return [
            
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:BQ1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF00');
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->getColor()->setARGB('DD4B39');
            },
        ];
    }
    public function headings(): array
    {
        $Judul = MasterItemGaji::where('stts','A')->orderBy('colom','ASC')->get();
        
        $data = array(
            'No',
            'NIK',
            'Nama' ,
            'Jabatan' ,
            'Tahun Bertugas ',
            'Divisi' ,
            'Status Karyawan' ,
            'Periode',
        );
        foreach ($Judul as $value) {
            array_push($data,$value->nama);
        }
        array_push($data,'Sub Total','Total Potongan','Total Gaji Bersih');
        return $data;
            
    }
    public function collection()
    {
        $users = User::where('status','!=','0')
                ->where('status_kerja','=','1')
                ->orderBy('divisi',"ASC")
                ->get();
            
        return $users;
    }

    public function map($users): array
    {            
        $date = date('Y-m').'-01';
                $data= [
                    '#',
                    $users-> nik,
                    $users-> name,
                    $users-> jabatan,
                    date('Y', strtotime($users-> tgl_mulai_bekerja)),
                    $users-> divisi,
                    $users-> status_karyawan,
                    $date,
                 ];
            return $data;
       
    }
}
