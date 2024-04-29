
{{------------------------------------------------------------------------------------------------------------------}}
       <!-- Heading -->
       <div class="sidebar-heading">
        Absensi
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if( $aktive=="absensi") active @endif">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#absensi"
        aria-expanded="true" aria-controls="absensi">
        <i class="fas fa-users"></i>
        <span>Absensi</span>
    </a>
        <div id="absensi" class="collapse" aria-labelledby="headingUtilities"  data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Absensi Page:</h6>
                <a class="collapse-item" href="{{url('/absensi-masuk-harian')}}">Daftar Absensi Hari Ini</a>
                <a class="collapse-item" href="{{url('/rekap-absensi-view')}}">Rekap Absensi</a>
             </div>
        </div>
    </li>

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
                <a class="collapse-item" href="{{url('/datasuratcutisaya')}}">Ajukan Cuti</a>
                <a class="collapse-item" href="{{url('/datasuratdisetujui')}}">Daftar Cuti saya</a>
                <a class="collapse-item" href="{{url('/daftarslipgajikaryawan')}}">Slip Gaji</a>
                @if (cekKeanggotaanBmt()==1)
                <a class="collapse-item" href="{{url('/pinjaman-bmt-view')}}">Pinjaman BMT</a>
                <a class="collapse-item" href="{{url('/penarikan-wadiah-view')}}">Penarikan Wadiah</a>
                <a class="collapse-item" href="{{url('/detail-setoran-bmt-view',getIdAnggotaBMT())}}">Setoran BMT</a>
                @endif
             </div>
        </div>
    </li>

