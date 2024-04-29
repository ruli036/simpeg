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
        @if (jumlahPengajuanPinjaman()!=0 || jumlahPenarikanWadiah()!=0)
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
                <a class="collapse-item" href="{{url('/pengajuan-penarikan-wadiah-view')}}">
                    List Penarikan Wadiah
                    @if (jumlahPenarikanWadiah()!=0)
                    <span class="badge badge-danger badge-counter">{{jumlahPenarikanWadiah()}}</span>
                    @endif
                </a>
                <a class="collapse-item" href="{{url('/all-pinjaman-bmt-view')}}">Daftar Pinjaman BMT</a>
                <a class="collapse-item" href="{{url('/all-penarikan-bmt-view')}}">
                    Penarikan Wadiah
                </a>
                <a class="collapse-item" href="{{url('/daftar-anggota-bmt-view')}}">Anggota BMT Aktif</a>
                <a class="collapse-item" href="{{url('/daftar-anggota-bmt-nonaktif-view')}}">Anggota BMT Nonaktifkan</a>
                <a class="collapse-item" href="{{url('/filter-laporan-bmt-view')}}">Filter Setoran BMT</a>
                <a class="collapse-item" href="{{url('/pengelolaan-adm-view')}}">Administrasi BMT</a>

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
                <a class="collapse-item" href="{{url('/Kehadiran')}}">Kehadiran</a>
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