<!DOCTYPE html>
<html lang="en">

@include('include.heads')

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
                                
                                 <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Tambah Jenis Cuti!</h1>
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
                                            <form id="user" class="user" method="POST" action="{{ url('simpanjeniscuti') }}" >
                                                @csrf
                                            <div class="form-group">
                                                <i class="fas fa-journal-whills"></i>
                                                <span>Jenis Cuti</span>
                                                    <input id="jenis_cuti" type="text" class="form-control form-control-user @error('jenis_cuti') is-invalid @enderror" name="jenis_cuti" value="{{ old('jenis_cuti') }}" required autofocus placeholder="Jenis Cuti">
                                                    @error('jenis_cuti')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div> 
                                             <div class="form-group">
                                                <i class="fas fa-calendar"></i>
                                                <span>Jumlah Maksimal Cuti</span>
                                                    <input id="max_cuti" type="number" class="form-control form-control-user @error('max_cuti') is-invalid @enderror" name="max_cuti" value="{{ old('max_cuti') }}" required autofocus placeholder="Maksimal Cuti">
                                                    @error('max_cuti')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div> 
                                            <i class="fas fa-transgender-alt"></i>
                                                <span>Set Jenis Kelamin?</span>
                                            <div class="form-group">
                                                <select class="form-control @error('jk')is-invalid @enderror" id="type" value="{{ old('jk') }}"  name="jk" id="inputGroupSelect01" required>
                                                <option disabled  selected value="0">Pilih Salah Satu...</option>
                                                <option value="P"{{old('jk')=="P"? 'selected':''}}>Perempuan </option>
                                                <option value="L"{{old('jk')=="L"? 'selected':''}}>Laki-Laki</option>
                                                <option value="all"{{old('jk')=="all"? 'selected':''}}>Umum</option>
                                            </select>
                                            </div>
                                            @error('jk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror 
                                             <i class="fas fa-file-alt"></i>
                                                <span>Rekomendasi file?</span>
                                            <div class="form-group">
                                                <select class="form-control @error('file')is-invalid @enderror" id="type" value="{{ old('file') }}"  name="file" id="inputGroupSelect01" required>
                                                <option disabled  selected value="0">Pilih Salah Satu...</option>
                                                <option value="0"{{old('file')=="0"? 'selected':''}}>Tidak Dibutuhkan </option>
                                                <option value="1"{{old('file')=="1"? 'selected':''}}>Dibutuhkan</option>
                                            </select>
                                            </div>
                                            @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror 
                                             <i class="fas fa-sort"></i>
                                                <span>Kategori Cuti</span>
                                            <div class="form-group">
                                                <select class="form-control @error('kategori')is-invalid @enderror" id="type" value="{{ old('kategori') }}"  name="kategori" id="inputGroupSelect01" required>
                                                <option disabled  selected value="0">Pilih Salah Satu...</option>
                                                <option value="0"{{old('kategori')=="0"? 'selected':''}}>Umum </option>
                                                <option value="1"{{old('kategori')=="1"? 'selected':''}}>Khusus Yayasan</option>
                                            </select>
                                            </div>
                                            @error('kategori')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span> 
                                            @enderror
                                            <i class="fas fa-sort"></i>
                                                <span>Kategori Cuti Karyawan</span>
                                            <div class="form-group">
                                                <select class="form-control @error('kategori_karyawan')is-invalid @enderror" id="type" value="{{ old('kategori_karyawan') }}"  name="kategori_karyawan" id="inputGroupSelect01" required>
                                                <option disabled  selected value="0">Pilih Salah Satu...</option>
                                                <option value="0"{{old('kategori_karyawan')=="KTY"? 'selected':''}}>Karyawan Tetap </option>
                                                <option value="1"{{old('kategori_karyawan')=="KTTY"? 'selected':''}}>Karyawan Tidak Tetap</option>
                                            </select>
                                            </div>
                                            @error('kategori_karyawan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span> 
                                            @enderror
                                             <i class="fas fa-cogs"></i>
                                                <span>Sesi Berlaku Cuti</span>
                                            <div class="form-group">
                                                <select class="form-control @error('sesi')is-invalid @enderror" id="type" value="{{ old('sesi') }}"name="sesi" id="inputGroupSelect01" required>
                                                <option disabled  selected value="0">Pilih Salah Satu...</option>
                                                <option value="0"{{old('sesi')=="0"? 'selected':''}}>Fleksibel </option>
                                                <option value="1"{{old('sesi')=="1"? 'selected':''}}>Tahunan</option>
                                            </select>
                                            </div>
                                            @error('sesi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                             <button id="go" type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Tambah Jenis Cuti') }}
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

