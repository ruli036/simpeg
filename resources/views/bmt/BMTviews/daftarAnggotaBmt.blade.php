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
                           
                            @if (Auth::user()->status == 7 || Auth::user()->status == 0)
                            <div class="row">
                                <div class="col-md-10">
                                      <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Menu
                                        </button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{url('tambah-anggota-view')}}">Add User</a>
                                        <a class="dropdown-item" href="{{url('setoran-view')}}">Input Setoran</a>
                                        <a class="dropdown-item" data-target="#exampleModalimport" data-toggle="modal">Input File Setoran</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ url('template-bmt') }}">Download Template</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <a class="btn btn-success btn-sm " title="Export Laporan BMT" type="button" href="{{url('/export-laporan-bmt')}}">
                                        <h6 class="m-0 font-weight-bold text-light">  <i class="fas fa-file-export"></i> Export Laporan Bulanan </h6>
                                        </a>
    
                                </div>
                            </div>
                            
                           
                            @endif
                            @if ($message = Session::get('warning'))
                            <div class="alert alert-danger alert-block">
                              <button type="button" class="close" data-dismiss="alert">×</button>    
                              <strong>{{ $message }}</strong>
                            </div>
                            @endif
                        @if ($message = Session::get('info'))
                            <div class="alert alert-success alert-block">
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
                                             <tr>
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
                                                 @if (Auth::user()->status == 7 || Auth::user()->status == 0)
                                                 <td class="text-center"> 
                                                    <a class="btn btn-success btn-sm " title="Detail Setoran" type="button" href="{{url('/detail-setoran-bmt-view',[$datas->id_anggota_bmt])}}">
                                                        <i class="fas fa-list-alt"></i>
                                                    </a>
                                                   
                                                    <button type="button" title="Edit Data Anggota BMT" class="btn btn-info btn btn-sm" data-toggle="modal" data-target="#exampleModalEdit{{$datas->id_anggota_bmt}}">
                                                        <i class="fa fa-user-edit"></i>
                                                    </button>
                                                    <hr>
                                                     <button type="button" title="Pengembalian Dana" class="btn btn-dark btn btn-sm" data-toggle="modal" data-target="#exampleModalNonAktif{{$datas->id_anggota_bmt}}">
                                                        <i class="fa fa-user-minus"></i>
                                                    </button>
                                                    @if (Auth::user()->status == 0)
                                                    <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$datas->id_anggota_bmt}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    @endif
                                                 </td>
                                                 @else
                                                 <td class="text-center"> 
                                                    <a class="btn btn-success btn-sm " title="Detail Setoran" type="button" href="{{url('/detail-setoran-bmt-view',[$datas->id_anggota_bmt])}}">
                                                        <i class="fas fa-list-alt"></i>
                                                    </a>
                                                 </td>
                                                 @endif
                                             </tr>
                                         @endforeach
                                     </tbody>
                                      <tfoot>
                                        <tr>
                                            <th colspan="5">
                                            total Dana BMT
                                            </th>
                                        <th>
                                            @currency($totalUangBMT)
                                        </th>
                                        <th>
                                            @currency($totalUangWadiah - $totalPenarikan)
                                        </th>
                                        <th class="bg-info text-light">
                                            @currency($totalPenarikan)
                                        </th>
                                        <th></th>
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
    <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModalhapus{{$datas->id_anggota_bmt}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Hapus Data Anggota?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> Seluruh Riwayat Setoran Juga Akan Di Hapus, Yakin Ingin Menghapus Keanggotaan <b class="text-uppercase"> {{$datas->name}} !!!</b> </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/hapus-anggota-bmt',$datas->id_anggota_bmt)}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Yes</button>
                </form>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="exampleModalNonAktif{{$datas->id_anggota_bmt}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Pengembalian Dana dan Nonaktifkan Anggota?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body text-capitalize">  atas nama <b class="text-uppercase"> {{$datas->name}}</b> Seluruh dana tabungan akan di bekukan  </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/nonaktif-anggota-bmt',$datas->id_anggota_bmt)}}">
                @csrf
                <button type="submit" class="btn btn-success">Yes</button>
                </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="exampleModalEdit{{$datas->id_anggota_bmt}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalEdit" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" >Edit Data Anggota BMT?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <form method="POST" class="user"  action="{{url('/edit-anggota-bmt',$datas->id_anggota_bmt)}}" enctype="multipart/form-data"> 
            @csrf
            {{-- <div class="form-group row "> --}}
                <div class="col-sm-12 mb-6 mb-sm-0">
                    <i class="fas fa-calendar"></i>
                    <span>Mulai Bergabung</span>
                        <input id="tgl_gabung" value="{{$datas->tgl_bergabung}}" type="date" class="form-control form-control-user @error('tgl_gabung') is-invalid @enderror" name="tgl_gabung"  placeholder="Tanggal Bergabung" required >
                         @error('tgl_gabung')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> 
                <div class="col-sm-12 mb-6 mb-sm-0">
                    <i class="fa fa-credit-card"></i>
                    <span>No Rekening</span>
                        <input id="no_rek" value="{{$datas->no_rek}}" type="text" maxlength="20" class="form-control form-control-user @error('no_rek') is-invalid @enderror" name="no_rek"  placeholder="Nomor Rekening" required >
                         @error('no_rek')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            {{-- </div> --}}
            <hr>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Save</button>
         </div>
    </form>
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
                <h5 class="modal-title" >Import File Excel?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" id="import" action="{{url('/import-bmt')}}" enctype="multipart/form-data"> 
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
                <button type="submit" id="go" class="btn btn-danger">Import</button>
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
        $("button#go").click(function(e){
    e.preventDefault();
        document.getElementById("import").submit();
        $.LoadingOverlay("show");});   
        });
     
   </script> 
</body>

</html>