<?php

namespace App\Exports;

use App\Models\MasterItemGaji;
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

class FormatSlipGaji implements FromCollection,WithMapping,WithHeadings,ShouldAutoSize, WithEvents
{
    private $tgl_awal;
    private $tgl_akhir;
    /**
    * @return \Illuminate\Support\Collection
    
    */
    public function __construct($tgl_awal, $tgl_akhir)
    {
        $this->tgl_awal = $tgl_awal;
        $this->tgl_akhir = $tgl_akhir;
        
    }
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
        $select  = "a.nik,a.name,a.jabatan,a.tgl_mulai_bekerja,a.divisi,a.status_karyawan,SUM(IF(b.jumlah_hadir = 1,b.jumlah_hadir, 0)) as kehadiran";
        $result = DB::table('users as a')
        ->selectRaw($select)
        ->leftJoin('tbl_absensi_sah as b', function ($join) {
            $join->on('a.id_absensi_karyawan', '=', 'b.id_absensi_karyawan')
                 ->whereRaw('b.tgl_absen >= ? AND b.tgl_absen <= ?', [$this->tgl_awal, $this->tgl_akhir])
                 ->orWhereNull('b.tgl_absen');
        })
        ->where('a.status_kerja', '=', 1)
        ->where('a.status', '!=', 0)
        ->groupBy('a.id_absensi_karyawan')
        ->orderBy('a.divisi','ASC') 
        ->orderBy('a.status','ASC') 
        ->get();
        

         return $result;
      
    }

    public function map($dataAbsensi): array
    {            
                 $date = date('Y-m').'-01';
                 $data= [
                    '#',
                    $dataAbsensi-> nik,
                    $dataAbsensi-> name,
                    $dataAbsensi-> jabatan,
                    date('Y', strtotime($dataAbsensi-> tgl_mulai_bekerja)),
                    $dataAbsensi-> divisi,
                    $dataAbsensi-> status_karyawan,
                    $date,
                    $dataAbsensi-> kehadiran??'0',
                ]; 
            return $data;
       
    }
}
