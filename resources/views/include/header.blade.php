
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
     
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <form
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            
            <div class="btn btn-sm btn-info"><h6><b class="text-capitalize">{{Auth::user()->jabatan}}</b></h6></div>
        </div>
    </form>

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                @if (Auth::user()->foto=='-')
                    <img class="img-profile rounded-circle" src="{{asset('img/undraw_profile.svg')}}">
                @else
                <img class="img-profile rounded-circle" src="{{asset('img_profil/'.Auth::user()->foto)}}">
                @endif
                
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{url('/profile')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#foto">
                    <i class="fas fa-image fa-sm fa-fw  mr-2 text-gray-400"></i>
                    Ganti Foto Profil
                </a>
                <a class="dropdown-item" href="{{url('/halamangantipass')}}">
                    <i class="fas fa-lock fa-sm fa-fw  mr-2 text-gray-400"></i>
                    Ganti Password
                </a>
               
                <div class="dropdown-divider"></div>
                
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </li>

    </ul>
    <div class="modal fade" id="foto" tabindex="-1" role="dialog" aria-labelledby="foto" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Ganti Foto Profil?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="POST" id="form" action="{{url('/uploudfoto')}}" enctype="multipart/form-data"> 
                @csrf
            <div class="modal-body">  
                <input id="foto" type="file" class="@error('foto') is-invalid @enderror" name="foto" required >
                @error('foto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }} </strong>
                </span>
            @enderror
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type="submit" id="uploude" class="btn btn-success">Uploud</button>
             </div>
        </form>
        </div>
    </div>

</nav>
