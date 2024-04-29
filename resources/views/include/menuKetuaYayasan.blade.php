
 <li class="nav-item @if($aktive=="slipGaji") active @endif">
    <a class="nav-link" href="{{url('daftarslipgaji')}}">
        <i class="fas fa-database"></i>
        <span>Daftar Slip Gaji Karyawan</span></a>
</li>

     {{------------------------------------------------------------------------------------------------------------------}}
       <!-- Heading -->
       <div class="sidebar-heading">
        Pengajuan Surat Cuti
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if( $aktive=="suratCuti") active @endif">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#suratCuti"
        aria-expanded="true" aria-controls="suratCuti">
        <i class="fas fa-folder"></i>
        <span>
            Pengajuan Surat Cuti
            @if (jumlahSuratTunggukaryawan()!=0 || jumlahSuratTungguOB()!=0 )
            <span class="badge badge-danger badge-counter"> ! </span>
            @endif
        </span>
    </a>
        <div id="suratCuti" class="collapse" aria-labelledby="headingUtilities"  data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengajuan Cuti Page:</h6>
                <a class="collapse-item" href="{{url('/dataftarsurattunggu')}}">
                    @if (jumlahSuratTunggukaryawan()!=0)
                    <span class="badge badge-danger badge-counter">{{jumlahSuratTunggukaryawan()}}</span>
                    @endif
                    Pengajuan Cuti Karyawan
                </a>
                <a class="collapse-item" href="{{url('/dataftarsurattungguOB')}}">  
                    @if (jumlahSuratTungguOB()!=0)
                    <span class="badge badge-danger badge-counter">{{jumlahSuratTungguOB()}}</span>
                    @endif 
                    Pengajuan Cuti OB/OG 
                </a>
                <a class="collapse-item" href="{{url('/datasuratdisetujuidivisisemua')}}">Daftar Cuti Karyawan</a>
             </div>
        </div>
    </li>
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
        @if (jumlahPengajuanPinjaman()!=0)
        <span class="badge badge-danger badge-counter"> ! </span>
        @endif

    </a>
        <div id="BMT" class="collapse" aria-labelledby="headingUtilities"  data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">BMT Page:</h6>
                <a class="collapse-item" href="{{url('/pengajuan-pinjaman-bmt-view')}}">
                    List Pengajuan Pinjaman
                    @if (jumlahPengajuanPinjaman()!=0)
                    <span class="badge badge-danger badge-counter">{{jumlahPengajuanPinjaman()}}</span>
                    @endif
                </a>
                <a class="collapse-item" href="{{url('/all-pinjaman-bmt-view')}}">Daftar Pinjaman BMT</a>
                <a class="collapse-item" href="{{url('/all-penarikan-bmt-view')}}">History Penarikan Wadiah</a>
                <a class="collapse-item" href="{{url('/daftar-anggota-bmt-view')}}">Anggota BMT</a>

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
                <a class="collapse-item" href="{{url('/daftarslipgajikaryawan')}}">Slip Gaji</a>
                <a class="collapse-item" href="{{url('/datauser')}}">Daftar Karyawan </a>
             </div>
        </div>
    </li>