@if(Auth::user()->status == '4' || Auth::user()->status == '5'|| Auth::user()->status == '0'||Auth::user()->status == '2'||Auth::user()->status == '1')
  <div class="row">
    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Anggota BMT </h6>
                <h6 class="m-0 font-weight-bold text-primary"> Karyawan Aktif: {{count($jumlahuser)}} </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Data Karyawan  </h6>
                <h6 class="m-0 font-weight-bold text-primary"> Karyawan Aktif : {{count($jumlahuser)}} </h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle " style="color: lightblue"></i>  DAYCARE
                    </span>
                     <span class="mr-2">
                        <i class="fas fa-circle" style="color: blue"></i>  KB-TK
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle " style="color: green"></i>   SD
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle " style="color: gray"></i>   SMP
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle " style="color: yellow"></i>   YAYASAN
                    </span>
                     <span class="mr-2">
                        <i class="fas fa-circle " style="color: red"></i>   NONAKTIF
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Karyawan dan Guru Al-Azhar Cairo Banda Aceh </h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
     </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr> 
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Hp</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
                        <th>Tanggal Lahir</th>
                        <th>Tempat Lahir</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                
                 <tbody>
                     <div class="d-none">
                       {{$no = 1}}   
                     </div>
                    
                     @foreach ($datauser as $datas)
                        
                         <tr>
                              <td>{{$no++}}</td>
                              <td>{{$datas->name}}</td>
                              <td>{{$datas->no_hp}}</td>
                              <td>{{$datas->divisi}}</td>
                              <td>{{$datas->jabatan}}</td>
                              <td>{{$datas->tgl_lahir}}</td>
                              <td>{{$datas->tempat}}</td>
                              <td>{{$datas->alamat}}</td>
                              
                         </tr>
                     @endforeach
                 </tbody>
            </table>
        </div>
    </div>
</div>

</div>
@else
 
<div class="row text-center">
    <div class="col-xl-4 col-md-6 mb-4"  title="Ajukan Cuti">
        <a type="button" href="{{url('halamanajukansurat')}}">  
            <div class="card border border-left-info  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="container">
                            <img src="{{url('img/ajukan_surat.jpg')}}" width="70%" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a> 
    </div>
    <div class="col-xl-4 col-md-6 mb-4"    title="Daftar Cuti">
        <a href="{{url('datasuratdisetujui')}}">
            <div class="card border border-left-warning  shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="container">
                            <img src="{{url('img/surat_setuju.jpg')}}" width="60%" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a> 
    </div>
    <div class="col-xl-4 col-md-6 mb-4"   title="Daftar Slip Gaji">
    <a href="{{url('daftarslipgajikaryawan')}}">
            <div class="card border border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="container">
                            <img src="{{url('img/gaji.jpg')}}" width="60%" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a> 
    </div>
</div>
    @endif
</div>
</div>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
<script>
    // var jumlahKaryawan = document.getElementById("jumlahKaryawan").value == "" ? 0 : document.getElementById("jumlahKaryawan").value;
    var jumlahKaryawan = {{count($jumlahuser)}};
    var AnggotaBmt = {{$anggotaBMT}};
    var ctx1 = document.getElementById("myAreaChart");
    var myLineChart = new Chart(ctx1, {
      type: 'line',
      data: {
        labels: ["0","Anggota BMT","Karyawan"],
        datasets: [{
          label: "Anggota",
          lineTension: 0.3,
          backgroundColor: "rgba(78, 115, 223, 0.05)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointRadius: 3,
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "rgba(78, 115, 223, 1)",
          pointHoverRadius: 3,
          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          pointHitRadius: 10,
          pointBorderWidth: 2,
          data: [0, AnggotaBmt, jumlahKaryawan],
        }],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0
          }
        },
        scales: {
          xAxes: [{
            time: {
              unit: 'date'
            },
            gridLines: {
              display: false,
              drawBorder: false
            },
            ticks: {
              maxTicksLimit: 7
            }
          }],
          yAxes: [{
            ticks: {
              maxTicksLimit: 5,
              padding: 10,
              // Include a dollar sign in the ticks
              callback: function(value, index, values) {
                return number_format(value);
              }
            },
            gridLines: {
              color: "rgb(234, 236, 244)",
              zeroLineColor: "rgb(234, 236, 244)",
              drawBorder: false,
              borderDash: [2],
              zeroLineBorderDash: [2]
            }
          }],
        },
        legend: {
          display: false
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: '#6e707e',
          titleFontSize: 14,
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: 'index',
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
            }
          }
        }
      }
    });
    
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';
    
    // Pie Chart Example
    var ctx2 = document.getElementById("myPieChart"); 
    var myPieChart = new Chart(ctx2, {
      type: 'doughnut',
      data: {
        labels: ["DAYCARE","KB-TK", "SD", "SMP","YAYASAN","NONAKTIF"],
        datasets: [{
          data: [{{count($jumlahuserDAYCARE??[])}},{{count($jumlahuserTK??[])}}, {{count($jumlahuserSD??[])}}, {{count($jumlahuserSMP??[])}}, {{count($jumlahuserYA??[])}},{{$jumlahusernon??[]}}],
          backgroundColor: ['lightblue', 'blue', 'green','gray','yellow','red'],
          hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",    
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });
    
    </script>