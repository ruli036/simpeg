<!DOCTYPE html>
<html lang="en">
    
@include('include.heads')
<body id="page-top">
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
                                            <h1 class="h4 text-gray-900 mb-4">Tambah Format Surat!</h1>
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
                                            <form id="user" class="user" method="POST" action="{{ url('tambah') }}" enctype="multipart/form-data">
                                                @csrf
                                            <div class="form-group">
                                                <i class="fas fa-home"></i>
                                                <span>Judul</span>
                                                    <input id="judul" type="text" class="form-control form-control-user @error('judul') is-invalid @enderror" name="judul" value="{{ old('judul') }}" required autofocus placeholder="Judul">
                                                    @error('judul')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>  
                                            <i class="fas fa-building"></i>
                                                <span>Divisi</span>
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
                                                <i class="fas fa-address-book"></i>
                                                <span>Alamat</span>
                                                <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10">{{ old('alamat') }}</textarea>
                                            @error('nik')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div> 
                                            <div class="form-group">
                                                <i class="fas fa-phone"></i>
                                                <span>Nomor Telp</span>
                                                    <input id="hp" type="number" class="form-control form-control-user @error('hp') is-invalid @enderror" name="hp" value="{{ old('hp') }}"  placeholder="Nomor hp" required >
                                            @error('hp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div> 
                                            <div class="form-group">
                                                <i class="fas fa-envelope-square"></i>
                                                <span>Email</span>         
                                                    <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="Email Address" required >
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div> 
                                            <div class="form-group">
                                                <i class="fas fa-globe"></i>
                                                <span>Website</span>         
                                                    <input id="web" type="text" class="form-control form-control-user @error('web') is-invalid @enderror" name="web" value="{{ old('web') }}"  placeholder="Website" required >
                                            @error('web')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div> 
                                            <div class="form-group">
                                                <i class="fas fa-calendar-week"></i>
                                                <span>Logo Surat</span><br>
                                                    <input id="logo" type="file" class="  @error('logo') is-invalid @enderror" name="logo" >
                                            @error('logo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                             
                                            <button id="go" type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Tambah Format') }}
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

