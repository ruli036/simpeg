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
                    <h1 class="h3 mb-2 text-gray-800">Daftar Pinjaman BMT  </h1>
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
                                            <th>Nominal Pengajuan</th>
                                            <th>Keterangan</th>
                                            <th>Pengurus BMT</th>
                                            <th>Ketua Yayasan</th>
                                            <th class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                         @foreach ($data as $datas)
                                             <tr style="background-color:  @if($datas->setuju2 == 0 && $datas->sts_pinjaman == 1) rgb(216, 213, 208) @endif" class="@if($datas->setuju2 == 0 && $datas->sts_pinjaman == 1) text-dark @endif  ">
                                                <td class="text-center">{{$no++}}</td>
                                                <td>{{$datas->name}}</td>
                                                 <td>{{date('d F Y', strtotime($datas->tgl_pengajuan))}}</td>
                                                 <td>@currency($datas->nominal)</td>
                                                 <td>{{$datas->ket_pengajuan}}</td>
                                                 <td> 
                                                    @if ($datas->setuju1 == '1')
                                                       <div class="btn btn-warning btn-sm" >  <i class="fas fa-spinner"></i> Diproses</div>
                                                   @elseif($datas->setuju1 == '0') 
                                                       <div class="btn btn-success btn-sm" >  <i class="fas fa-check-circle"></i>Disetujui</div>
                                                   @elseif($datas->setuju1 == '2')
                                                       <div class="btn btn-danger btn-sm" > <i class="fas fa-minus-circle"></i> Ditolak</div>
                                                   @endif
                                                   
                                                    <br>
                                                    {{$datas->ket1}}
                                                 </td>
                                                  <td> 
                                                    @if ($datas->setuju2 == '1')
                                                        <div class="btn btn-warning btn-sm" >  <i class="fas fa-spinner"></i> Diproses</div>
                                                    @elseif($datas->setuju2 == '0') 
                                                        <div class="btn btn-success btn-sm" >  <i class="fas fa-check-circle"></i>Disetujui</div>
                                                    @elseif($datas->setuju2 == '2')
                                                        <div class="btn btn-danger btn-sm" > <i class="fas fa-minus-circle"></i> Ditolak</div>
                                                    @endif
                                                    <br>
                                                    {{$datas->ket2}}
                                                 </td>
                                                 <td class="text-center" style="width: 300px"> 
                                                    @if ($datas->setuju1 == 0)
                                                    <a type="button" id="print" title="Download" class="btn btn-primary btn btn-sm text-light" href="{{url('download-surat1-bmt')}}" target="_blank"  >
                                                        <i class="fas fa-cloud-download-alt"></i> Pembiayaan
                                                    </a> 
                                                
                                                    <a type="button" id="print" title="Download" class="btn btn-primary btn btn-sm text-light" href="{{url('download-surat2-bmt')}}" target="_blank"  >
                                                        <i class="fas fa-cloud-download-alt"></i> Bebas Pinjaman
                                                    </a>
                                                  @endif
                                                    @if ($datas->setuju1 != 0)
                                                    <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$datas->id_pengajuan}}">
                                                    <i class="far fa-trash-alt"></i>
                                                    </button>  
                                                    @elseif ($datas->setuju2 == 0)
                                                    {{-- <hr> --}}
                                                    <div style="padding-top: 6px">
                                                       <a type="button" id="print" title="Download" class="btn btn-success btn btn-sm text-light" href="{{url('detail-pinjaman-bmt-view',$datas->id_pengajuan)}}">
                                                    <i class="fas fa-list-alt"></i> Detail Pembayaran
                                                    </a>  
                                                    </div>
                                                   
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
  <div class="modal fade" id="exampleModalhapus{{$datas->id_pengajuan}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form method="POST" action="{{url('/hapus-pengajuan-pinjaman',$datas->id_pengajuan)}}">
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