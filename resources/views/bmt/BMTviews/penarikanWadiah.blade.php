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
                    <h1 class="h3 mb-2 text-gray-800">Daftar Penarikan Wadiah  </h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a type="button" class="btn btn-sm btn-primary " href="{{url('form-pinjaman-view')}}"> <h6 class="m-0 font-weight-bold text-light">Pengajuan </h6></a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Tanggal Pengajuan</th>
                                            <th>Tanggal Disetujui</th>
                                            <th>Nominal Penarikan</th>
                                            <th>Keterangan</th>
                                            <th>Status Penarikan </th>
                                            <th class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                         @foreach ($data as $datas)
                                             <tr>
                                                <td class="text-center">{{$no++}}</td>
                                                 <td>{{$datas->name}}</td>
                                                 <td>{{date('d F Y', strtotime($datas->tgl_pengajuan))}}</td>
                                                 <td>
                                                    @if ($datas->tgl_disetujui != null)
                                                    {{date('d F Y', strtotime($datas->tgl_disetujui))}}
                                                    @else
                                                    -
                                                    @endif
                                                </td>
                                                 <td>@currency($datas->nominal)</td>
                                                 <td style="width: 400px">{{$datas->ket_pengajuan}}</td>
                                                 <td> 
                                                    @if ($datas->setuju1 == '1')
                                                       <div class="btn btn-warning btn-sm" > Diproses</div>
                                                   @elseif($datas->setuju1 == '0') 
                                                       <div class="btn btn-success btn-sm" > Selesai</div>
                                                   @endif
                                                    <br>
                                                    {{$datas->ket1}}
                                                 </td>
                                                 <td class="text-center"> 
                                                    @if ($datas->setuju1 != 0)
                                                    <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$datas->id_penarikan}}">
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
                        <span>Copyright &copy; Your Website 2020</span>
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
    @foreach ($data as $datas)
    <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModalhapus{{$datas->id_penarikan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Hapus Pengajuan Pinjaman?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> Yakin Ingin Menghapus Pengajuan Pinjaman Ini <b class="text-uppercase">{{$datas->ket_pengajuan}}!!!</b>  </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/hapus-penarikan-wadiah',$datas->id_penarikan)}}">
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