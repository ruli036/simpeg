
@if(Auth::user()->status == '7' || Auth::user()->status == '1'|| Auth::user()->status == '4'|| Auth::user()->status == '0')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Total Tabungan BMT</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">@currency($infoBmt->nominal_bmt)</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jumlah Total Tabungan  Wadiah</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">@currency(totalSetoranWadiah())</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Uang Administrasi</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">@currency($biayaAdmin)</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
           
             <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Setoran Pinjaman BMT Ke Bank Bulan <b>{{date('F Y', strtotime(now()))}}</b></div> 
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> @currency(totalSetoranBMTKeBank())</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Setoran BMT Wajib Ke Bank Bulan <b>{{date('F Y', strtotime(now()))}}</b></div> 
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> @currency(uangBMTBulanIni())</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                            </div>
                        </div> 
                    </div>
                </div>
            </div> 
             <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Setoran Wadiah Ke Bank Bulan <b>{{date('F Y', strtotime(now()))}}</b></div> 
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> @currency(uangWadiahBulanIni())</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-xl-12 col-md-12 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pinjaman Yang Diberikan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> @currency($infoPinjaman->total_pinjaman)</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
             <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Sisa Pinjaman</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> (- @currency($infoPinjaman->total_pinjaman - $totalPinjamanDiabayar->total_pinjaman_dibayar))</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
             <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Penarikan Wadiah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">(- @currency(totalWadiahDitarik()))</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
              <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pengeluaran Administrasi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">(- @currency($totalPengeluaranADM))</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Sisa Dana BMT</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">@currency(($infoBmt->nominal_bmt) - (($infoPinjaman->total_pinjaman - $totalPinjamanDiabayar->total_pinjaman_dibayar)) )</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
             <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Sisa Dana Wadiah</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">@currency($infoBmt->nominal_wadiah)</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Sisa Dana Administrasi</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">@currency($biayaAdmin - $totalPengeluaranADM)</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
   @if (Auth::user()->status == '7' )
   <div class="col-md-12">
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
                        <canvas id="myAreaChart2"></canvas>
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
                        <canvas id="myPieChart2"></canvas>
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
</div>
   @endif
</div>

@else
    @if (cekKeanggotaanBmt()==1)
    <div class="row">
       
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a type="button" href="{{url('/detail-setoran-bmt-view',[$infoBmt->id_anggota_bmt])}}">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Tabungan BMT</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">@currency($infoBmt->saldo_bmt??0)</div>
                                </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
               
                </div>
            </div>
        </div>
        
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <a type="button" href="{{url('/detail-setoran-bmt-view',[$infoBmt->id_anggota_bmt])}}">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Tabungan  Wadiah</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">@currency($infoBmt->saldo_wadiah??0)</div>
                            </a>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @endif
@endif
 
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('js/demo/chart-pie-demo.js')}}"></script>
<script>
// var jumlahKaryawan = document.getElementById("jumlahKaryawan").value == "" ? 0 : document.getElementById("jumlahKaryawan").value;
var jumlahKaryawan = {{count($jumlahuser)}};
var AnggotaBmt = {{$anggotaBMT}};
var ctx1 = document.getElementById("myAreaChart2");
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
var ctx2 = document.getElementById("myPieChart2");
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