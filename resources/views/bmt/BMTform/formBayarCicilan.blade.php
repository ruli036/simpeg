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
                                            <h1 class="h4 text-gray-900 mb-4">Form Bayar Cicilan Pinjaman BMT!</h1>
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
                                            <form id="surat" name="slip"  class="user" method="POST" action="{{url('bayar-cicilan-pinjaman',$id_cicilan)}}" enctype="multipart/form-data">
                                                @csrf                           
                                                <div class="form-group">
                                                    <select class="form-control  @error('cicilan')is-invalid @enderror" id="type" value="{{ old('cicilan') }}"  name="cicilan" id="inputGroupSelect01" required>
                                                      <option disabled  selected value="0">Cicilan Ke</option>
                                                      <option value="1"{{old('cicilan')=="1"? 'selected':''}}>Cicilan 1</option>
                                                      <option value="2"{{old('cicilan')=="2"? 'selected':''}}>Cicilan 2</option>
                                                      <option value="3"{{old('cicilan')=="3"? 'selected':''}}>Cicilan 3</option>
                                                      <option value="4"{{old('cicilan')=="4"? 'selected':''}}>Cicilan 4</option>
                                                      <option value="5"{{old('cicilan')=="5"? 'selected':''}}>Cicilan 5</option>
                                                      <option value="6"{{old('cicilan')=="6"? 'selected':''}}>Cicilan 6</option>
                                                    </select>
                                                    @error('cicilan')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                  </div>
                                                <div class="form-group row ">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-calendar"></i>
                                                        <span>Tanggal Setoran</span>
                                                            <input id="tgl_bayar" value="{{old('tgl_bayar')}}" type="date" class="form-control form-control-user @error('tgl_bayar') is-invalid @enderror" name="tgl_bayar"  placeholder="Tanggal Bayar" required >
                                                             @error('tgl_bayar')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Nominal Bayar</span>
                                                        <input id="nominal_bayar" type="text" value="0" class="text-right form-control form-control-user number-separator @error('nominal_bayar') is-invalid @enderror" name="nominal_bayar"  placeholder="Nominal Bayar Cicilan" required >
                                                        @error('nominal_bayar')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                 </div>
                                                 
                                             <button id="go" type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Simpan Data') }}
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
