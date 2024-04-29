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
                     <h1 class="h3 mb-2 text-gray-800">Export Laporan BMT Karyawan </h1>
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
                                    {{-- <form action="{{url('export-laporan-bulanan-bmt')}}" method="GET">
                                        @csrf
                                        <input type="text" hidden name="filter" value="{{$filter}}">
                                        <button type="submit" class="btn btn-sm btn-success"> <h6 class="m-0 font-weight-bold text-light">Export</h6></button> 
                                    </form> --}}
                                </div>
                                  <div class="col-md-9">
                                    <form action="{{url('filter-laporan-bmt')}}" method="GET">
                                        @csrf
                                        <div class="row">
                                
                                         <div class="col-md-5">
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
                                        <div class="col-md-5">
                                            <select class="form-control @error('tahun')is-invalid @enderror" id="tahun" name="tahun" required>
                                                <option disabled selected value="0">Pilih Tahun...</option>
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
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Divisi / Jabatan</th>
                                            <th>Bulan</th>
                                            <th>Setoran BMT</th>
                                            <th>Setoran Wadiah</th>
                                         </tr>
                                    </thead>
                                    
                                     <tbody>
                                          @foreach ($datas as $data)
                                            
                                             <tr>
                                                <td>{{$data->anggotabmt->users->nik}}</td>
                                                <td>{{$data->anggotabmt->users->name}}</td>
                                                <td>
                                                    {{$data->anggotabmt->users->divisi}} <br>
                                                    {{$data->anggotabmt->users->jabatan}}
                                                 </td>
                                                <td>{{date('d F Y', strtotime($data->tgl_setor))}}</td>
                                                <td>@currency($data->nominal_bmt)</td>
                                                <td>@currency($data->nominal_wadiah)</td> 
                                              </tr>
                                         @endforeach
                                     </tbody>
                                     <tfoot>
                                        <th colspan="4">
                                            Total Setoran 
                                        </th>
                                        <th>
                                            @currency($totalBmt)
                                        </th>
                                         <th >
                                            @currency($totalWadiah)
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
    @foreach ($datas as $data)
    <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModalhapus{{$data->id_slip}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Hapus Slip Gaji Ini?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> Yakin Ingin Menghapus Slip Gaji <b class="text-uppercase">{{$data->bulan}} {{$data->nama}} </b> </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/hapusslip',$data->id_slip)}}">
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