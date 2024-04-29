@if (cekKeanggotaanBmt()==1)
    {{------------------------------------------------------------------------------------------------------------------}}
       <!-- Heading -->
       <div class="sidebar-heading">
        BMT
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if( $aktive=="bmt") active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#BMT"
        aria-expanded="true" aria-controls="BMT">
        <i class="fas fa-money-bill-wave-alt"></i>
        <span>BMT</span>
    </a>
        <div id="BMT" class="collapse" aria-labelledby="headingUtilities"  data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">BMT Page:</h6>
                <a class="collapse-item" href="{{url('/pinjaman-bmt-view')}}">Pinjaman BMT</a>
                <a class="collapse-item" href="{{url('/penarikan-wadiah-view')}}">Penarikan Wadiah</a>
                <a class="collapse-item" href="{{url('/detail-setoran-bmt-view',getIdAnggotaBMT())}}">Setoran BMT</a>
            </div>
        </div>
    </li>
@endif


 {{------------------------------------------------------------------------------------------------------------------}}
       <!-- Heading -->
       <div class="sidebar-heading">
        Users
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if( $aktive=="users") active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users"
        aria-expanded="true" aria-controls="users">
        <i class="fas fa-user"></i>
        <span>Users</span>
    </a>
        <div id="users" class="collapse" aria-labelledby="headingUtilities"  data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Users Page:</h6>
                <a class="collapse-item" href="{{url('/Kehadiran')}}">Kehadiran</a>
                <a class="collapse-item" href="{{url('/datasuratcutisaya')}}">Ajukan Cuti</a>
                <a class="collapse-item" href="{{url('/datasuratdisetujui')}}">Daftar Cuti saya</a>
                <a class="collapse-item" href="{{url('/daftarslipgajikaryawan')}}">Slip Gaji</a>
             </div>
        </div>
    </li>

