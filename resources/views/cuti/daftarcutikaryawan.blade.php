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
                <!-- End of Topbar -->
                 <div class="container-fluid">
                
            </div>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Daftar Cuti Karyawan </h1>
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
                         </div>
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th style="width: 30px">No</th>
                                            <th style="width: 150px">Tanggal Surat</th>
                                            <th style="width: 300px">Info Cuti</th>
                                            <th style="width: 700px">Keterangan</th>
                                            <th>File</th>
                                            <th>Download</th>
                                         </tr>
                                    </thead>
                                    
                                     <tbody>
                                          @foreach ($datauser as $key => $datas)
                                            
                                             <tr>
                                                <td class="text-center">
                                                    {{$key += 1}}
                                                </td>
                                                <td> {{date('d F Y ', strtotime($datas->tgl_surat))}}</td>
                                                <td>
                                                    {{$datas->users->name??""}} <br>
                                                    {{$datas->users->divisi??""}} <br>
                                                    {{$datas->cuti->jenis??""}} <br>
                                                    {{$datas->jumlah}} Hari <br>
                                                    {{date('d F Y ', strtotime($datas->tgl_mulai))}} -  {{date('d F Y ', strtotime($datas->tgl_akhir))}}
                                                </td>
                                                 <td>
                                                    <p class="">
                                                        {{$datas->ket}}
                                                    </p>
                                                </td>
                                                 <td  class="text-center">
                                                     @if ($datas->file=='-')
                                                     <i class="fas fa-file-pdf"></i> <br>
                                                     Not Found
                                                     @else
                                                     <a type="button"  class="btn btn-primary btn btn-sm text-light" href="{{url('/file/',$datas->file)}}" target="_blank" download="{{$datas->file}}" >
                                                        <i class="fas fa-cloud-download-alt"></i> 
                                                    </a>
                                                     @endif
                                                </td> 
                                                <td class="text-center"> 
                                                    <a type="button" id="print" title="Download" class="btn btn-primary btn btn-sm text-light" href="{{url('generate-pdf',$datas->id_surat)}}" target="_blank"  >
                                                        <i class="fas fa-cloud-download-alt"></i> 
                                                    </a>
                                                    @if (Auth::user()->status =='0' || Auth::user()->status =='10')
                                                    <a type="button" title="Edit"  class="btn btn-primary btn btn-sm text-light" href="{{url('/editsuratcutidisetujui',$datas->id_surat)}}">
                                                        <i class="far fa-edit"></i> 
                                                    </a>  
                                                    <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$datas->id_surat}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button> 
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
        <div class="modal-body"> Yakin Ingin Menghapus Surat <b class="text-uppercase"> {{$datas->no_surat}} </b> </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/hapusSuratadmin',$datas->id_surat)}}">
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