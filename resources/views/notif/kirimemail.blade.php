<!DOCTYPE html>
<html>
<head>
    <title>{{LEMBAGA}}</title>
</head>
<body>
    <table>
        
        @if ($details['mulai']=='-')
        <tr>
            <td>Nama</td>
            <td> :{{ $details['name']??"" }}</td>
        </tr>
        <tr>
            <td>Divisi</td>
            <td> :{{ $details['divisi']??"" }}</td>
        </tr> 
        <tr>
            <td>Jabatan</td>
            <td> :{{ $details['jabatan']??"" }}</td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td> :{{ $details['kategori']??"" }}</td>
        </tr>
        <tr>
            <td>No Rekening</td>
            <td> :{{ $details['no_rek']??0 }}</td>
        </tr>
         <tr>
            <td>Nominal</td>
            <td> : {{$details['nominal']??0}}</td>
        </tr>
        @elseif($details['mulai']=='1')
        <tr>
            <td>Nama</td>
            <td> :{{ $details['name']??"" }}</td>
        </tr>
        <tr>
            <td>Divisi</td>
            <td> :{{ $details['divisi']??"" }}</td>
        </tr> 
        <tr>
            <td>Jabatan</td>
            <td> :{{ $details['jabatan']??"" }}</td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td> :{{ $details['kategori']??"" }}</td>
        </tr>
        <tr>
            <td>Nominal</td>
            <td> : {{$details['nominal']??0}}</td>
        </tr>
        @elseif($details['mulai']=='2')
        <tr>
            <td colspan="2" class="text-capitalize"> PEMBERITAHUAN UNTUK SELURUH KARYAWAN SEKOLAH ISLAM AL-AZHAR CAIRO BANDA ACEH PERIHAL GAJI BULAN {{date('F Y', strtotime($details['bulan']))}}</td>
        </tr>
        @elseif($details['mulai']=='3')
        <tr>
            <td colspan="2" class="text-capitalize"> RESET PASSWORD AKUN KARYAWAN AL-AZHAR CAIRO BANDA ACEH</td>
        </tr>
         <tr>
            <td colspan="2" class="text-capitalize"> <h2> {{ $details['kategori'] ??"" }}</h2></td>
        </tr>
        @else
        <tr>
            <td>Nama</td>
            <td> :{{ $details['name']??"" }}</td>
        </tr>
        <tr>
            <td>Divisi</td>
            <td> :{{ $details['divisi']??"" }}</td>
        </tr> 
        <tr>
            <td>Jabatan</td>
            <td> :{{ $details['jabatan']??"" }}</td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td> :{{ $details['kategori']??"" }}</td>
        </tr>
        <tr>
            <td>Tanggal Mulai Cuti</td>
            <td> :{{ $details['mulai'] }}</td>
        </tr>
        <tr>
            <td>Tanggal Akhir Cuti</td>
            <td> :{{ $details['akhir'] }}</td>
        </tr>
        <tr>
            <td>Jumlah Cuti</td>
            <td> :{{ $details['jumlah'] }}</td>
        </tr>
        <tr>
            <td>Sisa Cuti</td>
            <td> :{{ $details['sisa'] }}</td>
        </tr>
        @endif
        
    </table>
    <hr>
    <b>KETERANGAN </b> 
    <p class="text-capitalize">{{ $details['body'] }}</p> <br>
    @if ($details['mulai']=='3')
    <p>{{$details['link']}}</p> 
        <hr>
        <div class="d-flex justify-content-center">
            <a type="button" class="btn btn-success btn-user btn-block" href="{{ url($details['link']) }}">{{ __('Reset Password!') }}</a>
        </div>
    @endif
</body>
</html>