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
        .fb-icon:hover {
            background: white;
        }
        @page { 
            margin:0px;
              }
        .parentClass {
            background-image:url('img/daycare2.png');
            background-size: 100%;
            background-repeat: no-repeat;
            background-attachment: fixed;
            width: 80vw;
            height: 210px;
        }
  
        .firstchild {
            bottom: 15;
            left: 15;
            color:white;
        }
        
        .childClass2 {
            position: absolute;
        }
        .childClass {
            position: absolute;
            height: 50px;
            width: 500px;
        }
    </style>
    <title>{{LEMBAGA}}</title>
     <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
 </head>
<body>
          <table class="table" style="background-image: url('img/daycare1.png');background-size: 100%;background-repeat: no-repeat;background-attachment: fixed;" >
            <tr>
                <td class="table" style="padding-top:40px;padding-left: 40px ">
                     <img src="{{asset('img/'.$logo)}}" width="25%"> 
                 </td>
                 <td class="table" style="color: black">
                    <br><br><br><br><br><br><br>
                    <p style="font-family: 'Times New Roman', Times, serif">
                    Banda Aceh, {{date('d F Y ', strtotime($tgl))}} <br><br>
                    Kepada Yth,<br>
                    Ketua Yayasan Pendidikan Sosial <br>
                    dan Dakwah Al-Azhar Aceh <br>
                    di- <br>
                        Tempat <br>  
                    </p>
                 </td>
            </tr>
         </table>
        <div style="padding-left: 100px;padding-right: 30px" >
            <p style="font-family: 'Times New Roman', Times, serif;color: black">
            Perihal : <b>Permohonan {{$cuti}}</b> <br>
            Saya yang bertanda tangan di bawah ini: 
         </p>
        <table style="font-family: 'Times New Roman', Times, serif;color: black">
             <tr>
                <td style="width:70">Nama</td>
                <td style="padding-left:50px ">: {{$nama}}</td>
            </tr> 
            <tr>
                <td style="width:70">Jabatan</td>
                <td style="padding-left:50px ">: {{$jabatan}}</td>
            </tr>
             <tr>
                <td style="width:70">Unit Kerja</td>
                <td style="padding-left:50px ">: TPA ALACA Banda Aceh</td>
            </tr>
         </table> <br>
         <p style="font-family: 'Times New Roman', Times, serif;color: black">
            Dengan ini mengajukan permohonan {{$cuti}} selama {{$jumlah}} hari, yaitu:
         </p>
         <table style="font-family: 'Times New Roman', Times, serif;color: black">
            <tr>
                <td style="width:100">Mulai Tanggal</td>
                <td class="table" style="padding-left:15px;color: black ">: {{date('d F Y ', strtotime($tgl_mulai))}}</td>
            </tr>
             <tr>
                <td style="width:100">Sampai Tanggal</td>
                <td class="table" style="padding-left:15px;color: black ">: {{date('d F Y ', strtotime($tgl_akhir))}}</td>
            </tr>
            <tr>
                <td style="width:100">Keperluan</td>
                <td class="table text-capitalize" style="padding-left:15px;color: black ">: {{$keterangan}}</td>
            </tr>
         </table><br>
        <p style="font-family: 'Times New Roman', Times, serif;color: black">
            Demikian surat permohonan cuti ini saya sampaikan atas pertimbangan Bapak saya ucapkan terima kasih.
        </p>
        <table class="table">
            <tr>
                <td class="table"></td>
                <td class="table"></td>
                <td class="table" style="color: black">
                    <p style="font-family: 'Times New Roman', Times, serif">
                    Hormat Saya,<br><br>
                    {{$nama}} 
                    </p>
                </td>
            </tr>
        </table>
        @if($status=="3")
        <p style="font-family: 'Times New Roman', Times, serif;color: black">
           Rekomendasi Kepala Bidang Kepegawaian <br>
           {{$ket_rekom2}}
        </p>   
          @else
         <p style="font-family: 'Times New Roman', Times, serif;color: black">
           Rekomendasi Kepala Sekolah <br>
           {{$ket_rekom1}}
        </p> 
        <p style="font-family: 'Times New Roman', Times, serif;color: black">
           Rekomendasi Kepala Bidang Kepegawaian <br>
           {{$ket_rekom2}}
        </p>    
        @endif
        <p style="font-family: 'Times New Roman', Times, serif;color: black">
           Keputusan Ketua Yayasan <br>
           {{$ket_rekom3}}
        </p>
    </div>     
    <div class="childClass2 parentClass">
        <div class="childClass firstchild" >
            <h6 class="text-capitalize text-light">
                {{$alamat}}
              </h6>
              <h6 class="text-light">
                  {{$email}} || {{$hp}}
              </h6>
    </div>    
        </div>    

    
     <!-- Bootstrap core JavaScript-->
     <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
     <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 
     <!-- Core plugin JavaScript-->
     <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
 
     <!-- Custom scripts for all pages-->
     <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
     </body>
</html>