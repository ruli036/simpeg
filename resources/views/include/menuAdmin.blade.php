<li class="nav-item @if( $aktive=="suratCuti") active @endif">
    <a class="nav-link" href="{{url('datasuratdisetujuidivisisemua')}}">
        <i class="fas fa-folder"></i>
        <span>Daftar Cuti Karyawan</span></a>
</li> 
    {{------------------------------------------------------------------------------------------------------------------}}
       <!-- Heading -->
       <div class="sidebar-heading">
        Slip Gaji Karyawan
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if( $aktive=="slipGaji") active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#slipGaji"
        aria-expanded="true" aria-controls="slipGaji">
        <i class="fas fa-database"></i>
        <span>Slip Gaji Karyawan</span>
    </a>
        <div id="slipGaji" class="collapse" aria-labelledby="headingUtilities"  data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Slip Gaji Page:</h6>
                <a class="collapse-item" href="{{url('/daftarslipgaji')}}">Daftar Slip Gaji</a>
                <a class="collapse-item" href="{{url('/aproval-slip-gaji-view')}}">Aproval Slip Gaji</a>
                <a class="collapse-item" href="{{url('/halamanexport')}}">Export Daftar Slip Gaji</a>
                <a class="collapse-item" href="{{url('/riwayatimport')}}">Riwayat Import Slip Gaji</a>
                <a class="collapse-item" href="{{url('/item-gaji')}}">Component Gaji</a>
             </div>
        </div>
    </li>
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
                <a class="collapse-item" href="{{url('/form-add-user-absensi-view')}}">Tambah User Absensi</a>
                <a class="collapse-item" href="{{url('/form-add-data-absensi-view')}}">Tambah Kehadiran</a>
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
        @if (jumlahPengajuanPinjaman()!=0 || jumlahPenarikanWadiah()!=0 || jumlahDataBaru()!=0|| jumlahPinjamanBaru()!=0)
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
                <a class="collapse-item" href="{{url('/all-pinjaman-bmt-view')}}">
                    Daftar Pinjaman BMT
                    @if (jumlahPinjamanBaru()!=0)
                    <span class="badge badge-danger badge-counter">{{jumlahPinjamanBaru()}}</span>
                    @endif
                </a>
                <a class="collapse-item" href="{{url('/all-penarikan-bmt-view')}}">
                    Penarikan Wadiah 
                    @if (jumlahDataBaru()!=0)
                    <span class="badge badge-danger badge-counter">{{jumlahDataBaru()}}</span>
                    @endif
                </a>
                <a class="collapse-item" href="{{url('/daftar-anggota-bmt-view')}}">Anggota BMT Aktif</a>
                <a class="collapse-item" href="{{url('/daftar-anggota-bmt-nonaktif-view')}}">Anggota BMT Nonaktifkan</a>
                <a class="collapse-item" href="{{url('/filter-laporan-bmt-view')}}">Filter Setoran BMT</a>
                <a class="collapse-item" href="{{url('/pengelolaan-adm-view')}}">Administrasi BMT</a>
            </div>
        </div>
    </li>
    {{-- ----------------------------------------------------------------------------------------------------------------}}
     <!-- Heading -->
       <div class="sidebar-heading">
        Setting
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if( $aktive=="user") active @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Setting</span>
    </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"  data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Admin Page:</h6>
                <a class="collapse-item" href="{{url('/datauser')}}">Daftar Karyawan</a>
                <a class="collapse-item" href="{{url('/datausernonaktif')}}">Daftar karyawan nonaktif</a>
                <a class="collapse-item" href="{{url('/daftarjeniscuti')}}">Daftar Jenis Cuti</a>
                <a class="collapse-item" href="{{url('/formatsurat')}}">Daftar Format Surat</a>
                <a class="collapse-item" href="{{url('/daftarjabatan')}}">Kategori Jabatan</a>
             </div>
        </div>
    </li>