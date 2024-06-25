<!DOCTYPE html>
<html lang="en">
    @include('include.heads')
<body id="page-top">
    <!-- Page Wrapper -->
          <!-- Sidebar -->
     @include('include.menu') 
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('include.header')
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Rekap Absensi </h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        @if ($message = Session::get('warning'))
                        <div class="alert alert-danger alert-block">
                          <button type="button" class="close" data-dismiss="alert">×</button>    
                          <strong class="text-capitalize">{{ $message }}</strong>
                        </div>
                        @endif
                        <div class="card-header py-3">
                               
                            <Form action="{{url('rekap-absensi-bulanan')}}" method="GET" id="cari" class="user" >
                                @csrf
                                    <div class="form-group row">
                                            <div class="col-md-4">
                                                <label for="">Dari Tanggal</label>
                                                <input id="mulai" type="date" placeholder="Dari Tanggal" class="form-control form-control-user @error('mulai') is-invalid @enderror" name="mulai" value="{{ $mulai}}"  required >
                                                @error('mulai')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 " >
                                                <label for="">Sampai Tanggal</label>
                                                <input id="akhir" type="date" class="form-control form-control-user @error('akhir') is-invalid @enderror" name="akhir" value="{{ $akhir }}"  required >
                                                @error('akhir')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-2" style="padding-top: 40px">
                                                <button class="btn btn-primary btn-sm btn-block " id="cariAbsen"  type="submit">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </Form>
                                        <div class="col-md-2" style="padding-top: 40px">
                                           
                                                <a id="slipGaji" class="btn btn-info btn-sm btn-block @if($mulai==''&&$akhir=='') disabled @endif "  type="button" href="{{url('/export-rekap-absensi',[$mulai,$akhir,Auth::user()->divisi])}}" >
                                                    <i class="fas fa-file-export"> </i>Export Detail Absensi
                                                </a>
                                            @if (Auth::user()->status == 2 || Auth::user()->status == 0)
                                                <a class="btn btn-info btn-sm btn-block @if($mulai==''&&$akhir=='') disabled @endif "  type="button" href="{{url('/format-slip-gaji',[$mulai,$akhir])}}">
                                                <i class="fas fa-file-export"> </i>Format Slip Gaji
                                            </a>
                                            @endif
                                            
                                    </div>
                                    </div>
                               
                                
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th width='2%' class="text-center">No</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>JK</th>
                                            <th>Divisi</th>
                                            <th>Kehadiran</th>
                                            <th>Total Telat Masuk  </th>
                                            <th>Total Telat Siang </th>
                                            <th>Pulang Awal</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                         @foreach ($data as $key => $datas)
                                             <tr>
                                                  
                                                 <td> {{$key += 1}}</td>
                                                 <td>{{$datas->nik}}</td>
                                                 <td>{{$datas->name}} <br>
                                                    {{$datas->jabatan}}
                                                </td>
                                                 <td>{{$datas->jk}}</td>
                                                 <td>{{$datas->divisi}}</td>
                                                 <td>
                                                    {{$datas->total_kehadiran??'0' }} <br>
                                                </td>
                                                 <td class="@if ($datas->total_terlambat != 0)bg-warning text-light @endif">
                                                    @if ($datas->total_terlambat != 0)
                                                     {{totalTerlambat($datas->total_terlambat)}}
                                                    @else
                                                        0 seconds
                                                    @endif
                                                </td>
                                                 <td class="@if ($datas->total_telat_siang != 0)bg-warning text-light @endif">
                                                    @if ($datas->total_telat_siang != 0)
                                                     {{totalTerlambat($datas->total_telat_siang)}}
                                                    @else
                                                        0 seconds
                                                    @endif
                                                </td>
                                                 <td class="@if ($datas->total_cepat_pulang != 0)bg-warning text-light @endif">
                                                     @if ($datas->total_cepat_pulang != 0)
                                                         {{totalTerlambat($datas->total_cepat_pulang)}}
                                                     @else
                                                         0 seconds
                                                     @endif
                                                     
                                                </td>
                                                 <td>
                                                    @if ($datas->total_kehadiran != 0)
                                                    <a class="btn btn-success btn-sm btn-block"  type="button"  href="{{url('/detail-absensi-karyawan-view',[$datas->id_absensi_karyawan,$mulai,$akhir])}}">
                                                        <i class="fas fa-list-alt"></i>
                                                    </a>
                                                     @endif
                                                  
                                                 </td>
                                             </tr>
                                         @endforeach
                                     </tbody>
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

    @include('include.scripts')
    <script>
        $(document).ready(function () {
          
        $("button#detailAbsen").click(function(e){
        e.preventDefault();
            document.getElementById("detail").submit();
            $.LoadingOverlay("show");});
    
        $("button#slipGaji").click(function(e){
      e.preventDefault();
          document.getElementById("slip").submit();
          $.LoadingOverlay("show");
      });
      
      $("button#cariAbsen").click(function(e){
      e.preventDefault();
          document.getElementById("cari").submit();
          $.LoadingOverlay("show");
      });
    
     })
          
       
    </script> 
</body>

</html>