<?php

namespace App\Exports;

use App\Models\MasterItemGaji;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SlipGajiExport implements FromCollection,WithHeadings,ShouldAutoSize, WithEvents
{
    private $bln;
    private $thn;
    private $divisi;
    /**
    * @return \Illuminate\Support\Collection
    
    */
    public function __construct(string $bln,string $thn,string $divisi)
    {
        $this->bln = $bln;
        $this->thn = $thn;
        $this->divisi = $divisi;
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
        $Judul = MasterItemGaji::orderBy('colom','ASC')->get();
        
        $data = array(
            'NIK',
            'Nama' ,
            'Jabatan' ,
            'Tahun Bertugas ',
            'Divisi' ,
            'Status Karyawan' ,
            'Gaji Bulan',
        );
        foreach ($Judul as $value) {
            array_push($data,$value->nama);
        }
        array_push($data,'Sub Total','Total Potongan','Total Gaji Bersih');
        return $data;
    }
   
    public function collection()
    {
            
// select a.id,a.name,a.nik,sum(if(c.flag = 'P', b.amount,0)) as subtotal,sum(if(c.flag = 'M', b.amount,0)) as potongan,sum(if(c.flag = 'P', b.amount,0))- sum(if(c.flag = 'M', b.amount,0)) as total from users a inner join riwayat_gaji b on a.id = b.id_karyawan and b.periode = '2023-06-23' 
// inner join master_item_gaji c on b.id_componen_gaji = c.id
// group by a.id 
 
// insert into riwayat_gaji (id_karyawan,
// id_componen_gaji,
// jabatan,
// divisi,
// periode,
// amount,
// stts_karyawan)
// (select (select id from users where nik = a.nik) as id_karyawan ,'2' as id_componen_gaji,
// jabatan,
// divisi,
// bulan,
// gaji_pokok as amount, status_karyawan FROM tbl_slip_gaji a
// union all select (select id from users where nik = b.nik) as id_karyawan ,'3' as id_componen_gaji,
// jabatan,
// divisi,
// bulan,
// bpjs_kesehatan_add as amount, status_karyawan FROM tbl_slip_gaji b)

 $Judul = MasterItemGaji::orderBy('flag','ASC')->get();
        
        $select  = "a.nik, a.name, b.jabatan, a.tgl_mulai_bekerja, b.divisi,a.status_karyawan,b.periode";
        foreach ($Judul as  $value) {
             $select.= ",SUM(IF(c.id = '".$value->id."', b.amount, 0)) as `".$value->nama."`";
        }
        $select.= ",SUM(IF(c.flag = 'P', b.amount, 0)) as subtotal, 
        SUM(IF(c.flag = 'M', b.amount, 0)) as potongan, 
        SUM(IF(c.flag = 'P', b.amount, 0)) - SUM(IF(c.flag = 'M', b.amount, 0)) as total";
        if($this->divisi=='all'){
            $result = DB::table('users as a')
                    ->selectRaw($select)
                    ->join('riwayat_gaji as b', function ($join) {
                        $join->on('a.id', '=', 'b.id_karyawan')
                            ->whereMonth('b.periode', '=', $this->bln)
                            ->whereYear('b.periode', '=', $this->thn);
                    })
                    ->join('master_item_gaji as c', 'b.id_componen_gaji', '=', 'c.id')
                    ->groupBy('a.id')
                    ->get();
                    return $result;
        }else{
            $result = DB::table('users as a')
            ->selectRaw($select)
            ->join('riwayat_gaji as b', function ($join) {
                $join->on('a.id', '=', 'b.id_karyawan')
                    ->where('b.divisi', '=', $this->divisi)
                    ->whereMonth('b.periode', '=', $this->bln)
                    ->whereYear('b.periode', '=', $this->thn);
            })
            ->join('master_item_gaji as c', 'b.id_componen_gaji', '=', 'c.id')
            ->groupBy('a.id')
            ->get();
            return $result;
        }
 
    }

    
    
}
 

 
