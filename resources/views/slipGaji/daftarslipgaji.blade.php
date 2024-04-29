<!DOCTYPE html>
<html lang="en">
    <style>
        @media print {
          /* Gaya CSS khusus untuk tampilan cetak */
          /* Misalnya, mengatur elemen yang disembunyikan saat tampilan cetak */
          .no-print {
            display: none;
          }
        }
      </style>
@include('include.heads')
<body id="page-top">
          <!-- Sidebar -->
     @include('include.menu') 
 
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('include.header')
                <!-- End of Topbar -->
                 <div class="container-fluid">
           
                <!-- Begin Page Content -->
                
                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Daftar Slip Gaji Karyawan </h1>
                    @if ($message = Session::get('info'))
                    <div class="alert alert-info alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>    
                      <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('warning'))
                    <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>    
                      <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            @if (Auth::user()->status == '0'||Auth::user()->status == '2')
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Menu
                                        </button>
                                        <div class="dropdown-menu">
                                        {{-- <a class="dropdown-item" href="{{url('formslipgaji')}}">Input Data</a> --}}
                                        <a class="dropdown-item" data-target="#exampleModalimport" data-toggle="modal">Input File Excel</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ url('exporttemplate') }}">Download Template</a>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-10">
                                    <form action="{{url('hapusbanyakdata')}}" id="hapus" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="row">
                                         <div class="col-md-3">
                                            <select class="form-control @error('divisi')is-invalid @enderror" id="type" value="{{ old('divisi') }}"  name="divisi" id="inputGroupSelect01" required>
                                                <option disabled  selected value="0">Piliih Divisi...</option>
                                                <option value="all"{{old('divisi')=="all"? 'selected':''}}>Semua Divisi</option>
                                                <option value="DAYCARE"{{old('divisi')=="DAYCARE"? 'selected':''}}>DAYCARE</option>
                                                <option value="KB-TK"{{old('divisi')=="KB-TK"? 'selected':''}}>KB-TK</option>
                                                <option value="SD"{{old('divisi')=="SD"? 'selected':''}}>SD</option>
                                                <option value="SMP"{{old('divisi')=="SMP"? 'selected':''}}>SMP</option>
                                                <option value="YAYASAN"{{old('divisi')=="YAYASAN"? 'selected':''}}>YAYASAN</option>
                                              </select>
                                            @error('divisi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div> 
                                         <div class="col-md-3">
                                            <select class="form-control @error('bulan')is-invalid @enderror" id="bulan" name="bulan" required>
                                                <option disabled selected value="0">Pilih Bulan...</option>
                                                    <option class="text-capitalize" id="select"  value="01" {{old('bulan')== '01' ? 'selected':''}}>Januari</option>
                                                    <option class="text-capitalize" id="select"  value="02" {{old('bulan')== '02' ? 'selected':''}}>Febuari </option>
                                                    <option class="text-capitalize" id="select"  value="03" {{old('bulan')== '03' ? 'selected':''}}>Maret </option>
                                                    <option class="text-capitalize" id="select"  value="04" {{old('bulan')== '04' ? 'selected':''}}>April </option>
                                                    <option class="text-capitalize" id="select"  value="05" {{old('bulan')== '05' ? 'selected':''}}>Mei </option>
                                                    <option class="text-capitalize" id="select"  value="06" {{old('bulan')== '06' ? 'selected':''}}>Juni </option>
                                                    <option class="text-capitalize" id="select"  value="07" {{old('bulan')== '07' ? 'selected':''}}>Juli </option>
                                                    <option class="text-capitalize" id="select"  value="08" {{old('bulan')== '08' ? 'selected':''}}>Agustus </option>
                                                    <option class="text-capitalize" id="select"  value="09" {{old('bulan')== '09' ? 'selected':''}}>September </option>
                                                    <option class="text-capitalize" id="select"  value="10" {{old('bulan')== '10' ? 'selected':''}}>Oktober </option>
                                                    <option class="text-capitalize" id="select"  value="11" {{old('bulan')== '11' ? 'selected':''}}>November </option>
                                                    <option class="text-capitalize" id="select"  value="12" {{old('bulan')== '12' ? 'selected':''}}>Desember </option>
                                                </select>
                                                @error('bulan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> 
                                        <div class="col-md-3">
                                            <select class="form-control @error('tahun')is-invalid @enderror" id="tahun" name="tahun" required>
                                                <option disabled selected value="0">Pilih Tahun...</option>
                                                    <option id="select"  value="2021" {{old('tahun')== '2021' ? 'selected':''}}>2021 </option>
                                                    <option id="select"  value="2022" {{old('tahun')== '2022' ? 'selected':''}}>2022 </option>
                                                    <option id="select"  value="2023" {{old('tahun')== '2023' ? 'selected':''}}>2023 </option>
                                                    <option id="select"  value="2024" {{old('tahun')== '2024' ? 'selected':''}}>2024 </option>
                                                    <option id="select"  value="2025" {{old('tahun')== '2025' ? 'selected':''}}>2025 </option>
                                                    <option id="select"  value="2026" {{old('tahun')== '2026' ? 'selected':''}}>2026 </option>
                                                    <option id="select"  value="2027" {{old('tahun')== '2027' ? 'selected':''}}>2027 </option>
                                                    <option id="select"  value="2028" {{old('tahun')== '2028' ? 'selected':''}}>2028 </option>
                                                    <option id="select"  value="2029" {{old('tahun')== '2029' ? 'selected':''}}>2029 </option>
                                                 </select>
                                                @error('tahun')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-2" style="padding-top:8px ">
                                            <input  class="check-input @error('centang') is-invalid @enderror" type="checkbox" name="centang" value="y" required {{old('centang')=="y"? 'checked':''}}>
                                            <span>Centang</span>
                                                @error('centang')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                         <div class="col-md-1">
                                            <button type="submit" title="Hapus Banyak Data Sekaligus" id="delete"  class="btn btn-danger btn-user btn-sm"> <i class="far fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                     </form>
                                  </div>
                             </div> 
                            @endif
                         </div>
                         
                        <div class="card-body">
                            <div class="d-flex justify-content-end" data-aos="fade-up" >
                                <span class="small">
                                   <Form action="{{url('search-slipGaji')}}" method="GET">
                                    @csrf
                                    <div class="form-group row ">                                     
                                       <div class="col-sm-8 mb-3 mb-sm-0">
                                          <i class="fas fa-search"></i>
                                      <span>Search</span>
                                          <input id="cari" type="text" value="{{$cari}}"  class=" form-control form-control-user @error('cari') is-invalid @enderror" name="cari"    placeholder="Search" required  >
                                           @error('cari')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                      </div>
                                      <div class="col-sm-4 " style="padding-top: 3px"><br>
                                          <span>
                                              <button class="btn btn-info btn-sm"  type="submit">
                                                  <i class="fas fa-search"></i>
                                              </button>
                                           </span>
                                            <span>
                                              <a class="btn btn-sm" style="background-color: rgb(218, 202, 136)" href="{{url('/daftarslipgaji')}}">
                                                <i class="fa fa-times-circle" aria-hidden="true" style="color: white"></i>
                                              </a>
                                           </span>
                                       </div>
                                  </div> 
                                   </Form>
                                 </span>
                              </div>
                            <div class="table-responsive table table-striped">
                                <table class="table-sm table-bordered text-capitalize" id="#" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light"> 
                                            <th>No</th>
                                            <th>Periode</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Divisi / Jabatan</th>
                                            <th>Subtotal Pendapatan</th>
                                            <th>Total Pemotongan</th>
                                            <th>Total Gaji Bersih</th>
                                            <th>Fitur</th>
                                         </tr>
                                    </thead>
                                     <tbody style="font-size: 15px">
                                          @foreach ($datas as $key => $data)
                                          
                                             <tr>
                                                <td>{{$key+=1}}</td>
                                                  <td>{{date('F Y', strtotime($data->periode))}}</td>
                                                  <td>{{$data->nik}}</td>
                                                  <td>{{$data->name}}</td>
                                                  <td>
                                                      {{$data->divisi}} <br>
                                                      {{$data->jabatan}}
                                                   </td>
                                                 <td>@currency($data->subtotal)</td>
                                                 <td>(- @currency($data->potongan))</td>
                                                 <td>@currency($data->total)</td>
                                                 <td class="text-center"> 
                                                    <a type="button" title="Download" onclick="printPage('{{$data->id}}','{{$data->periode}}')" id="print-preview-button" class="btn btn-primary btn btn-sm text-light" target="_blank"  >
                                                        <i class="fa fa-print"></i> 
                                                    </a>
                                                    <a type="button" id="print" title="Detail" class="btn btn-info btn btn-sm text-light" href="{{url('detailslipgaji',[$data->id,$data->periode])}}"    >
                                                        <i class="fas fa-file-alt"></i> 
                                                    </a>
                                                    @if (Auth::user()->status == '0'||Auth::user()->status == '2')
                                                    {{-- <a type="button" id="print" title="Edit"  class="btn btn-primary btn btn-sm text-light" href="{{url('editslip',$data->id_slip)}}">
                                                        <i class="fas fa-edit"></i> 
                                                    </a>  --}}
                                                    <a type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$data->id}}{{$data->periode}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>  
                                                    @endif
                                                   </td>
                                              </tr>
                                         @endforeach
                                     </tbody>
                                </table>
                                <div class="d-flex justify-content-end" data-aos="fade-up" >
                                    <span class="small">
                                        @if ($datas->currentPage()==$datas->lastPage())
                                        Slip Gaji {{$datas->total()}} dari {{$datas->total()}}
                                        {{$datas->links('pagination::bootstrap-4')}}
                                        @else
                                        Slip Gaji {{$datas->count() * $datas->currentPage()}} dari {{$datas->total()}}
                                        {{$datas->links('pagination::bootstrap-4')}}
                                        @endif
                                     
                                     </span>
                                  </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <div class="modal fade" id="exampleModalhapusbanyak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Hapus Data Slip Gaji Ini?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"> Yakin Ingin Menghapus Data Slip Gaji</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{url('/hapusbanyakdata')}}">
                    @csrf
                    @method('DELETE')
                    <input type="text" hidden name="divisi">
                    <input type="text" hidden name="thn">
                    <input type="text" hidden name="bln">
                    <button type="submit" class="btn btn-danger">Yakin</button>
                    </form>
            </div>
          </div>
        </div>
      </div>
      @foreach ($datas as $data)
    <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModalhapus{{$data->id}}{{$data->periode}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Hapus Slip Gaji Ini?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> Yakin Ingin Menghapus Slip Gaji <b class="text-uppercase"> {{$data->name}}</b> Bulan <b class="text-uppercase"> {{date('F Y', strtotime($data->periode))}} </b></div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/hapusslip',[$data->id,$data->periode])}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Yakin</button>
                </form>
        </div>
      </div>
    </div>
  </div>
        
@endforeach
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      <b>{{ __('Logout') }}</b>
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalimport" tabindex="-1" role="dialog" aria-labelledby="exampleModalimport" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Import File Excel?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" id="import" action="{{url('/import')}}" enctype="multipart/form-data"> 
                @csrf
            <div class="modal-body">  
                <span>Status Inputan</span>
                    <select class="custom-select " name="inputan" id="inputGroupSelect01" required>
                        <option value="B">File Baru</option>
                        <option value="F">File Fix</option>
                      </select>                                                
                @error('pernikahan')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <hr>
                 <input id="file" type="file" class="@error('file') is-invalid @enderror" name="file" required >
                @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }} </strong>
                </span>
            @enderror
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" id="go" class="btn btn-danger">Import</button>
             </div>
        </form>
        </div>
    </div>
    </div>
       
    @include('include.scripts')
<!-- Bootstrap core JavaScript-->
<script>
    $(document).ready(function () {
      
    $("button#go").click(function(e){
    e.preventDefault();
        document.getElementById("import").submit();
        $.LoadingOverlay("show");});
    $("button#delete").click(function(e){
    e.preventDefault();
        document.getElementById("hapus").submit();
        $.LoadingOverlay("show");});
    $("button#uploude").click(function(e){
  e.preventDefault();
      document.getElementById("form").submit();
      $.LoadingOverlay("show");
  });

 })
 function printPage(id,date) {
    // document.getElementById('print-preview-button').addEventListener('click', function() {
    // Buka halaman pratinjau cetak dalam jendela baru
    var url = "{{ url('SlipGajiPdf') }}"+"/"+id+"/"+date;
    var printWindow = window.open(url, '_blank');
    
    // Tunggu jendela baru selesai memuat
    printWindow.onload = function() {
      // Tampilkan pratinjau cetak
      printWindow.print();
    };
//   });
}
 
</script> 
</body>

</html>