<?php

namespace App\Exports;

use App\Models\PinjamanBmt;
use App\Models\RekapBmt;
use App\Models\SetoranBMT;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class BmtExport implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function registerEvents(): array
    {
        return [
            
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:F1'; // All headers
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
                 'Tanggal Rekapan',
                 'Total BMT' ,
                 'Total Wadiah' ,
                 'Total Pinjaman' ,
                 'Total Pembayaran Pinjaman' ,
                 'Total Setoran Bulanan Ke Bank' ,
           ];
    }
    public function collection()
    {
        $dataSetoran = RekapBmt::orderBy('bulan','ASC')->get();  
        return $dataSetoran; 
    }

    public function map($data): array
    {            
                $data= [
                    date('F Y', strtotime($data->bulan)),
                    number_format( $data->total_bmt),
                    number_format( $data->total_wadiah),
                    number_format( $data->total_pinjaman),
                    number_format( $data->total_pinjaman_dibayar),                     
                    number_format( $data->total_pinjaman_dibayar + $data->total_bmt + $data->total_wadiah),                    
                ];
                DB::table('tbl_rekap_bmt')->delete();
               
            return $data;
       
    }
}
