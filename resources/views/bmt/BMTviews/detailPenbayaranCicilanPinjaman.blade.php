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
                    <h1 class="h3 mb-2 text-gray-800">Detail Cicilan Pembayara Pinjaman BMT  </h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th>No</th>
                                            <th style="width: 300px">Info</th>
                                            <th>Nominal</th>
                                            <th>Cicilan 1</th>
                                            <th>Cicilan 2</th>
                                            <th>Cicilan 3</th>
                                            <th>Cicilan 4</th>
                                            <th>Cicilan 5</th>
                                            <th>Cicilan 6</th>
                                            <th>Total Bayar</th>
                                            <th>Sisa Pembayaran</th>
                                            <th>Status</th>
                                            @if (Auth::user()->status == 7 ||Auth::user()->status == 0 )
                                                <th >#</th> 
                                            @endif
                                           
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                         @foreach ($data as $datas)
                                             <tr>
                                                <td>{{$no++}}</td>
                                                 <td>
                                                    {{$datas->name}} <br>
                                                    {{$datas->divisi}} / 
                                                    {{$datas->tgl_disetujui}} <br>
                                                    {{$datas->ket_pengajuan}} <br>
                                                </td>
                                                <td>@currency($datas->nominal)</td>
                                                 <td class="@if($datas->cicilan1==0 && $datas->nominal!=$datas->total_bayar ) bg-warning text-light @endif"> {{$datas->tgl1??'-'}} <br> <hr>  @currency($datas->cicilan1) </td>
                                                 <td class="@if($datas->cicilan2==0 && $datas->nominal!=$datas->total_bayar ) bg-warning text-light @endif"> {{$datas->tgl2??'-'}} <br> <hr> @currency($datas->cicilan2??0)</td>
                                                 <td class="@if($datas->cicilan3==0 && $datas->nominal!=$datas->total_bayar ) bg-warning text-light @endif"> {{$datas->tgl3??'-'}} <br> <hr>  @currency($datas->cicilan3??0)</td>
                                                 <td class="@if($datas->cicilan4==0 && $datas->nominal!=$datas->total_bayar ) bg-warning text-light @endif"> {{$datas->tgl4??'-'}} <br> <hr>  @currency($datas->cicilan4??0)</td>
                                                 <td class="@if($datas->cicilan5==0 && $datas->nominal!=$datas->total_bayar ) bg-warning text-light @endif"> {{$datas->tgl5??'-'}} <br> <hr>  @currency($datas->cicilan5??0)</td>
                                                 <td class="@if($datas->cicilan6==0 && $datas->nominal!=$datas->total_bayar ) bg-warning text-light @endif"> {{$datas->tgl6??'-'}} <br> <hr>  @currency($datas->cicilan6??0)</td>
                                                 <td class="@if($datas->nominal!=$datas->total_bayar) bg-info text-light @endif">
                                                    @currency($datas->total_bayar??0)
                                                 </td>
                                                  <td class="@if($datas->nominal!=$datas->total_bayar) bg-info text-light @endif">
                                                     - @currency($datas->nominal - $datas->total_bayar)
                                                 </td>
                                                  <td>
                                                    @if ($datas->sts_pinjaman == 1)
                                                        <div class="btn btn-danger btn-sm" > Belum Lunas</div>
                                                    @else
                                                        <div class="btn btn-success btn-sm" >Lunas</div>
                                                    @endif
                                                </td>
                                                @if (Auth::user()->status == 7 || Auth::user()->status == 0 )
                                                <td>
                                                    <a class="btn btn-primary btn-sm btn-block " title="Bayar Cicilan" type="button" href="{{url('/form-bayar-cicilan-pinjaman',$datas->id_cicilan)}}">
                                                        <i class="fas fa-money-bill"></i>
                                                    </a>

                                                    <button type="button" title="Hapus" class="btn btn-danger btn btn-sm btn-block " data-toggle="modal" data-target="#exampleModalhapus{{$datas->id_pengajuan}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                                @endif
                                             </tr>
                                         @endforeach
                                     </tbody>
                                     <tfoot >
                                        <th colspan="2">
                                            Total Pinjaman
                                        </th>
                                        <th colspan="7">
                                            @currency($totalPinjaman)
                                        </th> 
                                        <th >
                                            @currency($totalbayar)
                                        </th>
                                         <th colspan="2" >
                                            - @currency($totalPinjaman - $totalbayar)
                                        </th>
                                        @if (Auth::user()->status == 7 ||Auth::user()->status == 0 )
                                        <th></th>
                                        @endif
                                        
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
        <div class="modal-body text-capitalize"> Semua data Cicilan Pemabayaran akan Ikut Terhapus, Yakin Ingin Menghapus Data Pinjaman <b class="text-uppercase">{{$datas->name}}!!!</b>  </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/hapus-pinjaman-disetujui',$datas->id_pengajuan)}}">
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