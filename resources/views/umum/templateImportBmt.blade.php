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
    header("Content-Disposition: attachment; filename= Template Import Data BMT.xls");
 @endphp
            <table border="1">
                <thead>
                    <tr>
                        <th>No </th>
                        <th style="background-color: rgb(81, 184, 81);color: white">NIK</th>
                        <th style="background-color: rgb(81, 184, 81);color: white">Nama</th>
                        <th style="background-color: rgb(81, 184, 81);color: white">Jabatan</th>
                        <th style="background-color: rgb(81, 184, 81);color: white">Mulai Bergabung</th>
                        <th style="background-color: rgb(81, 184, 81);color: white">Divisi</th>
                        <th style="background-color: rgb(81, 184, 81);color: white">Tanggal Setoran</th>
                        <th>Setoran Wajib BMT</th>
                        <th>Setoran Wadiah</th>
                        <th>Cicilan Ke</th>
                        <th>Nominal Cicilan</th>
                      </tr>
                </thead>
                
                    <tbody>
                        @foreach ($users as $datas)
                             <tr>
                                <td style="display: none;">{{$no++}}</td>
                                <td>{{$datas->nik}}</td>
                                <td>{{$datas->name}}</td>
                                <td>{{$datas->jabatan}}</td>
                                <td>{{$datas->tgl_bergabung}}</td>
                                <td>{{$datas->divisi}}</td>
                                <td>{{date('Y-m-d', strtotime(now()))}}</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
</body>

</html>