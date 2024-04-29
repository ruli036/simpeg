<!DOCTYPE html>
<html lang="en">
    @include('include.heads')

<body id="page-top">
     @include('include.menu') 
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('include.header')
                <!-- End of Topbar -->
                 <div class="container-fluid">
           
                <!-- Begin Page Content -->
                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Riwayat Import Slip Gaji Karyawan </h1>
                    @if ($message = Session::get('info'))
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
                                <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th>No</th>
                                            <th>Nama File</th>
                                            <th>Tanggal Input</th>
                                            <th class="text-center">Download</th>
                                         </tr>
                                    </thead>
                                    
                                     <tbody>
                                         <div hidden>{{$no = 1}}</div>
                                          @foreach ($datas as $data)
                                          
                                             <tr>
                                                  <td>{{$no++}}</td>
                                                  <td>{{$data->file}}</td>
                                                  <td>{{$data->tgl}}</td>
                                                  <td class="text-center">
                                                    <a type="button"  class="btn btn-primary btn btn-sm text-light" href="{{url('/slipgaji/',$data->file)}}" target="_blank" download="{{$data->file}}" >
                                                        <i class="fas fa-cloud-download-alt"></i> 
                                                    </a>
                                                    @if (Auth::user()->status == '0')
                                                    <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$data->id}}">
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
    @foreach ($datas as $data)
    <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModalhapus{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Hapus Riwayat Import Slip Gaji?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> Yakin Ingin Menghapus Riwayat Import Slip Gaji ini!</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/hapusriwayatimport',$data->id)}}">
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
                <h5 class="modal-title" id="hapus">Import File Excel?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" action="{{url('/ixport')}}" enctype="multipart/form-data"> 
                @csrf
            <div class="modal-body">  
                <input id="file" type="file" class="@error('file') is-invalid @enderror" name="file" required >
                @error('file')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }} </strong>
                </span>
            @enderror
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Import</button>
             </div>
        </form>
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