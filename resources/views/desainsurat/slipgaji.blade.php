<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="196x196" href="{{asset('img/logo.png')}}">
    <style>
          body { 
          background-image: url('img/b-yayasan.png');
          background-size: 50%;
          background-repeat: no-repeat;
          background-attachment: fixed;
          background-position: center;         
        }
        @page { margin:0px; }
    </style>
    <title>{{LEMBAGA}}</title>

    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>
 
<body>
    <table class="table" style="background-color: rgb(54, 33, 33)" >
        <tr>
            <td class="text-center">
                   <img src="{{asset('img/logo2.png')}}" width="15%">                    
             </td>
             <td  class="table" style="color: gold; ">
                <h1> TANDA TERIMA PENGHASILAN </h1><br>
                <div class="text-capitalize">
                    Disivi : {{$nama_divisi}} islam al-azhar cairo banda aceh <br>
                    Bulan  : {{date('F', mktime(0, 0, 0, substr($dataitem->bulan,0,2), 10))}} {{substr($dataitem->bulan,2)}}
                </div>
             </td>
        </tr>
     </table>
                                     <table class=" table text-capitalize" style="color: black">
                                        <tr>
                                            <td colspan="2">
                                                Nama <br>
                                                Jabatan <br>
                                                Tahun Bekerja <br>
                                                Hari Kerja <br>
                                                 
                                            </td>
                                            <td colspan="2"  class="text-right"> 
                                                {{$dataitem->nama }} <br>                                   
                                                {{$dataitem->jabatan}} <br>
                                                {{$dataitem->thn_mulai}} <br>
                                                {{$dataitem->hari_kerja}} Hari <br>
                                                
                                            </td>
                                        </tr>  
                                         <tr style="background-color:gold;color: white" >
                                            <th colspan="4" class="text-left">RUTIN</th>
                                         </tr> 
                                         <tr>
                                            <td colspan="2">Gaji Pokok</td>
                                            <td colspan="2">@currency($dataitem->gaji_pokok)</td>
                                            <td>
                                                Tunjangan Kepala Bidang <br>
                                                Tunjangan Wakil Kepala Sekolah <br>
                                                Tunjangan Wali Kelas<br>
                                                Tunjangan Sertifikasi<br>
                                                Jam+ / Kerja+<br>
                                                Tunjangan Pramuka<br>
                                                Tunjangan Publikasi Dokumentasi<br>
                                                Tunjangan Operator<br>
                                                Tunjangan Laboran<br>
                                                Tunjangan Hari Raya<br>
                                                Tunjangan Hafalan Tahfiz<br>
                                                Tunjangan Koordinator Bidang Studi<br>
                                                Tunjangan Koordinator Kelas<br>
                                                Tunjangan Koordinator Sapras<br>
                                                Tunjangan Koordinator PAB<br>
                                              </td> 
                                              <td> 
                                                @currency($dataitem->kabid) <br>
                                                @currency($dataitem->waka)<br>
                                                @currency($dataitem->wali_kelas)<br>
                                                @currency($dataitem->sertifikasi)<br>
                                                @currency($dataitem->jam_kerja)<br>
                                                @currency($dataitem->pramuka)<br>
                                                @currency($dataitem->pubdoc)<br>
                                                @currency($dataitem->operator)<br>
                                                @currency($dataitem->laboran)<br>
                                                @currency($dataitem->thr)<br>
                                                @currency($dataitem->tahfiz)<br>
                                                @currency($dataitem->koor_bidang_studi)<br>
                                                @currency($dataitem->koor_kelas)<br>
                                                @currency($dataitem->koor_sapras)<br>
                                                @currency($dataitem->koor_pab)<br>
                                              </td> 
                                              <td >
                                                Tunjangan Koordinator IT<br>
                                                Tunjangan Koordinator Ekstrakurikuler<br>
                                                Tunjangan Koordinator Konseling<br>
                                                Tunjangan Koordinator Tahfiz<br>
                                                Tunjangan Koordinator Infaq<br>
                                                Tunjangan Koordinator TOP 3/11<br>
                                                Tunjangan Koordinator Mudahasah<br>
                                                Tunjangan Koordinator Katering<br>
                                                Tunjangan Koordinator TFL<br>
                                                Tunjangan Koordinator Mading<br>
                                                Tunjangan Koordinator Dana Bos<br>
                                                Tunjangan Koordinator Kelas Inspirasi<br>
                                                Tunjangan Koordinator Lab IT<br>
                                                Tunjangan Koordinator Osis<br>
                                              </td>  
                                            
                                              <td class="text-right"> 
                                                @currency($dataitem->koor_it)<br>
                                                @currency($dataitem->koor_exschool)<br>
                                                @currency($dataitem->koor_konseling)<br>
                                                @currency($dataitem->koor_tahfiz)<br>
                                                @currency($dataitem->koor_infaq)<br>
                                                @currency($dataitem->koor_top3)<br>
                                                @currency($dataitem->koor_muhadasah)<br>
                                                @currency($dataitem->koor_katering)<br>
                                                @currency($dataitem->koor_tfl)<br>
                                                @currency($dataitem->koor_mading)<br>
                                                @currency($dataitem->koor_dana_bos)<br>
                                                @currency($dataitem->koor_kelas_isp)<br>
                                                @currency($dataitem->koor_lab_it)<br>
                                                @currency($dataitem->koor_osis)<br>
                                              </td>
                                              <tr style="background-color: gold;color: white">
                                                <th colspan="4" class="text-left">UANG TAMBAHAN </th>
                                                 </tr> 
                                                 <tr>
                                                    <td colspan="2">
                                                        Uang Harian <br>
                                                        Uang Lembur <br>
                                                    </td>
                                                     <td colspan="2">
                                                        @currency($dataitem->uang_harian)<br>
                                                        @currency($dataitem->uang_lembur)<br>
                                                    </td>
                                                    <td colspan="2">@currency($dataitem->gaji_pokok)</td>
                                                 </tr>
                                              @if (count($upah) > 0 )
                                                <tr style="background-color: gold;color: white">
                                                    <th colspan="4" class="text-left">BONUS </th>
                                                    </tr> 
                                                    <tr> 
                                                        <td colspan="2">
                                                        @foreach ($upah as $_upah)
                                                            {{$_upah->ket}} <br>
                                                        @endforeach
                                                        </td>
                                                        <td colspan="2" class="text-right">
                                                            @foreach ($upah as $_upah)
                                                            @currency($_upah->jumlah) <br>
                                                            @endforeach
                                                        </td>
                                                    </tr>
                                            @endif
                                            <tr style="background-color: gold;color: white">
                                                <th colspan="4" class="text-left">SUB TOTAL GAJI SEBELUM PEMOTONGAN </th>
                                            </tr> 
                                            <tr style="background-color: gold;color: white">
                                                <th colspan="2">TOTAL GAJI   </th>
                                                @if(Auth::user()->status == '2'||Auth::user()->status == '0' )
                                                <th class="text-right" ><hr> @currency(($dataitem->total_tunjangan + $dataitem->gaji_pokok +  $dataitem->total_upah_lain + $dataitem->uang_lembur+$dataitem->uang_harian+$dataitem->jam_tambahan) )</th>
                                                @else  
                                                <th class="text-right" ><hr> @currency(($dataitem->total_tunjangan + $dataitem->gaji_pokok+ $dataitem->total_upah_lain+$dataitem->uang_lembur+ $dataitem->uang_harian+$dataitem->jam_tambahan)- ($dataitem->bpjs_kesehatan_add+$dataitem->bpjs_tenagakerja_add) )</th>
                                                @endif
                                             </tr>                                            
                                            <tr style="background-color: gold;color: white">
                                                <th colspan="4" class="text-left">PEMOTONGAN </th>
                                            </tr> 
                                            <tr>
                                                <td colspan="2">
                                                    BPJS Tenaga Kerja Dari Yayasan <br>
                                                    BPJS Kesehatan Dari Yayasan <br>
                                                    BPJS Tenaga Kerja Dari Pribadi <br>
                                                    BPJS Kesehatan Dari Pribadi <br>
                                                    Hikmah Wakilah <br>
                                                    Dana Sosial <br>
                                                    SPP <br>
                                                    BMT <br>
                                                    Daftar Ulang
                                                </td>
                                                <td colspan="2"  class="text-right">  
                                                    @currency($dataitem->bpjs_tenagakerja_yayasan) <br>
                                                    @currency($dataitem->bpjs_kesehatan_yayasan) <br>
                                                    (- @currency($dataitem->bpjs_tenagakerja_pribadi)) <br>
                                                    (- @currency($dataitem->bpjs_kesehatan_pribadi)) <br>
                                                    (- @currency($dataitem->hikmah_wakilah))<br>
                                                    (- @currency($dataitem->dana_sosial))<br>
                                                    (- @currency($dataitem->bmt))<br>
                                                    (- @currency($dataitem->spp))<br>
                                                    (- @currency($dataitem->daftar_ulang))<br>                                     
                                                </td>
                                            </tr>
                                            <tr style="background-color: gold;color: white">
                                                <th colspan="2">TOTAL   </th>
                                                <th colspan="2"  class="text-right"> @currency($dataitem->total + $dataitem->total_upah_lain)</th>
                                            </tr> 
                                        </table>
                                        <table class="table">
                                            <tr>
                                                <td class="table"></td>
                                                <td class="table"></td>
                                                <td class="table" style="color: black">
                                                    <p style="font-family: 'Times New Roman', Times, serif">
                                                    Kepala Bidang Kepegawaian,<br><br><br>
                                                    {{$bendahara->name}} 
                                                    </p>
                                                    
                                                </td>
                                            </tr>
                                        </table>
 
     
</body>

</html>
