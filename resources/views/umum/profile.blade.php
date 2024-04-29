<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="196x196" href="{{asset('img/logo.png')}}">

    <title>{{LEMBAGA}}</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="{{asset('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')}}"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

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
                
                <div class="container">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Profile Account</h1>
                                        </div>
                                        @if ($message = Session::get('warning'))
                                        <div class="alert alert-danger alert-block">
                                          <button type="button" class="close" data-dismiss="alert">×</button>    
                                          <strong>{{ $message }}</strong>
                                        </div>
                                        @endif
                                        @if ($message = Session::get('info'))
                                        <div class="alert alert-primary alert-block">
                                          <button type="button" class="close" data-dismiss="alert">×</button>    
                                          <strong>{{ $message }}</strong>
                                        </div>
                                        @endif
                                            <form id="form" class="user" method="POST" action="{{ url('editprofile') }}">
                                                @csrf
                                                <div class="form-group row ">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-id-badge"></i>
                                                        <span>Nomor NIK</span>
                                                            <input id="nik" type="text" class="form-control form-control-user @error('nik') is-invalid @enderror" name="nik" value="{{$datauser->nik}}" readonly placeholder="Nomor NIK" required >
                                                        @error('nik')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <i class="fas fa-id-card"></i>
                                                        <span>Nomor NUPTK</span>
                                                        <input id="nuptk" type="text" class="form-control form-control-user @error('nuptk') is-invalid @enderror" name="nuptk" value="{{$datauser->nuptk}}" readonly placeholder="Nomor NUPTK" required >
                                                        @error('nuptk')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                                                  
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <i class="fas fa-user"></i>
                                                    <span>Nama</span>
                                                         <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{$datauser->name}}" required placeholder="Nama">
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror    
                                                </div>
                                                <div class="form-group row ">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-user-graduate"></i>
                                                        <span>Lulusan</span>
                                                        <select class="custom-select" name="lulusan" id="inputGroupSelect01" required>
                                                            <option value="SMA" @if ($datauser->lulusan=='SMA') selected @endif>SMA</option>
                                                            <option value="STM"@if ($datauser->lulusan=='STM') selected @endif>STM</option>
                                                            <option value="SMK"@if ($datauser->lulusan=='SMK') selected @endif>SMK</option>
                                                            <option value="MAN"@if ($datauser->lulusan=='MAN') selected @endif>MAN</option>
                                                            <option value="D2"@if ($datauser->lulusan=='D2') selected @endif>D2</option>
                                                            <option value="D3"@if ($datauser->lulusan=='D3') selected @endif>D3</option>
                                                            <option value="D4"@if ($datauser->lulusan=='D4') selected @endif>D4</option>
                                                            <option value="S1"@if ($datauser->lulusan=='S1') selected @endif>S1</option>
                                                            <option value="S2"@if ($datauser->lulusan=='S2') selected @endif>S2</option>
                                                            <option value="S3"@if ($datauser->lulusan=='S3') selected @endif>S3</option>
                                                            <option value="Dayah"@if ($datauser->lulusan=='Dayah') selected @endif>Dayah</option>
                                                        </select>                                                    
                                                        @error('lulusan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <i class="fas fa-envelope-square"></i>
                                                        <span>Email</span>
                                                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{$datauser->email}}"  placeholder="Email Address" required autocomplete="email">
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <i class="fas fa-home"></i>
                                                    <span>Tempat Lahir</span>
                                                        <input id="tempat" type="text" placeholder="Tempat Lahir" class="form-control form-control-user @error('tempat')  is-invalid @enderror" value="{{$datauser->tempat}}" name="tempat" required >
                                                        @error('tempat')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <i class="fas fa-calendar-week"></i>
                                                    <span>Tanggal Lahir</span>
                                                        <input id="tgl_lahir" type="date" placeholder="Tanggal Lahir" class="form-control form-control-user" value="{{date('Y-m-d', strtotime($datauser->tgl_lahir))}}" name="tgl_lahir" required >
                                                        @error('tgl_lahir')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                </div>
                                            </div>
                                            <i class="fas fa-venus-mars"></i>
                                                <span>Jenis Kelamin</span> 
                                            <div class="form-group row mx-5">    
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input class="form-check-input  @error('jk') is-invalid @enderror" type="radio" name="jk" @if ($datauser->jk =='P') checked @endif id="inlineRadio1" value="P">
                                                    <span>Perempuan</span>
                                                    @error('jk')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                                <div class="col-sm-6 ">                                                  
                                                    <input class="form-check-input  @error('jk') is-invalid @enderror" type="radio" name="jk"@if ($datauser->jk =='L') checked @endif  id="inlineRadio1" value="L">
                                                    <span>Laki-Laki</span>
                                                    @error('jk')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                              
                                            </div>
                                            <div class="form-group row ">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <i class="far fa-address-card"></i>
                                                    <span>Jurusan</span>
                                                    <input id="jurusan" type="text" class="form-control form-control-user @error('Jurusan') is-invalid @enderror" name="jurusan" value="{{$datauser->jurusan}}"  placeholder="Jurusan" required >
                                                @error('jurusan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 ">
                                                <i class="fas fa-university"></i>
                                                    <span>Universitas</span>
                                                    <input id="universitas" type="text" class="form-control form-control-user @error('universitas') is-invalid @enderror" name="universitas" value="{{$datauser->universitas}}"  placeholder="Universitas" required >
                                                @error('universitas')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            </div> 
                                            <div class="form-group row ">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <i class="fas fa-calendar-week"></i>
                                                    <span>Tahun Tamat</span>
                                                    <input id="thn_tamat" type="text" class="form-control form-control-user @error('thn_tamat') is-invalid @enderror" name="thn_tamat" value="{{$datauser->thn_tamat}}" required >
                                                @error('thn_tamat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 ">
                                                    <i class="far fa-address-card"></i>
                                                    <span>Status Pernikahan</span>
                                                    <select class="custom-select " name="pernikahan" id="inputGroupSelect01" required>
                                                        <option value="Menikah" @if ($datauser->pernikahan=='Menikah') selected @endif>Menikah</option>
                                                        <option value="Belum Menikah"@if ($datauser->pernikahan=='Belum Menikah') selected @endif>Belum Menikah</option>
                                                        <option value="Bercerai"@if ($datauser->pernikahan=='Bercerai') selected @endif>Bercerai</option>
                                                      </select>                                                
                                                      @error('pernikahan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <i class="fas fa-calendar-week"></i>
                                                    <span>Alamat</span>
                                                    <input id="alamat" type="text" class="form-control form-control-user @error('alamat') is-invalid @enderror" value="{{$datauser->alamat}}" name="alamat" placeholder="Alamat"  required >
                                                    @error('alamat')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <i class="fas fa-mobile-alt"></i>
                                                    <span>Nomor HP</span>
                                                    <input id="hp" type="text" class="form-control form-control-user @error('hp') is-invalid @enderror" value="{{$datauser->no_hp}}" name="hp" placeholder="Nomor HP"  required >
                                                    @error('hp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                
                                                </div>
                                            </div> 
                                            <div class="form-group row ">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <i class="fas fa-calendar-week"></i>
                                                    <span>Divisi</span>
                                                    <input id="divisi" type="text" readonly class="form-control form-control-user @error('divisi') is-invalid @enderror" name="divisi" placeholder="Divisi" value="{{$datauser->divisi}}" required >
                                                    @error('divisi')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <i class="fas fa-user-tie"></i>
                                                    <span>Jabatan</span>
                                                        <input id="jabatan" readonly class="form-control form-control-user @error('jabatan') is-invalid @enderror" name="jabatan" value="{{$datauser->jabatan}}"  placeholder="Jabatan" required >
                                                @error('jabatan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row ">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <i class="fas fa-user-tie"></i>
                                                    <span>Status Karyawan</span>
                                                        <input id="status_karyawan" type="text" class="form-control form-control-user @error('status_karyawan') is-invalid @enderror" name="status_karyawan" value="{{$datauser->status_karyawan}}" readonly  placeholder="Status Karyawan" required >
                                                @error('status_karyawan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                                <div class="col-sm-6 ">
                                                    <i class="fas fa-calendar-week"></i>
                                                    <span>Tanggal Mulai Bekerja</span>
                                                        <input id="tgl_mulai_bekerja"  type="text" readonly class="form-control form-control-user @error('tgl_mulai_bekerja') is-invalid @enderror" name="tgl_mulai_bekerja" value="{{date('Y-m-d', strtotime($datauser->tgl_mulai_bekerja))}}"  placeholder="Tanggal Mulai Bekerja" required >
                                                @error('tgl_mulai_bekerja')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            </div>
                                            <hr>
                                           
                                            <button id="uploude1" type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Simpan Perubahan') }}
                                            </button>
                                        </form>
                                        
                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                </div>
            

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
 
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Kelar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan Tombol "Logout" untuk keluar</div>
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
     <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
     <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 
     <!-- Core plugin JavaScript-->
     <script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
 
     <!-- Custom scripts for all pages-->
     <script src="{{asset('js/sb-admin-2.min.js')}}"></script>
     <script src="{{asset('js/loadingoverlay/loadingoverlay.min.js')}}"></script>

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
