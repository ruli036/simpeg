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
        <!-- Sidebar -->
     @include('include.menu') 
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('include.header')
                <div class="container">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-5 d-none d-lg-block"><img src="{{asset('img/logo.png')}}" height="100%" width="100%"> </div>
                                <div class="col-lg-7">
                                    <div class="p-5">
                                        <div class="section-title">
                                            <h2 class="text-capitalize"> 
                                               Ganti Password {{$datauser->name}}
                                            </h2>
                                          </div>
                                          @if ($message = Session::get('warning1'))
                                          <div class="alert alert-warning alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>    
                                            <strong>{{ $message }}</strong>
                                          </div>
                                          @endif
                                          @if ($message = Session::get('info1'))
                                          <div class="alert alert-primary alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>    
                                            <strong>{{ $message }}</strong>
                                          </div>
                                          @endif
                                          <form id="pass" action="{{url('/editpassuser',$datauser->id)}}" method="POST">
                                              @csrf
                                                <label for="inputPassword5" class="form-label">Password Baru</label>
                                                <input type="password" name="passwordbaru" id="inputPassword6" class="form-control" aria-describedby="passwordHelpBlock" required>
                                                @error('passwordbaru')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <label for="inputPassword5" class="form-label">Konfirmasi Password Baru</label>
                                                <input type="password" name="passwordkonformasi" id="inputPassword6" class="form-control" aria-describedby="passwordHelpBlock" required>
                                                @error('passwordkonformasi')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <br>
                                                <button id="go" type="submit" class="btn btn-success">Ganti Password</button>  
                                          </form>
                                        </div>
                                        <hr>
                                        
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
          $("button#go").click(function(e){
          e.preventDefault();
              document.getElementById("pass").submit();
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

