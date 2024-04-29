<!DOCTYPE html>
<html lang="en">

@include('include.heads')

<body id="page-top">
     @include('include.menu') 
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('include.header')
                <!-- End of Topbar -->
                 <div class="container-fluid">
               
            </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Daftar Surat Pengajuan Cuti  </h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a type="button" class="btn btn-sm btn-primary " href="{{url('halamanajukansurat')}}"> <h6 class="m-0 font-weight-bold text-light">Ajukan Surat </h6></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th>Kategori</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Tanggal Cuti</th>
                                            <th>Hari</th>
                                            <th style="width: 200px">Keterangan</th>
                                            <th>File</th>
                                            @if (Auth::user()->divisi == 'YAYASAN' && (Auth::user()->status == '6' ||Auth::user()->status == '7'||Auth::user()->status == '10') )
                                            <th style="width: 200px">kabid Umum </th>
                                            <th style="width: 200px">kabid Kepegawaian</th>
                                            @elseif(Auth::user()->status == '9'||Auth::user()->status == '3')
                                                <th style="width: 200px">kabid Kepegawaian</th>
                                             @elseif(Auth::user()->status == '2' || Auth::user()->status == '5' || Auth::user()->status == '4' )
                                                
                                             @else
                                                <th style="width: 200px">Kepala Sekolah</th>
                                                <th style="width: 200px">kabid Kepegawaian</th>
                                            @endif
                                            <th style="width: 200px">Keputusan Ketua Yayasan</th>
                                            
                                            <th class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                         @foreach ($datauser as $datas)
                                             <tr>
                                                <td>{{$datas->cuti->jenis}}</td>
                                                 <td>{{date('d F Y', strtotime($datas->tgl_input))}}</td>
                                                 <td>{{date('d F Y', strtotime($datas->tgl_mulai))}} / {{date('d F Y', strtotime($datas->tgl_akhir))}}</td>
                                                 <td>{{$datas->jumlah}} Hari</td>
                                                 <td>{{$datas->ket}}</td>
                                                 <td>
                                                     @if ($datas->file=='-')
                                                         -
                                                     @else
                                                     <a type="button"  class="btn btn-primary btn btn-sm text-light" href="{{url('/file/',$datas->file)}}" target="_blank" download="{{$datas->file}}" >
                                                        <i class="fas fa-cloud-download-alt"></i> 
                                                    </a>
                                                     @endif
                                                </td>
                                                @if (Auth::user()->status == '3'||Auth::user()->status == '9')
                                                <td>
                                                    @if ($datas->rekom2 == '0')
                                                        <div class="btn btn-warning btn-sm" > <i class="fas fa-spinner"></i> Diproses</div>
                                                    @elseif($datas->rekom2 == '1') 
                                                        <div class="btn btn-success btn-sm" > <i class="fas fa-check-circle"></i>Disetujui</div>
                                                    @elseif($datas->rekom2 == '2')
                                                        <div class="btn btn-danger btn-sm" ><i class="fas fa-minus-circle"></i> Ditolak</div>
                                                    @endif
                                                     <br>
                                                     {{$datas->ket_rekom2}}
                                                </td>
                                                <td>
                                                    @if ($datas->rekom3 == '0')
                                                        <div class="btn btn-warning btn-sm" > <i class="fas fa-spinner"></i> Diproses</div>
                                                    @elseif($datas->rekom3 == '1') 
                                                        <div class="btn btn-success btn-sm" > <i class="fas fa-check-circle"></i>Disetujui</div>
                                                    @elseif($datas->rekom3 == '2')
                                                        <div class="btn btn-danger btn-sm" ><i class="fas fa-minus-circle"></i> Ditolak</div>
                                                    @endif
                                                    <br>
                                                     {{$datas->ket_rekom3}}
                                                </td> 
                                                @elseif(Auth::user()->status == '2' || Auth::user()->status == '5'|| Auth::user()->status == '4')
                                               
                                                <td>
                                                    @if ($datas->rekom3 == '0')
                                                        <div class="btn btn-warning btn-sm" > <i class="fas fa-spinner"></i> Diproses</div>
                                                    @elseif($datas->rekom3 == '1') 
                                                        <div class="btn btn-success btn-sm" > <i class="fas fa-check-circle"></i>Disetujui</div>
                                                    @elseif($datas->rekom3 == '2')
                                                        <div class="btn btn-danger btn-sm" ><i class="fas fa-minus-circle"></i> Ditolak</div>
                                                    @endif
                                                    <br>
                                                     {{$datas->ket_rekom3}}
                                                </td> 
                                                @else
                                                <td>
                                                    @if ($datas->rekom1 == '0')
                                                        <div class="btn btn-warning btn-sm" > <i class="fas fa-spinner"></i> Diproses</div>
                                                    @elseif($datas->rekom1 == '1') 
                                                        <div class="btn btn-success btn-sm" > <i class="fas fa-check-circle"></i>Disetujui</div>
                                                    @elseif($datas->rekom1 == '2')
                                                        <div class="btn btn-danger btn-sm" ><i class="fas fa-minus-circle"> </i>Ditolak</div>
                                                    @endif
                                                    <br>
                                                    {{$datas->ket_rekom1}}
                                               </td>
                                               <td>
                                                    @if ($datas->rekom2 == '0')
                                                        <div class="btn btn-warning btn-sm" > <i class="fas fa-spinner"></i> Diproses</div>
                                                    @elseif($datas->rekom2 == '1') 
                                                        <div class="btn btn-success btn-sm" > <i class="fas fa-check-circle"></i>Disetujui</div>
                                                    @elseif($datas->rekom2 == '2')
                                                        <div class="btn btn-danger btn-sm" ><i class="fas fa-minus-circle"></i> Ditolak</div>
                                                    @endif
                                                    <br>
                                                    {{$datas->ket_rekom2}}
                                               </td>
                                               <td>
                                                    @if ($datas->rekom3 == '0')
                                                        <div class="btn btn-warning btn-sm" > <i class="fas fa-spinner"></i> Diproses</div>
                                                    @elseif($datas->rekom3 == '1') 
                                                        <div class="btn btn-success btn-sm" > <i class="fas fa-check-circle"></i>Disetujui</div>
                                                    @elseif($datas->rekom3 == '2')
                                                        <div class="btn btn-danger btn-sm" ><i class="fas fa-minus-circle"></i> Ditolak</div>
                                                    @endif
                                                   <br>
                                                    {{$datas->ket_rekom3}}
                                               </td> 
                                                @endif
                                                 <td class="text-center"> 
                                                    @if((Auth::user()->status == '9' || Auth::user()->status == '3') && $datas->rekom2 == '0')
                                                    <a type="button" title="Edit"  class="btn btn-primary btn btn-sm text-light" href="{{url('/editsuratcuti',$datas->id_surat)}}">
                                                        <i class="far fa-edit"></i> </a>
                                                        <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$datas->id_surat}}">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>  
                                                        
                                                    @elseif((Auth::user()->status == '5' || Auth::user()->status == '2'|| Auth::user()->status == '4') && $datas->rekom3 == '0')
                                                    <a type="button" title="Edit"  class="btn btn-primary btn btn-sm text-light" href="{{url('/editsuratcuti',$datas->id_surat)}}">
                                                        <i class="far fa-edit"></i> </a>
                                                        <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$datas->id_surat}}">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button> 
                                                    @elseif ($datas->rekom1 == '0')
                                                    <a type="button" title="Edit"  class="btn btn-primary btn btn-sm text-light" href="{{url('/editsuratcuti',$datas->id_surat)}}">
                                                    <i class="far fa-edit"></i> </a>
                                                    <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$datas->id_surat}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>   
                                                 
                                                     @endif

                                                     @if ($datas->rekom1 == '2' ||$datas->rekom2 == '2' || $datas->rekom3 == '2')
                                                     <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$datas->id_surat}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>  
                                                     @else
                                                    
                                                    
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
    @foreach ($datauser as $datas)
    <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModalhapus{{$datas->id_surat}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Hapus Surat Ini?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> Yakin Ingin Menghapus Surat <b class="text-uppercase"> {{$datas->kategori_cuti}} </b> </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/hapusSurat',$datas->id_surat)}}">
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