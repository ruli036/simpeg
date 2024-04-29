<!DOCTYPE html>
<html lang="en">

@include('include.heads')

<body id="page-top">

    <!-- Page Wrapper -->
    

          <!-- Sidebar -->
     @include('include.menu') 
 
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('include.header')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Daftar Surat Cuti</h1>
                    @if ($message = Session::get('info'))
                    <div class="alert alert-danger alert-block">
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
                            {{-- @if (Auth::user()->status_karyawan == "GTY" ||Auth::user()->status_karyawan == "KTY") --}}
                            <a type="button" class="btn btn-sm btn-primary " href="{{url('halamanajukansurat')}}"> <h6 class="m-0 font-weight-bold text-light">Ajukan Surat </h6></a>
                            {{-- @else
                            <a type="button" data-toggle="modal" data-target="#alert" class="btn btn-sm btn-primary " > <h6 class="m-0 font-weight-bold text-light">Ajukan Surat </h6></a>
                            @endif                        </div> --}}
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th>No</th>
                                            <th>No Surat</th>
                                            <th>Tanggal Surat </th>
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Hari</th>
                                            <th>Sisa</th>
                                            <th style="width: 200px">Keterangan</th>
                                            <th>File</th>
                                            @if (Auth::user()->divisi == 'YAYASAN' && (Auth::user()->status == '6' ||Auth::user()->status == '7'||Auth::user()->status == '10') )
                                            <th style="width: 200px">kabid Umum</th>
                                            <th style="width: 200px">kabid Kepegawaian</th>
                                             @elseif(Auth::user()->status == '3' ||Auth::user()->status == "9")
                                             <th style="width: 200px">kabid Kepegawaian</th>
                                             @elseif(Auth::user()->status == '2' || Auth::user()->status == '5'|| Auth::user()->status == '4' )
                                                
                                             @else
                                                <th style="width: 200px">Kepala Sekolah</th>
                                                <th style="width: 200px">kabid Kepegawaian</th>
                                            @endif
                                            <th style="width: 200px">Keputusan Ketua Yayasan</th>
                                            
                                            <th class="text-center" style="width: 50px">File</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                          @foreach ($datauser as $key => $datas)
                                             <tr>
                                                <td class="text-center">
                                                    {{$key += 1}}
                                                </td>
                                                <td>{{$datas->no_surat}}</td>
                                                 <td>{{$datas->tgl_surat}}</td>
                                                 <td>{{$datas->cuti->jenis}}</td>
                                                 <td style="width: 200px">
                                                    {{date('d F Y ', strtotime($datas->tgl_mulai))}} -
                                                   {{date('d F Y ', strtotime($datas->tgl_akhir))}}
                                                </td>
                                                 <td>{{$datas->jumlah}} Hari</td>
                                                 <td>{{$datas->sisa}} Hari</td>
                                                 <td >
                                                    {{$datas->ket}}
                                                </td>
                                                 <td>
                                                    @if ($datas->file=='-')
                                                        -
                                                    @else
                                                    <a type="button"  class="btn btn-primary btn btn-sm text-light" href="{{url('/file/',$datas->file)}}" target="_blank" download="{{$datas->file}}" >
                                                       <i class="fas fa-cloud-download-alt"></i> 
                                                   </a>
                                                    @endif
                                               </td>
                                            @if (Auth::user()->status == '3' ||Auth::user()->status == "9")
                                               <td>
                                                   @if ($datas->rekom2 == '0')
                                                       <div class="btn btn-warning btn-sm" > Diproses</div>
                                                   @elseif($datas->rekom2 == '1') 
                                                       <div class="btn btn-success btn-sm" > Disetujui</div>
                                                   @elseif($datas->rekom2 == '2')
                                                       <div class="btn btn-danger btn-sm" > Ditolak</div>
                                                   @endif
                                                    <br>
                                                    {{$datas->ket_rekom2}}
                                               </td>
                                               <td>
                                                   @if ($datas->rekom3 == '0')
                                                       <div class="btn btn-warning btn-sm" > Diproses</div>
                                                   @elseif($datas->rekom3 == '1') 
                                                       <div class="btn btn-success btn-sm" > Disetujui</div>
                                                   @elseif($datas->rekom3 == '2')
                                                       <div class="btn btn-danger btn-sm" > Ditolak</div>
                                                   @endif
                                                   <br>
                                                    {{$datas->ket_rekom3}}
                                               </td> 
                                            @elseif(Auth::user()->status == '2' || Auth::user()->status == '5'|| Auth::user()->status == '4')
                                              
                                               <td>
                                                   @if ($datas->rekom3 == '0')
                                                       <div class="btn btn-warning btn-sm" > Diproses</div>
                                                   @elseif($datas->rekom3 == '1') 
                                                       <div class="btn btn-success btn-sm" > Disetujui</div>
                                                   @elseif($datas->rekom3 == '2')
                                                       <div class="btn btn-danger btn-sm" > Ditolak</div>
                                                   @endif
                                                   <br>
                                                    {{$datas->ket_rekom3}}
                                               </td> 
                                            @else
                                               <td>
                                                   @if ($datas->rekom1 == '0')
                                                      <div class="btn btn-warning btn-sm" > Diproses</div>
                                                   @elseif($datas->rekom1 == '1') 
                                                      <div class="btn btn-success btn-sm" > Disetujui</div>
                                                   @elseif($datas->rekom1 == '2')
                                                      <div class="btn btn-danger btn-sm" > Ditolak</div>
                                                   @endif
                                                   <br>
                                                   {{$datas->ket_rekom1}}
                                              </td>
                                              <td>
                                                  @if ($datas->rekom2 == '0')
                                                      <div class="btn btn-warning btn-sm" > Diproses</div>
                                                  @elseif($datas->rekom2 == '1') 
                                                      <div class="btn btn-success btn-sm" > Disetujui</div>
                                                  @elseif($datas->rekom2 == '2')
                                                      <div class="btn btn-danger btn-sm" > Ditolak</div>
                                                  @endif
                                                   <br>
                                                   {{$datas->ket_rekom2}}
                                              </td>
                                              <td>
                                                  @if ($datas->rekom3 == '0')
                                                      <div class="btn btn-warning btn-sm" > Diproses</div>
                                                  @elseif($datas->rekom3 == '1') 
                                                      <div class="btn btn-success btn-sm" > Disetujui</div>
                                                  @elseif($datas->rekom3 == '2')
                                                      <div class="btn btn-danger btn-sm" > Ditolak</div>
                                                  @endif
                                                  <br>
                                                   {{$datas->ket_rekom3}}
                                              </td> 
                                               @endif
                                                  
                                                 <td class="text-center"> 
                                                    <a type="button" id="print" title="Download" class="btn btn-primary btn btn-sm text-light" href="{{url('generate-pdf',$datas->id_surat)}}" target="_blank"  >
                                                        <i class="fas fa-cloud-download-alt"></i> 
                                                    </a>
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
    <div class="modal fade bg-danger" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Akses Tidak Di Izinkan!</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Anda Masih Belum Menjadi Karyawan Tetap Yayasan</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                   
                  </a>
                 </div>
            </div>
        </div>
    </div>
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
<!-- Bootstrap core JavaScript-->
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