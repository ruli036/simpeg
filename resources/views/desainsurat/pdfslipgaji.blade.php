
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
              background-image: url('/img/b-yayasan.png') ;
              background-size: 30% ;
              background-repeat: no-repeat ;
              background-attachment: fixed ;
              background-position: center ;         
          }
       
        @page { margin-top: 150px;margin-right: 10px;margin-left: 10px;margin-bottom: 30px; }
        #header { position: fixed; left: 0px; top: -150px; right: 0px; height: 150px; text-align: center; }
        
    </style>
    
    <title>{{LEMBAGA}}</title>

    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>
 
<body class="container">
  <table class="table"  >
  <tr>
  <td class="text-center"   style="background-color: black;color: rgb(26, 219, 26);">
          <img src="{{asset('img/logo2.png')}}" width="100px">                  
  </td>
  <td  class="table" style="background-color: black;color: rgb(26, 219, 26);">
      <h1> TANDA TERIMA PENGHASILAN </h1>
      <div class="text-capitalize">
          Periode  : {{date('F Y', strtotime($masukan[0]->periode??""))}}
      </div>
  </td>
  </tr>
  </table>
    <table id=""  class="table text-capitalize" cellspacing="0" align="center" style="color: black; " border="0">
      <tr>
          <td colspan="4">
              Nama <br>
              Jabatan <br>
              Divisi<br>
              @foreach ($datas as $item)
              {{$item->nama}} <br>
              @endforeach
              
          </td>
          <td colspan="4"  class="text-right"> 
          
              {{$masukan[0]->name??""}}<br>                                   
              {{$masukan[0]->jabatan??""}} <br>
              {{$masukan[0]->divisi??""}} <br>
              @foreach ($datas as $item)
              {{$item->amount}} Hari
              @endforeach
              
          </td>
        </tr>  
        
        <tr>
        <th colspan="8" class="text-center">PEMASUKAN</th>
        </tr> 
        @php
            $totalMasukan = 0;
            $totalPotongan = 0;
        
        @endphp
        @foreach ($masukan as $item)
        @php
            $totalMasukan += $item->amount; 
        @endphp
        <tr>
            <td colspan="7">{{$item->nama}}  </td>
            <td class="text-right"> 
                @currency($item->amount)
            </td>
        </tr>                                         
        @endforeach
        <tr style="background-color: rgb(216, 216, 80);color: white" cellspacing="0" style="padding: 0px">
            <th colspan="7" > Subtotal Gaji</th>
            <th class="text-right">  
                @currency($totalMasukan)
            </th>
        </tr>  
            <tr>
            <th colspan="8" class="text-center">PEMOTONGAN</th>
        </tr> 
        @foreach ($potongan as $item)
        @php
        $totalPotongan += $item->amount; 
        @endphp
        <tr>
            <td colspan="7">{{$item->nama}} </td>
            <td class="text-right"> 
                (- @currency($item->amount))
            </td>
        </tr>                                         
        @endforeach
        <tr style="background-color: rgb(216, 216, 80);color: white">
            <th colspan="7" > Total Potongan</th>
            <th class="text-right">  
                (- @currency($totalPotongan))
            </th>
        </tr>  
        <tr>
            <th colspan="8" class="text-center">TOTAL PENDAPATAN</th>
        </tr> 
        <tr style="background-color: rgb(216, 216, 80);color: white">
            <th colspan="7" > Total Gaji Bersih</th>
            <th class="text-right">  
                @currency($totalMasukan - $totalPotongan)
            </th>
        </tr>  
      
          
    </table>
      <table class="table" border="0">
          <tr>
              {{-- <td class="table" ></td> --}}
              
              <td colspan="4" style="color: black">
                  <p style="font-family: 'Times New Roman', Times, serif">
                  Kepala Bidang Kepegawaian,<br><br><br><br>
                  {{$bendahara->name}} 
                  </p>
                  
              </td>
          </tr>
      </table>
                                       
     
</body>

</html>