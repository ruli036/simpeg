<!DOCTYPE html>
<html lang="en">

@include('include.heads')

<body id="page-top">
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
                     <h1 class="h3 mb-2 text-gray-800">Export Slip Gaji Karyawan </h1>
                    @if ($message = Session::get('info'))
                    <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>    
                      <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-3">
                                    @if ($message = Session::get('warning'))
                                    <div class="alert alert-danger alert-block">
                                      <button type="button" class="close" data-dismiss="alert">×</button>    
                                      <strong>{{ $message }}</strong>
                                    </div>
                                    @endif
                                    <form action="{{url('exportslip')}}" method="GET">
                                        @csrf
                                        <input type="text" hidden name="bln" value="{{$bln}}">
                                        <input type="text" hidden name="thn" value="{{$thn}}">
                                        <input type="text" hidden name="divisi" value="{{$divisi}}">
                                        <button type="submit" class="btn btn-sm btn-success"> <h6 class="m-0 font-weight-bold text-light">Export</h6></button> 
                                    </form>
                                </div>
                                  <div class="col-md-9">
                                    <form action="{{url('filter')}}" method="GET">
                                        @csrf
                                        <div class="row">
                                         <div class="col-md-2">
                                            <select class="form-control @error('divisi')is-invalid @enderror" id="type" value="{{ old('divisi') }}"  name="divisi" id="inputGroupSelect01" required>
                                                <option disabled  selected value="0">Piliih Divisi...</option>
                                                <option value="all"{{$divisi=="all"? 'selected':''}}>Semua Divisi</option>
                                                <option value="DAYCARE"{{$divisi=="DAYCARE"? 'selected':''}}>DAYCARE</option>
                                                <option value="KB-TK"{{$divisi=="KB-TK"? 'selected':''}}>KB-TK</option>
                                                <option value="SD"{{$divisi=="SD"? 'selected':''}}>SD</option>
                                                <option value="SMP"{{$divisi=="SMP"? 'selected':''}}>SMP</option>
                                                <option value="YAYASAN"{{$divisi=="YAYASAN"? 'selected':''}}>YAYASAN</option>
                                              </select>
                                            @error('divisi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div> 
                                         <div class="col-md-4">
                                            <select class="form-control @error('bulan')is-invalid @enderror" id="bulan" name="bulan" required>
                                                <option disabled selected value="0">Pilih Bulan...</option>
                                                    <option class="text-capitalize" id="select"  value="01" {{$bln== '01' ? 'selected':''}}>Januari</option>
                                                    <option class="text-capitalize" id="select"  value="02" {{$bln== '02' ? 'selected':''}}>Febuari </option>
                                                    <option class="text-capitalize" id="select"  value="03" {{$bln== '03' ? 'selected':''}}>Maret </option>
                                                    <option class="text-capitalize" id="select"  value="04" {{$bln== '04' ? 'selected':''}}>April </option>
                                                    <option class="text-capitalize" id="select"  value="05" {{$bln== '05' ? 'selected':''}}>Mei </option>
                                                    <option class="text-capitalize" id="select"  value="06" {{$bln== '06' ? 'selected':''}}>Juni </option>
                                                    <option class="text-capitalize" id="select"  value="07" {{$bln== '07' ? 'selected':''}}>Juli </option>
                                                    <option class="text-capitalize" id="select"  value="08" {{$bln== '08' ? 'selected':''}}>Agustus </option>
                                                    <option class="text-capitalize" id="select"  value="09" {{$bln== '09' ? 'selected':''}}>September </option>
                                                    <option class="text-capitalize" id="select"  value="10" {{$bln== '10' ? 'selected':''}}>Oktober </option>
                                                    <option class="text-capitalize" id="select"  value="11" {{$bln== '11' ? 'selected':''}}>November </option>
                                                    <option class="text-capitalize" id="select"  value="12" {{$bln== '12' ? 'selected':''}}>Desember </option>
                                                </select>
                                                @error('bulan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> 
                                        <div class="col-md-4">
                                            <select class="form-control @error('tahun')is-invalid @enderror" id="tahun" name="tahun" required>
                                                <option disabled selected value="0">Pilih Tahun...</option>
                                                    <option id="select"  value="2021" {{$thn== '2021' ? 'selected':''}}>2021 </option>
                                                    <option id="select"  value="2022" {{$thn== '2022' ? 'selected':''}}>2022 </option>
                                                    <option id="select"  value="2023" {{$thn== '2023' ? 'selected':''}}>2023 </option>
                                                    <option id="select"  value="2024" {{$thn== '2024' ? 'selected':''}}>2024 </option>
                                                    <option id="select"  value="2025" {{$thn== '2025' ? 'selected':''}}>2025 </option>
                                                    <option id="select"  value="2026" {{$thn== '2026' ? 'selected':''}}>2026 </option>
                                                    <option id="select"  value="2027" {{$thn== '2027' ? 'selected':''}}>2027 </option>
                                                    <option id="select"  value="2028" {{$thn== '2028' ? 'selected':''}}>2028 </option>
                                                    <option id="select"  value="2029" {{$thn== '2029' ? 'selected':''}}>2029 </option>
                                                 </select>
                                                @error('tahun')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                         <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary btn-user btn-block">FIlter</button>
                                        </div>
                                    </div>
                                     </form>
                                  </div>
                             </div>

                         </div>
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th>No</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Divisi / Jabatan</th>
                                            <th>Periode</th>
                                            <th>Subtotal Pendapatan</th>
                                            <th>Total Pemotongan</th>
                                            <th>Total Gaji Bersih</th>
                                            <th>Fitur</th>
                                         </tr>
                                    </thead>
                                    
                                     <tbody>
                                          @foreach ($datas as $key => $data)
                                            
                                             <tr>
                                                <td>{{$key+=1}}</td>
                                                <td>{{$data->nik}}</td>
                                                <td>{{$data->name}}</td>
                                                <td>
                                                    {{$data->divisi}} <br>
                                                    {{$data->jabatan}}
                                                 </td>
                                                <td>{{date('F Y', strtotime($data->periode))}}</td>
                                                <td>@currency($data->subtotal)</td>
                                                <td>(- @currency($data->potongan))</td>
                                                <td>@currency($data->total)</td>
                                                <td class="text-center"> 
                                                    <a type="button" id="print" title="Detail" class="btn btn-info btn btn-sm text-light" href="{{url('detailslipgaji',[$data->id,$data->periode])}}"    >
                                                        <i class="fas fa-file-alt"></i> 
                                                    </a>
                                                   </td>
                                              </tr>
                                         @endforeach
                                     </tbody>
                                     <tfoot>
                                        <th colspan="7">
                                            Total Gaji Karyawan
                                        </th>
                                        <th colspan="2">
                                            @currency($totalSeluruhGaji)
                                        </th>
                                     </tfoot>
                                </table>
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
     
       
    @include('include.scripts')

<script>
     $(document).ready(function () {
    
    $("button#uploude").click(function(e){
  e.preventDefault();
      document.getElementById("form").submit();
      $.LoadingOverlay("show");
  });
     });
     

</script>
</body>

</html>