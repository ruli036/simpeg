<body id="page-top">

    <!-- Page Wrapper -->
   
    <div id="wrapper">
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/home')}}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{LEMBAGA}}</div>
            </a> 
            <div class="sidebar-brand d-flex align-items-center justify-content-center" >
                 @if (Auth::user()->foto=='-')
                <img class="img-profile rounded-circle" src="{{asset('img/undraw_profile.svg')}}" height="400%" width="100%">
                @else
                <img class="img-profile rounded-circle" src="{{asset('img_profil/'.Auth::user()->foto)}}" style="object-fit: cover" height="300%" width="70" >
                @endif
             </div>
             <br><br>
            <b class="text-light text-capitalize text-center">{{Auth::user()->divisi}}</b>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item @if($aktive=="home") active @endif">
                <a class="nav-link" href="{{url('/home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Tables -->
        @if (Auth::user()->status == '0')
            @include('include.menuAdmin') 
        @elseif(Auth::user()->status == '1') {{--kepala yayasan--}}
            @include('include.menuKetuaYayasan')       
        @elseif(Auth::user()->status == '2') {{--kabit kepegawaian--}}
            @include('include.menuKabidKepegawaian')  
        @elseif(Auth::user()->status == '3') {{--kpl sekolah--}}
            @include('include.menuKepsek')    
        @elseif(Auth::user()->status == '4') {{--keuangan dan kabit umum--}}
            @include('include.menuKabidUmum')  
        @elseif(Auth::user()->status == '5') {{--kabit--}}
            @include('include.menuKabid')  
        @elseif(Auth::user()->status == '7') {{--user--}}
            @include('include.menuPengurusBMT')  
        @elseif(Auth::user()->status == '10') {{--user--}}
            @include('include.menuPengurusAbsensiDivisi')  
        @else
            @include('include.menuKaryawan')  
        @endif
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>