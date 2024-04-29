<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="196x196" href="{{asset('img/logo.png')}}">

    <title>{{LEMBAGA}}</title>
 

</head>

<body id="page-top">
 @php
    header("Content-type: application/excel");
    header("Content-Disposition: attachment; filename=Format Import Excel Slip Gaji.xls");
 @endphp
            <table border="1">
                <thead>
                    <tr>
                        <th>No </th>
                        <th style="background-color: rgb(81, 184, 81);color: white">NIK</th>
                        <th style="background-color: rgb(81, 184, 81);color: white">Nama</th>
                        <th style="background-color: rgb(81, 184, 81);color: white">Jabatan</th>
                        <th style="background-color: rgb(81, 184, 81);color: white">Tahun Bertugas</th>
                        <th style="background-color: rgb(81, 184, 81);color: white">Divisi</th>
                        <th style="background-color: rgb(81, 184, 81);color: white">Status</th>
                        <th style="background-color: rgb(81, 184, 81);color: white">Gaji Bulan</th>
                        <th>Hari Kerja</th>
                        <th>Gaji Pokok</th>
                        <th>BPJS Kesehatan</th>
                        <th>BPJS Tenaga kerja</th>
                        <th>Kepala Sekolah</th>
                        <th>Wakil Kepala Sekolah</th>
                        <th>Wali Kelas</th>
                        <th>Jam+ / Kerja+</th>
                        <th>Hafalan Tahfiz</th>
                        <th>Sertifikasi</th>
                        <th>Pramuka</th>
                        <th>Publikasi Dokumentasi</th>
                        <th>Operator</th>
                        <th>Laboran</th>
                        <th>Taller</th>
                        <th>Tunjanga BMT</th>
                        <th>Tunjanga Umrah</th>
                        <th>Tunjanga Hari Raya</th>
                        <th>Tunjanga Kepala Bidang</th>
                        <th>Tunjanga Koordinator Kelas</th>
                        <th>Tunjanga Koordinator Kelas Inspirasi</th>
                        <th>Tunjanga Koordinator Bidang Studi</th>
                        <th>Tunjanga Koordinator Sapras</th>
                        <th>Tunjanga Koordinator PAB</th>
                        <th>Tunjanga Koordinator IT</th>
                        <th>Tunjanga Koordinator Ekstrakurikuler</th>
                        <th>Tunjanga Koordinator Konseling</th>
                        <th>Tunjanga Koordinator Tahfiz</th>
                        <th>Tunjanga Koordinator Infaq</th>
                        <th>Tunjanga Koordinator Top 3/11</th>
                        <th>Tunjanga Koordinator Muhadasah</th>
                        <th>Tunjanga Koordinator Katering</th>
                        <th>Tunjanga Koordinator TFL</th>
                        <th>Tunjanga Koordinator Mading</th>
                        <th>Tunjanga Koordinator Dana Bos</th>
                        <th>Tunjanga Koordinator Lab IT</th>
                        <th>Tunjanga Koordinator Osis</th>
                        <th>Tunjanga Koordinator Keagamaan</th>
                        <th style="background-color: yellow">Total Tunjangan dan Gaji Pokok</th>
                        <th>Uang Jam Siang</th>
                        <th>Uang Jam Ganti</th>
                        <th>Uang Harian</th>
                        <th>Jumlah Lembur</th>
                        <th style="background-color: yellow">Total Uang Lembur</th>
                        <th>BPJS Ketenaga Kerjaan Yayasan</th>
                        <th>BPJS Ketenaga Kerjaan Pribadi</th>
                        <th>BPJS Kesehatan Yayasan</th>
                        <th>BPJS Kesehatan Pribadi</th>
                        <th>Hikmah Wakilah</th>
                        <th>BMT</th>
                        <th>SPP</th>
                        <th>Uang KAS</th>
                        <th>Daftar Ulang</th>
                        <th style="background-color: yellow">Total Potongan</th>
                        <th style="background-color: yellow">Total Gaji Bersih </th>
                        <th style="background-color: red;color: white">Keterangan Bonus Tambahan1</th>
                        <th style="background-color: red;color: white">jumlah Bonus1</th> 
                        <th style="background-color: red;color: white">KeteranganBonus Tambahan2</th>
                        <th style="background-color: red;color: white">jumlah Bonus2</th>
                        <th style="background-color: red;color: white">Keterangan Bonus Tambahan3</th>
                        <th style="background-color: red;color: white">jumlah Bonus3</th>
                      </tr>
                </thead>
                
                    <tbody>
                        @foreach ($users as $datas)
                             <tr>
                                <td style="display: none;">{{$no++}}</td>
                                <td>{{$datas->nik}}</td>
                                <td>{{$datas->name}}</td>
                                <td>{{$datas->jabatan}}</td>
                                <td>{{substr($datas->tgl_mulai_bekerja,-4)}}</td>
                                <td>{{$datas->divisi}}</td>
                                <td>{{$datas->status_karyawan}}</td>
                                <td>{{date('m Y')}}</td>                               
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td style="background-color: yellow">=SUM(J{{$no}}:AT{{$no}})</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td style="background-color: yellow">=AY{{$no}} * 20000</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td style="background-color: yellow">=SUM(BA{{$no}}:BI{{$no}})</td>
                                <td style="background-color: yellow">=(AX{{$no}}+AW{{$no}}+AU{{$no}}+AV{{$no}}+AZ{{$no}}) - BJ{{$no}}</td>
                                <td>-</td>
                                <td>0</td>
                                <td>-</td>
                                <td>0</td>
                                <td>-</td>
                                <td>0</td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
</body>

</html>