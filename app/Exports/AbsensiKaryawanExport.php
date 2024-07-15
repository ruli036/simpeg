<?php

namespace App\Exports;

use App\Models\RekapAbsensi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class AbsensiKaryawanExport implements FromCollection,WithHeadings,ShouldAutoSize, WithEvents
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
                $cellRange = 'A1:AL1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
                $event->sheet->getStyle($cellRange)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('00FF00');
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->getColor()->setARGB('DD4B39');
            },
        ];
    }
    public function headings(): array
    {         
        $tglawal = Carbon::createFromFormat('Y-m-d', $this->tgl_awal);
        $tglakhir = Carbon::createFromFormat('Y-m-d', $this->tgl_akhir);
        $a = 0;
        $header = [
                 'NIK',
                 'Nama' ,
                 'Jabatan' ,
                 'Divisi' ,
                 'Kehadiran' ,
                 'Total Telat Datang ',
                 'Total Telat Kembali ',
                 'Total Cepat Pulang ',
         ];
         $nama_hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
       
         while ($tglawal <= $tglakhir) {
            $tanggal_carbon = strtotime($tglawal);
            $hari_indonesia = $nama_hari[date('w', $tanggal_carbon)];
            $format_header = $hari_indonesia.', '.date('Y-m-d', strtotime($tglawal));
            array_push($header,$format_header);
            $tanggal_carbon = Carbon::parse($tglawal);
            $tglawal =  $tanggal_carbon->addDays(1);
            
        }
        
        return $header;
    }
    public function collection()
    { 
        $tglawal = Carbon::parse($this->tgl_awal);
        $tglakhir = Carbon::parse($this->tgl_akhir);
        $divisi = Auth::user()->divisi;

        $select  = "a.nik, a.name, a.jabatan, a.divisi,SUM(IF(b.jumlah_hadir = 1,b.jumlah_hadir, 0)) as kehadiran,
         SEC_TO_TIME(CAST(SUM(b.telat_masuk) AS SIGNED)) as terlambat,
         SEC_TO_TIME(CAST(SUM(b.telat_kembali) AS SIGNED)) as terlambat_kembali,
         SEC_TO_TIME(CAST(SUM(b.cepat_pulang) AS SIGNED)) as cepatpulang";
      
        while ($tglawal <= $tglakhir) {
            $tgl = $tglawal->format('Y-m-d');
            $select .= ", MAX(CASE WHEN b.tgl_absen = '" . $tgl . "' THEN CONCAT(b.jam_masuk,' - ',b.jam_siang,' - ',b.jam_pulang) ELSE '-' END) as `" . $tgl . "`";
            $tanggal_carbon = Carbon::parse($tglawal);
            $tglawal =  $tanggal_carbon->addDay();    
        }
        
        if(Auth::user()->status == 2 || Auth::user()->status == 0){
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

        }else{
            $result = DB::table('users as a')
            ->selectRaw($select)
            ->leftJoin('tbl_absensi_sah as b', function ($join) {
                $join->on('a.id_absensi_karyawan', '=', 'b.id_absensi_karyawan')
                     ->whereRaw('b.tgl_absen >= ? AND b.tgl_absen <= ?', [$this->tgl_awal, $this->tgl_akhir]) 
                     ->orWhereNull('b.tgl_absen');
            })
            ->where('a.status_kerja', '=', 1)
            ->where('a.status', '!=', 0)
            ->where('a.divisi','=',$divisi )
            ->groupBy('a.id_absensi_karyawan')
            ->orderBy('a.status','ASC') 
            ->get();
           
            return $result;
              
        }
        
    }

   
}
