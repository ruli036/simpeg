<!DOCTYPE html>
<html lang="en">
    
@include('include.heads')
    
<body id="page-top">
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
                               
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
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
                                            <form id="user" class="user" method="POST" action="{{ url('DaftarUser') }}">
                                                @csrf
                                            <div class="form-group">
                                                <i class="fas fa-user"></i>
                                                <span>Nama</span>
                                                     <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nama">
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>  
                                            <div class="form-group">
                                                <i class="fas fa-fw fa-cog"></i>
                                                <span>Nomor NIK</span>
                                                    <input id="nik" type="number" class="form-control form-control-user @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}"  placeholder="Nomor NIK" required >
                                            @error('nik')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div> 
                                             <div class="form-group">
                                                <i class="fas fa-fw fa-cog"></i>
                                                <span>Nomor NUPTK</span>
                                                    <input id="nuptk" type="text" class="form-control form-control-user @error('nuptk') is-invalid @enderror" name="nuptk" value="{{ old('nuptk') }}"  placeholder="Nomor NUPTK" required >
                                            @error('nuptk')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div> 
                                            <i class="fas fa-venus-mars"></i>
                                            <span>Jenis Kelamin</span>
                                            <div class="form-group row mx-5">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input class="form-check-input @error('jk') is-invalid @enderror" type="radio" name="jk" required ="inlineRadio1" value="P">
                                                    <span>Perempuan</span>
                                                    @error('jk')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                                <div class="col-sm-6 ">                                                  
                                                    <input class="form-check-input @error('jk') is-invalid @enderror" type="radio" name="jk" required id="inlineRadio1" value="L">
                                                    <span>Laki-Laki</span>
                                                    @error('jk')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                               
                                            </div>
                                            <div class="form-group">
                                                <i class="fas fa-envelope-square"></i>
                                                <span>Email</span>
                                                     <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="Email Address" required autocomplete="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div> 
                                            
                                            <div class="form-group">
                                                <i class="fas fa-calendar-week"></i>
                                                <span>Tanggal Mulai Bekerja</span>
                                                    <input id="tgl_mulai_bekerja" type="date" class="form-control form-control-user @error('tgl_mulai_bekerja') is-invalid @enderror" name="tgl_mulai_bekerja" value="{{ old('tgl_mulai_bekerja') }}"  placeholder="Username" required autocomplete="username">
                                            @error('tgl_mulai_bekerja')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control @error('lulusan')is-invalid @enderror" id="type" name="lulusan"   id="inputGroupSelect01" required>
                                                  <option disabled selected value="0">Lulusan...</option>
                                                  <option value="SMA"{{old('lulusan')=="SMA"? 'selected':''}}>SMA</option>
                                                  <option value="STM"{{old('lulusan')=="STM"? 'selected':''}}>STM</option>
                                                  <option value="SMK"{{old('lulusan')=="SMK"? 'selected':''}}>SMK</option>
                                                  <option value="MAN"{{old('lulusan')=="MAN"? 'selected':''}}>MAN</option>
                                                  <option value="D2"{{old('lulusan')=="D2"? 'selected':''}}>D2</option>
                                                  <option value="D3"{{old('lulusan')=="D3"? 'selected':''}}>D3</option>
                                                  <option value="D4"{{old('lulusan')=="D4"? 'selected':''}}>D4</option>
                                                  <option value="S1"{{old('lulusan')=="S1"? 'selected':''}}>S1</option>
                                                  <option value="S2"{{old('lulusan')=="S2"? 'selected':''}}>S2</option>
                                                  <option value="S3"{{old('lulusan')=="S3"? 'selected':''}}>S3</option>
                                                  <option value="Dayah"{{old('lulusan')=="Dayah"? 'selected':''}}>Dayah</option>
                                                </select>
                                                @error('lulusan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                              @enderror
                                              </div>    
                                             
                                              <div class="form-group">
                                                <select class="form-control @error('divisi')is-invalid @enderror" id="type" value="{{ old('divisi') }}"  name="divisi" id="inputGroupSelect01" required>
                                                  <option disabled  selected value="0">Piliih Divisi...</option>
                                                  <option value="DAYCARE"{{old('divisi')=="DAYCARE"? 'selected':''}}>DAYCARE</option>
                                                  <option value="KB-TK"{{old('divisi')=="KB-TK"? 'selected':''}}>KB-TK</option>
                                                  <option value="SD"{{old('divisi')=="SD"? 'selected':''}}>SD</option>
                                                  <option value="SMP"{{old('divisi')=="SMP"? 'selected':''}}>SMP</option>
                                                  <option value="YAYASAN"{{old('divisi')=="YAYASAN"? 'selected':''}}>YAYASAN</option>
                                                </select>
                                              </div>
                                              @error('divisi')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                               <div class="form-group">
                                                <select class="form-control @error('status_karyawan')is-invalid @enderror" id="type"  value="{{ old('status_karyawan') }}"  name="status_karyawan" id="inputGroupSelect01" required>
                                                  <option disabled  selected value="0">Status Karyawan... </option>
                                                  <option value="GTY"{{old('status_karyawan')=="GTY"? 'selected':''}}>Guru Tetap Yayasan</option>
                                                  <option value="GTTY"{{old('status_karyawan')=="GTTY"? 'selected':''}}>Guru Tidak Tetap Yayasan</option>
                                                  <option value="GL"{{old('status_karyawan')=="GL"? 'selected':''}}>Guru Lepas Yayasan</option>
                                                  <option value="KTY"{{old('status_karyawan')=="KTY"? 'selected':''}}>Karyawan Tetap Yayasan</option>
                                                  <option value="KTTY"{{old('status_karyawan')=="KTTY"? 'selected':''}}>Karyawan Tidak Tetap Yayasan</option>
                                                  <option value="TR"{{old('status_karyawan')=="TR"? 'selected':''}}>Training</option>
                                                </select>
                                              </div>
                                              @error('status_karyawan')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                          @enderror
                                              <div class="form-group">
                                                <select class="form-control text-capitalize @error('jabatan')is-invalid @enderror" id="type" name="jabatan" id="inputGroupSelect01" required>
                                                    <option disabled selected value="0">Piliih Jabatan...</option>
                                                    @foreach ($jabatan as $item)
                                                    <option class="text-capitalize" value="{{$item->id_jabatan}}" {{old('jabatan')== $item->id_jabatan ? 'selected':''}}>{{$item->jabatan}}</option>
                                                    @endforeach
                                                 </select>
                                              </div>
                                              @error('jabatan')
                                              <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                              </span>
                                            @enderror
                                        
                                            <button id="go" type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Register Account') }}
                                            </button>
                                        </form>
                                        <hr>
                                        
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

    @include('include.scripts')
   <script>
        $(document).ready(function () {
        $("button#go").click(function(e){
        e.preventDefault();
            document.getElementById("user").submit();
            $.LoadingOverlay("show");
        
    });
    $("button#uploude").click(function(e){
     e.preventDefault();
         document.getElementById("form").submit();
         $.LoadingOverlay("show");
     });
                    
        });
  </script>
</body>

</html>
