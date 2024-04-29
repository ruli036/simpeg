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
            @if (jumlahSuratTunggukaryawan()!=0)
                <span class="badge badge-danger badge-counter"> ! </span>
            @endif
        </span>
    </a>
        <div id="suratCuti" class="collapse" aria-labelledby="headingUtilities"  data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengajuan Cuti Page:</h6>
                <a class="collapse-item" href="{{url('/dataftarsurattunggu')}}">
                    Pengajuan Cuti Staff
                    @if (jumlahSuratTunggukaryawan()!=0)
                    <span class="badge badge-danger badge-counter">{{jumlahSuratTunggukaryawan()}}</span>
                    @endif
                </a>

                <a class="collapse-item" href="{{url('/datasuratdisetujuidivisi')}}">Daftar Cuti Karyawan</a>
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
                <a class="collapse-item" href="{{url('/daftartarkaryawan')}}">Daftar Karyawan Sekolah</a>
             </div>
        </div>
    </li>