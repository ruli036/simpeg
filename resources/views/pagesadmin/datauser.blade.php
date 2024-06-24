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
                        <div class="card-header py-3 row">
                            <div class="col-md-8">
                                @if (Auth::user()->status == 0 || Auth::user()->status == 2)
                                    <a type="button" class="btn btn-sm btn-primary " href="{{url('Registrasi')}}">
                                        <h6 class="m-0 font-weight-bold text-light">Tambah Karyawan</h6>
                                    </a>
                                @endif
                            </div>
                            <div class="col-md-4 ml-auto">
                                <!--<form action="{{url('searchuser')}}" autocomplete="on" class="text-end">-->
                                <!--    <div class="row">-->
                                <!--        <div class="col-md-10">-->
                                <!--            <input type="text" name="cari"  value="<?=$keyword?>" class="form-control" placeholder="Pencarian">-->
                                <!--        </div>-->
                                <!--        <div class="col-md-2">-->
                                <!--            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i></button>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</form>-->
                            </div>
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
                                            <th>Status Kerja</th>
                                            @if (Auth::user()->status == 0)
                                            <th>Status LMS</th>
                                            <th>Status NSE</th>
                                            @endif
                                            <th class="text-center">Fitur Tersedia</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                         @foreach ($datauser as $datas)
                                         <div class="d-none">
                                        
                                            @if ($datas->status_kerja == '1')
                                                {{$status ='Aktif'}}
                                            @else
                                                {{$status ='NONAKTIF'}}
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
                                                 <td class="text-center"><a class="btn btn-success btn btn-sm" type="button"> {{$status}}</a></td>
                                                 @if (Auth::user()->status == 0)
                                                 <td class="text-center">
                                                    @if(Auth::user()->status == 0)
                                                        @if ($datas->sts_lms == 'N')
                                                        <a class="btn btn-success btn btn-sm" type="button"  data-toggle="modal" data-target="#aadUserLMS{{$datas->id}}"> <i class="fas fa-plus"></i></a>
                                                        @elseif($datas->sts_lms == 'K')
                                                        <a class="btn btn-info btn btn-sm" type="button"  data-toggle="modal" data-target="#aktifkanUserLMS{{$datas->id}}"> <i class="fa fa-check-circle-o" aria-hidden="true"></i></a>
                                                        @else
                                                        <a class="btn btn-warning btn btn-sm" type="button"  data-toggle="modal" data-target="#nonAktifkanUserLMS{{$datas->id}}"> <i class="fas fa-minus-circle"></i></a>
                                                        @endif
                                                        @else
                                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                        <br>
                                                        Empty
                                                    @endif
                                                 </td>
                                                 <td class="text-center">
                                                    @if(Auth::user()->status == 0)
                                                        @if (in_array($datas->stts_nse,['N','D']))
                                                        <a class="btn btn-success btn btn-sm" type="button"  data-toggle="modal" data-target="#aadUserNSE{{$datas->id}}">  <i class="fas fa-plus"></i></a>
                                                        @else
                                                        <a class="btn btn-danger btn btn-sm" type="button"  data-toggle="modal" data-target="#nonAktifkanUserNSE{{$datas->id}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        @endif
                                                        @else
                                                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                        <br>
                                                        Empty
                                                    @endif
                                                 </td>
                                                @endif                                                 
                                                 <td class="text-center">                                                    
                                                    @if (Auth::user()->status == 2)
                                                    <a type="button" title="Edit"  class="btn btn-primary btn btn-sm text-light" href="{{url('/profile2',$datas->id)}}">
                                                        <i class="far fa-edit"></i> </a> 
                                                    <button type="button" title="Reset Password" class="btn btn-warning btn btn-sm" data-toggle="modal" data-target="#exampleModalresetPass{{$datas->id}}">
                                                        <i class="fas fa-user-lock"></i>
                                                    </button>  
                                                    <hr> 
                                                     <button type="button" title="Nonaktif" class="btn btn-warning btn btn-sm" data-toggle="modal" data-target="#exampleModalnonaktif{{$datas->id}}">
                                                        <i class="fas fa-minus-circle"></i>
                                                    </button> 
                                                    
                                                    @elseif(Auth::user()->status == 0)
                                                    <a type="button" title="Edit"  class="btn btn-primary btn btn-sm text-light" href="{{url('/profile2',$datas->id)}}">
                                                        <i class="far fa-edit"></i> </a> 
                                                    <button type="button" title="Reset Password" class="btn btn-warning btn btn-sm" data-toggle="modal" data-target="#exampleModalresetPass{{$datas->id}}">
                                                        <i class="fas fa-user-lock"></i>
                                                    </button>  
                                                    <hr> 
                                                     <button type="button" title="Nonaktif" class="btn btn-warning btn btn-sm" data-toggle="modal" data-target="#exampleModalnonaktif{{$datas->id}}">
                                                        <i class="fas fa-minus-circle"></i>
                                                    </button> 
                                                    <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$datas->id}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                    @else
                                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                     <br>
                                                     Empty
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
  <div class="modal fade" id="exampleModalhapus{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Hapus Data Karyawan?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> Yakin Ingin Menghapus Karyawan <b class="text-uppercase"> {{$datas->name}} </b> </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/hapususer',$datas->id)}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Yakin</button>
                </form>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="aadUserLMS{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Daftarkan User Untuk Akun LMS?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> User Dengan Nama <b class="text-uppercase"> {{$datas->name}} </b> Akan Di Daftarkan Pada Akun Learning Management System  </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="get" action="{{url('/daftar-lms',$datas->id)}}">
                @csrf
                <button type="submit" class="btn btn-success">Daftarkan</button>
                </form>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="aadUserNSE{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Daftarkan User Untuk Akun NSE?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> User Dengan Nama <b class="text-uppercase"> {{$datas->name}} </b> Akan Di Daftarkan Pada Akun New Enrolment Student 
            <form method="get" action="{{url('/daftar nse',$datas->id)}}">
                @csrf
                <b>Role</b>
                <div class="form-group">
                    <select class="form-control" id="type" name="role" id="inputGroupSelect01" required>
                      <option value="2">User</option>
                      <option value="1">Admin</option>
                      <option value="3">Mananger</option>
                    </select>
                  </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            
                <button type="submit" class="btn btn-success">Daftarkan</button>
                </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="nonAktifkanUserLMS{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">User LMS Akan Di Non Aktifkan?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> User Dengan Nama <b class="text-uppercase"> {{$datas->name}} </b> Akan Di Non Aktifkan Pada Akun Learning Management System  </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="get" action="{{url('/nonAktifkanUserLMS-lms',$datas->id)}}">
                @csrf
                <button type="submit" class="btn btn-danger">Non Aktifkan</button>
                </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="nonAktifkanUserNSE{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">User NSE Akan Di Non Aktifkan?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> User Dengan Nama <b class="text-uppercase"> {{$datas->name}} </b> Akan Di Non Aktifkan Pada Akun New Enrolment Student  </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="get" action="{{url('/hapus akun nse',$datas->id)}}">
                @csrf
                <button type="submit" class="btn btn-danger">Non Aktifkan</button>
                </form>
        </div>
      </div>
    </div>
  </div>
   <div class="modal fade" id="aktifkanUserLMS{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">User LMS Akan Di Aktifkan?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> User Dengan Nama <b class="text-uppercase"> {{$datas->name}} </b> Akan Di Aktifkan Pada Akun Learning Management System  </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="get" action="{{url('/aktifkanUserLMS-lms',$datas->id)}}">
                @csrf
                <button type="submit" class="btn btn-danger">Aktifkan</button>
                </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModalnonaktif{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Nonaktifkan Karyawan Ini?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> Yakin Ingin Nonaktifkan Karyawan <b class="text-uppercase"> {{$datas->name}} </b> </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/nonaktif',$datas->id)}}">
                @csrf
                <button type="submit" class="btn btn-danger">Yakin</button>
                </form>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="exampleModalresetPass{{$datas->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="hapus">Reset Password Karyawan Ini?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body"> Yakin Ingin Reset Password Karyawan <b class="text-uppercase"> {{$datas->name}} </b> </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form method="POST" action="{{url('/editpassuser',$datas->id)}}">
                @csrf
                <button type="submit" class="btn btn-danger">Reset</button>
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