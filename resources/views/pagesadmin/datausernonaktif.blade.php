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
                    <h1 class="h3 mb-2 text-gray-800">Data Karyawan</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            @if (Auth::user()->status == 0 || Auth::user()->status == 2)
                            <a type="button" class="btn btn-sm btn-primary " href="{{url('Registrasi')}}"> <h6 class="m-0 font-weight-bold text-light">Tambah Karyawan</h6></a>
                            @endif
                        </div>
                        @if ($message = Session::get('info'))
                        <div class="alert alert-danger alert-block">
                          <button type="button" class="close" data-dismiss="alert">×</button>    
                          <strong>{{ $message }}</strong>
                        </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th>Profile</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Kontak</th>
                                            <th>JK</th>
                                            <th>Alamat</th>
                                            <th>Mulai Bekerja</th>
                                            <th>Pernikahan</th>
                                            <th>Divisi</th>
                                            <th>Jabatan</th>
                                            <th>Status Karyawan</th>
                                            <th>Status</th>
                                            <th class="text-center">Fitur Tersedia</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                         @foreach ($datauser as $datas)
                                         <div class="d-none">
                                        
                                            @if ($datas->status_kerja == '1')
                                                {{$status ='Aktif'}}
                                            @else
                                                {{$status ='Non Aktif'}}
                                            @endif
                                        </div>
                                             <tr>
                                                 <td class="align-text-top"> 
                                                   <div class="sidebar-brand d-flex align-items-center justify-content-center" >
                                                      @if ($datas->foto=='-')
                                                     <img class="img-profile rounded-circle" src="{{asset('img/undraw_profile.svg')}}" height="70" width="70"  >
                                                        @else
                                                        <img class="img-profile rounded-circle" src="{{asset('img_profil/'.$datas->foto)}}" height="70"  width="70" style="object-fit: cover">
                                                    @endif
                                                    </div>
                                                 </td>
                                                 <td>{{$datas->nik}}</td>
                                                 <td>{{$datas->name}}</td>
                                                 <td>
                                                    {{$datas->email}} <br>
                                                    {{$datas->no_hp}}
                                                </td>
                                                 <td>{{$datas->jk}}</td>
                                                 
                                                 <td>{{$datas->alamat}}</td>
                                                 <td>{{$datas->tgl_mulai_bekerja}}</td>
                                                 <td>{{$datas->pernikahan}}</td>
                                                 <td>{{$datas->divisi}}</td>
                                                 <td>{{$datas->jabatan}}</td>
                                                 <td>{{$datas->status_karyawan}}</td>
                                                 <td><a class="btn btn-success btn btn-sm" type="button"> <i class="fas fa-user-alt-slash"></i> {{$status}}</a></td>
                                                 <td class="text-center">                                                    
                                                    <a type="button" title="Aktif" class="btn-success btn-sm" data-toggle="modal" data-target="#exampleModalnonaktif{{$datas->id}}">
                                                        <i class="fas fa-check-circle"></i>
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
    @foreach ($datauser as $datas)
    <div class="modal fade" id="exampleModalnonaktif{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Aktifkan Karyawan Ini?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"> Yakin Ingin Aktifkan Karyawan <b class="text-uppercase"> {{$datas->name}} </b> </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{url('/aktif',$datas->id)}}">
                    @csrf
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