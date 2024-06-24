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
                <div class="container">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Form Pengajuan !</h1>
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
                                            <form id="surat" name="slip"  class="user" method="POST" action="{{url('ajukan-pinjaman')}}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <select class="form-control  @error('tabungan')is-invalid @enderror" id="type" value="{{ old('tabungan') }}"  name="tabungan" id="inputGroupSelect01" required>
                                                      <option disabled  selected value="0">Sumber Dana!</option>
                                                      <option value="1"{{old('tabungan')=="1"? 'selected':''}}>Pinjaman BMT</option>
                                                      <option value="2"{{old('tabungan')=="2"? 'selected':''}}>Penarikan Wadiah</option>
                                                    </select>
                                                    @error('tabungan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                  </div>
                                               
                                                <div class="form-group row ">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-calendar"></i>
                                                        <span>Pengajuan Untuk Tanggal?</span>
                                                        <input id="tgl" type="date" value="0" class="form-control form-control-user @error('tgl') is-invalid @enderror" name="tgl"  placeholder="Tanggal Pinjaman" required >
                                                        @error('tgl')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Nominal</span>
                                                        <input id="nominal" type="text" value="0" class="text-right form-control form-control-user number-separator @error('nominal') is-invalid @enderror" name="nominal"  placeholder="Nominal" required >
                                                        @error('nominal')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <i class="fas fa-file fa-cog"></i>
                                                    <span>Keterangan</span>
                                                    <textarea name="ket"  class="form-control @error('ket') is-invalid @enderror" placeholder="Keterangan" id="ket" cols="30" rows="5" required>{{ old('ket') }}</textarea>
                                                 @error('ket')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>  
                                             <button id="go" type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Ajukan') }}
                                            </button>
                                        </form>                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                       
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
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
   <!-- Bootstrap core JavaScript-->
    <script>
        $(document).ready(function () {
          
        $("button#go").click(function(e){
        e.preventDefault();
            document.getElementById("surat").submit();
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
