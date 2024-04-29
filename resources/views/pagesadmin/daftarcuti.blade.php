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


                <!-- Begin Page Content -->
                <div class="container-fluid">
                     <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Daftar Jenis Cuti</h1>
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a type="button" class="btn btn-sm btn-primary " href="{{url('halamantambahjeniscuti')}}"> <h6 class="m-0 font-weight-bold text-light">Tambah Jenis Cuti</h6></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th>No</th>
                                            <th>Jenis Cuti</th>
                                            <th>Maksimal Cuti</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Rekomendasi</th>
                                            <th>Kategori</th>
                                            <th>Kategori karyawan</th>
                                            <th>Sesi</th>
                                            <th class="text-center">Fitur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <div class="d-none">{{$no=1}}</div>
                                        @foreach ($datas as $data)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$data->jenis}}</td>
                                            <td>{{$data->jumlah_hari}} Hari</td>
                                            <td>{{$data->jk}}</td>
                                            <td>
                                                @if ($data->file=='1')
                                                    Dibutuhkan Rekomendasi
                                                @else
                                                    Tidak Dibutuhkan Rekomendasi
                                                @endif
                                            </td>
                                            <td>
                                                @if ($data->kategori=='1')
                                                    Khusus Yayasan
                                                @else
                                                    Umum
                                                @endif
                                            </td>
                                            <td>
                                                {{$data->kategori_karyawan}}
                                            </td>
                                            <td> 
                                                @if ($data->sesi=='1')
                                                   Tahunan
                                                @else
                                                    Fleksibel
                                                @endif
                                            </td>
                                            
                                             <td class="text-center">
                                                <a type="button" title="Edit"  class="btn btn-primary btn btn-sm text-light" href="{{url('/halamaneditjeniscuti',$data->id_cuti)}}"> <i class="far fa-edit"></i> </a> 
                                                <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$data->id_cuti}}">
                                                    <i class="far fa-trash-alt"></i>
                                                    </button>
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
  <div class="modal fade" id="exampleModalhapus{{$data->id_cuti}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Hapus Jenis Cuti Ini?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> Yakin Ingin Menghapus Jenis Cuti <b class="text-uppercase"> {{$data->jenis}}? </b> </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/hapusjeniscuti',$data->id_cuti)}}">
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