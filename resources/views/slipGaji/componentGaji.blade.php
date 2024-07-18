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
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Komponen Gaji</h1>
                @if ($message = Session::get('warning'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div class="col-md-8">
                                <button type="button" title="Tambah Data" class="btn btn-success btn btn-sm"
                                    data-toggle="modal" data-target="#exampleModaltambah">
                                    Tambah Komponen Gaji
                                </button>
                            </div>
                            {{-- <div class="col-md-4 ml-auto">
                                <form action="{{ url('searchcomponen') }}" autocomplete="on" class="text-end">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <input type="text" name="cari" value="<?= $keyword ?>"
                                                class="form-control" placeholder="Pencarian">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-primary btn-sm"><i
                                                    class="fa fa-search" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table table-striped">
                            <table class="table table-sm table-bordered text-capitalize" width="100%" cellspacing="0" id="dataTables">
                                <thead>
                                    <tr class="text-center bg-success text-light">
                                        <th style="width: 20px">No</th>
                                        <th style="width: 20px">Colom</th>
                                        <th>Nama</th>
                                        <th>Akun Debet</th>
                                        <th>Akun Credit</th>
                                        <th>Jenis</th>
                                        <th>Status</th>
                                        <th style="width: 200px" class="text-center">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $key => $item)
                                        <tr>
                                            <td class="text-center"> {{ $key += 1 }}</td>
                                            <td class="text-center">{{ $item->colom }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->akun_debet }}</td>
                                            <td>{{ $item->akun_credit }}</td>
                                            <td class="text-center">
                                                @if ($item->flag == 'P')
                                                    <span class="badge badge-warning badge-counter"> Pemasukan</span>
                                                @elseif ($item->flag == 'M')
                                                    <span class="badge badge-danger badge-counter"> Pemotongan</span>
                                                @else
                                                    <span class="badge badge-info badge-counter"> Netral</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if ($item->stts == 'A')
                                                    <span class="badge badge-warning badge-counter"> Aktif</span>
                                                @else
                                                    <span class="badge badge-danger badge-counter"> Nonaktif</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button type="button" title="Edit" class="btn btn-primary btn btn-sm"
                                                    data-toggle="modal"
                                                    data-target="#exampleModalEdit{{ $item->id }}">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                <a href="#"
                                                    @if ($item->stts == 'A') title="Nonaktifkan"
                                                    class="btn btn-danger btn btn-sm"
                                                    @else
                                                    title="Aktifkan"
                                                    class="btn btn-warning btn btn-sm" @endif
                                                    data-toggle="modal"
                                                    data-target="#exampleModalhapus{{ $item->id }}">
                                                    @if ($item->stts == 'A')
                                                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                                    @else
                                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                    @endif

                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{$datas->links('pagination::bootstrap-4')}} --}}
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
        <!-- End of Content Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        <div class="modal fade" id="exampleModaltambah" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapus">Tambah Komponen Gaji?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="user" method="POST" action="{{ url('/add_component_gaji') }}" id="additemform">
                            @csrf
                            <div>
                                <span>Nama Componen</span>
                                <input id="nama" type="text"
                                    class="text-right form-control form-control-user @error('nama') is-invalid @enderror"
                                    name="nama" placeholder="Nama Komponen" required>
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} </strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <span>Jenis Komponen</span>
                                        <select class="form-control @error('flag')is-invalid @enderror" id="flag"
                                            name="flag" required>
                                            <option disabled selected value="0">Pilih Jenis Komponen</option>
                                            <option id="select" value="P"
                                                {{ old('flag') == 'P' ? 'selected' : '' }}>Penambahan </option>
                                            <option id="select" value="M"
                                                {{ old('flag') == 'M' ? 'selected' : '' }}>Pemotongan</option>
                                            <option id="select" value="Z"
                                                {{ old('flag') == 'Z' ? 'selected' : '' }}>Netral </option>
                                        </select>
                                        @error('flag')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <span>Nomor Colom</span>
                                        <input id="colom" type="number"
                                            class="text-right form-control form-control-user @error('colom') is-invalid @enderror"
                                            name="colom" placeholder="Nomor Colom" required>
                                        @error('colom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <span>Akun Debet</span>
                                        <select class="form-control select2 @error('akun_debet')is-invalid @enderror"
                                            id="akun_debet" name="akun_debet" required>
                                            <option disabled selected value="0">Pilih Akun Debet</option>
                                            @foreach ($kodeRek as $item)
                                                <option value="{{ $item->kode }}"
                                                    {{ old('akun_debet') == $item->kode ? 'selected' : '' }}>
                                                    {{ $item->nama }} </option>
                                            @endforeach
                                        </select>
                                        @error('akun_debet')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div>
                                        <span>Akun Credit</span>
                                        <select class="form-control select2 @error('akun_credit')is-invalid @enderror"
                                            id="akun_credit" name="akun_credit" required>
                                            <option disabled selected value="0">Pilih Akun Credit</option>
                                            @foreach ($kodeRek as $item)
                                                <option value="{{ $item->kode }}"
                                                    {{ old('akun_credit') == $item->kode ? 'selected' : '' }}>
                                                    {{ $item->nama }} </option>
                                            @endforeach
                                        </select>
                                        @error('akun_credit')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="button" id="addItem" onclick="add()"
                            class="btn btn-success">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($datas as $item)
            <div class="modal fade" id="exampleModalhapus{{ $item->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="hapus">Aktifkan / Nonaktifkan Komponen Gaji?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ url('hapus_component_gaji') }}">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <span>Centang untuk menghapus komponen gaji secara permanen</span><b>
                                    {{ $item->nama }}</b> <br>
                                <input class="check-input @error('centang') is-invalid @enderror" type="checkbox"
                                    name="centang" id="centang" value="y"
                                    {{ old('centang') == 'y' ? 'checked' : '' }}>

                                @error('centang')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="hidden" id="idcomponent" name="idcomponent"
                                    value="{{ $item->id }}" />
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Yakin</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>

    <div class="modal fade" id="exampleModalEdit{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus">Ubah Komponen Gaji?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/edit_component_gaji', $item->id) }}" id="edititemform">
                        @csrf
                        <div>
                            <span>Nama Componen</span>
                            <input id="e_nama" type="text" value="{{ $item->nama }}"
                                class="text-right form-control form-control-user @error('e_nama') is-invalid @enderror"
                                name="e_nama" placeholder="Nama Komponen" required>
                            @error('e_nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <span>Jenis Komponen</span>
                                    <select class="form-control @error('e_flag')is-invalid @enderror" id="e_flag"
                                        name="e_flag" required>
                                        <option disabled selected value="0">Pilih Jenis Komponen</option>
                                        <option id="select" value="P"
                                            {{ $item->flag == 'P' ? 'selected' : '' }}>Penambahan </option>
                                        <option id="select" value="M"
                                            {{ $item->flag == 'M' ? 'selected' : '' }}>Pemotongan</option>
                                        <option id="select" value="Z"
                                            {{ $item->flag == 'Z' ? 'selected' : '' }}>Netral </option>
                                    </select>
                                    @error('e_flag')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <span>Nomor Colom</span>
                                    <input id="e_colom" type="number" value="{{ $item->colom }}"
                                        class="text-right form-control form-control-user @error('e_colom') is-invalid @enderror"
                                        name="e_colom" placeholder="Nomor Colom" required>
                                    @error('e_colom')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }} </strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div>
                                    <span>Akun Debet</span>
                                    <select class="form-control @error('e_akun_debet')is-invalid @enderror"
                                        id="e_akun_debet" name="e_akun_debet" required>
                                        <option disabled selected value="0">Pilih Akun Debet</option>

                                        @foreach ($kodeRek as $dt)
                                            <option value="{{ $dt->kode }}"
                                                {{ $dt->kode == $item->akun_debet ? 'selected' : '' }}>
                                                {{ $dt->nama }} </option>
                                        @endforeach
                                    </select>
                                    @error('e_akun_debet')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <span>Akun Credit</span>
                                    <select class="form-control @error('e_akun_credit')is-invalid @enderror"
                                        id="e_akun_credit" name="e_akun_credit" required>
                                        <option disabled selected value="0">Pilih Akun Credit</option>
                                        @foreach ($kodeRek as $dt)
                                            <option value="{{ $dt->kode }}"
                                                {{ $dt->kode == $item->akun_credit ? 'selected' : '' }}>
                                                {{ $dt->nama }} </option>
                                        @endforeach
                                    </select>
                                    @error('e_akun_credit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button onclick="edit()" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach





    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
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

    <script type="text/javascript">
        function add() {
            var kredit = $('#akun_credit').val();
            var debet = $('#akun_debet').val();
            var nama = $('#nama').val();
            var flag = $('#flag').val();
            var colom = $('#colom').val();
            if (kredit != debet) {
                Swal.fire({
                    title: "Loading!",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
                document.getElementById("additemform").submit();
            } else if (nama == '' || flag == 0 || colom == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Warning',
                    text: 'Lengkapi Form Anda',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Warning',
                    text: 'Kredit and Debet tidak boleh sama.' + kredit + " / " + debet,
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            }
        }

        function edit() {
            var kredit = $('#e_akun_credit').val();
            var debet = $('#e_akun_debet').val();
            var nama = $('#e_nama').val();
            var flag = $('#e_flag').val();
            var colom = $('#e_colom').val();
            if (nama == '' || flag == 0 || colom == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Warning',
                    text: 'Lengkapi Form Anda',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                });
            } else {
                Swal.fire({
                    title: "Loading!",
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                });
                document.getElementById("edititemform").submit();

            }
        }
        
    </script>
</body>

</html>
