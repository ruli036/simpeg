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
              
                <div class="container">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                
                                 <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Edit kategori Jabatan!</h1>
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
                                            <form id="user" class="user" method="POST" action="{{ url('simpaneditjabatan',$formatdata->id_jabatan) }}" >
                                                @csrf
                                            <div class="form-group">
                                                <i class="fas fa-user-tie"></i>
                                                <span>Jabatan</span>
                                                    <input id="jabatan" type="text" class="form-control form-control-user @error('jabatan') is-invalid @enderror" name="jabatan" value="{{$formatdata->jabatan }}" required autofocus placeholder="Nama Jabatan">
                                                    @error('jabatan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </div>  
                                            <i class="fas fa-level-up-alt"></i>
                                                <span>Level</span>
                                            <div class="form-group">
                                                <select class="form-control @error('level')is-invalid @enderror" id="type"  name="level" id="inputGroupSelect01" required>
                                                <option disabled  selected value="0">Piliih level...</option>
                                                <option value="1"{{$formatdata->level =="1"? 'selected':''}}>Pimpinan</option>
                                                <option value="2"{{$formatdata->level=="2"? 'selected':''}}>Kabid Kepegawaian</option>
                                                <option value="4"{{$formatdata->level=="4"? 'selected':''}}>Kabid Umum</option>
                                                <option value="5"{{$formatdata->level=="5"? 'selected':''}}>Kabid lain</option>
                                                <option value="3"{{$formatdata->level=="3"? 'selected':''}}>Kepala Sekolah</option>
                                                <option value="6"{{$formatdata->level=="6"? 'selected':''}}>Staf/Guru</option>
                                                 <option value="11"{{$formatdata->level=="11"? 'selected':''}}>Wali Kelas</option>
                                                 <option value="12"{{$formatdata->level=="12"? 'selected':''}}>Guru Tahfiz</option>
                                                <option value="7"{{$formatdata->level=="7"? 'selected':''}}>Penanggung Jawab BMT</option>
                                                <option value="10"{{$formatdata->level=="10"? 'selected':''}}>Penanggung Jawab Absensi</option>
                                                <option value="9"{{$formatdata->level=="9"? 'selected':''}}>OB/OG, Security dan lain-lain</option>
                                                </select>
                                            </div>
                                            @error('level')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                             <button id="go" type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Simpan Perubahan') }}
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
        
    }); $("button#uploude").click(function(e){
        e.preventDefault();
            document.getElementById("form").submit();
            $.LoadingOverlay("show");
        });
                    
        });
  </script>
</body>


</html>

