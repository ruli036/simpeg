<!DOCTYPE html>
<html lang="en">

@include('include.heads')

<body id="page-top">
          <!-- Sidebar -->
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
                    <h1 class="h3 mb-2 text-gray-800">Daftar Anggota BMT Aktif</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            @if ($message = Session::get('warning'))
                            <div class="alert alert-danger alert-block">
                              <button type="button" class="close" data-dismiss="alert">×</button>    
                              <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            @if ($message = Session::get('info'))
                            <div class="alert alert-info alert-block">
                              <button type="button" class="close" data-dismiss="alert">×</button>    
                              <strong>{{ $message }}</strong>
                            </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th>Profile</th>
                                            <th>NIK</th>
                                            <th>INFO</th>
                                            <th>No Rekening</th>
                                            <th>Divisi</th>
                                            <th>Tabungan BMT</th>
                                            <th>Tabungan Wadiah</th>
                                            <th>Total Penarikan Wadiah</th>
                                            <th class="text-center">#</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                         @foreach ($data as $key => $datas)
                                             <tr class=" bg-danger text-light">
                                                <td class="align-text-top"> 
                                                    <div class="sidebar-brand d-flex align-items-center justify-content-center" >
                                                       @if ($datas->foto=='-')
                                                      <img class="img-profile rounded-circle" src="{{asset('img/undraw_profile.svg')}}" height="50" width="50" >
                                                         @else
                                                         <img class="img-profile rounded-circle" src="{{asset('img_profil/'.$datas->foto)}}"  height="50" width="50" style="object-fit: cover">
                                                     @endif
                                                     </div>
                                                  </td>
                                                  <td>{{$datas->nik}}</td>
                                                  <td>
                                                     {{$datas->name}} <br>
                                                     {{$datas->jabatan}} <br>
                                                     {{date('d F Y', strtotime($datas->tgl_bergabung))}}
                                                 </td>
                                                  <td>{{$datas->no_rek}}</td>
                                                  <td>{{$datas->divisi}}</td>
                                                  <td>@currency($datas->saldo_bmt)</td>
                                                  <td>@currency($datas->saldo_wadiah)</td>
                                                  <td class="bg-info text-light">@currency($datas->total_penarikan??0)</td>
                                                 <td class="text-center"> 
                                                    <button type="button" title="Aktifkan Anggota" class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#exampleModalAktif{{$datas->id_anggota_bmt}}">
                                                        <i class="fa fa-user-check"></i>
                                                    </button>
                                                    <a class="btn btn-success btn-sm " title="Detail Setoran"  type="button" href="{{url('/detail-setoran-bmt-view',[$datas->id_anggota_bmt])}}">
                                                        <i class="fas fa-list-alt"></i>
                                                    </a>

                                                 </td>
                                             </tr>
                                         @endforeach
                                     </tbody>
                                      <tfoot>
                                        <tr>
                                            <th colspan="6">
                                            total Dana BMT
                                            </th>
                                        <th>
                                            @currency($totalUangBMT)
                                        </th>
                                        <th>
                                            @currency($totalUangWadiah - $totalPenarikan)
                                        </th>
                                        <th>
                                            @currency($totalPenarikan)
                                        </th>
                                        </tr>

                                   
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
    @foreach ($data as $datas)
  
  <div class="modal fade" id="exampleModalAktif{{$datas->id_anggota_bmt}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Aktifkan Kembali Anggota?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body text-capitalize">  atas nama <b class="text-uppercase"> {{$datas->name}}</b> Seluruh dana tabungan akan di aktifkan kembali  </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/aktifkan-anggota-bmt',$datas->id_anggota_bmt)}}">
                @csrf
                <button type="submit" class="btn btn-success">Yes</button>
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
</body>

</html>