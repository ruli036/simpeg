<?php

namespace App\Exports;

use App\Models\AnggotaBMT;
use App\Models\RekapAbsensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TemplateFormatBMT implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    
    */
    public function registerEvents(): array
    {
        return [
            
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:K1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF00');
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->getColor()->setARGB('DD4B39');
            },
        ];
    }
    
    public function headings(): array
    {
        
              return [
                 'No',
                 'NIK',
                 'Nama' ,
                 'Jabatan' ,
                 'Mulai Bergabung' ,
                 'Divisi' ,
                 'Tanggal Setoran' ,
                 'Setoran Wajib BMT' ,
                 'Setoran Wadiah' ,
                 'Cicilan Ke' ,
                 'Nominal Cicilan' ,
            ];
    }
    public function collection()
    {
        $AnggotaBMT =  AnggotaBMT::join('users','users.id','=','tbl_anggota_bmt.id_karyawan')->where('sts_anggota',0)->orderBy('users.divisi',"DESC")->get(); 
            
        return $AnggotaBMT;
    }

    public function map($AnggotaBMT): array
    {            
                $data= [
                    '#',
                    $AnggotaBMT-> nik,
                    $AnggotaBMT-> name,
                    $AnggotaBMT-> jabatan,
                    date('Y-m-d', strtotime($AnggotaBMT-> tgl_bergabung)),
                    $AnggotaBMT-> divisi,
                    date('Y-m-d', strtotime(now())),
                    number_format('50000'),
                    '0',
                    "0",
                    "0",
                ];
            return $data;
       
    }
}
