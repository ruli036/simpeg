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
                 <div class="container">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-12">
                                    @if ($message = Session::get('warning'))
                                    <div class="alert alert-danger alert-block">
                                      <button type="button" class="close" data-dismiss="alert">×</button>    
                                      <strong>{{ $message }}</strong>
                                    </div>
                                    @endif
                                    @if ($message = Session::get('info'))
                                    <div class="alert alert-primary alert-block">
                                      <button type="button" class="close" data-dismiss="alert">×</button>    
                                      <strong>{{ $message }}</strong>
                                    </div>
                                    @endif
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Detail Absensi {{$data[0]->name}} !</h1>
                                        </div>
                                        <div class="table-responsive table table-striped">
                                        <table class="table table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="text-center bg-success text-light">
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Pagi</th>
                                                <th>Telat Masuk</th>
                                                <th>Siang</th>
                                                <th>Telat Masuk</th>
                                                <th>Sore</th>
                                                <th>Cepat Pulang</th>
                                                <th>Hasil</th>
                                            </tr> 
                                            </thead>
                                           <tbody>
                                            @foreach ($data as $key => $item)
                                            @php
                                                $tanggal = $item->tgl_absen;
                                                $nama_hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                                $tanggal_carbon = strtotime($tanggal);
                                                $hari_indonesia = $nama_hari[date('w', $tanggal_carbon)];
                                            @endphp
                                            
                                            <tr>
                                                <td class="text-center">{{$key += 1}}</td>
                                                 <td> {{$hari_indonesia}}, {{date('d F Y', strtotime($item->tgl_absen))}}</td>
                                                 <td>{{$item->jam_masuk}}</td>   
                                                 <td class="@if($item->telat_masuk != 0) bg-warning text-light @endif">
                                                    @if ($item->telat_masuk != 0)
                                                    {{totalTerlambat($item->telat_masuk)}}
                                                    @else
                                                        0 seconds
                                                    @endif
                                                </td>   
                                                 <td>{{$item->jam_siang}}</td>   
                                                 <td class="@if($item->telat_kembali != 0) bg-warning text-light @endif">
                                                    @if ($item->telat_kembali != 0)
                                                    {{totalTerlambat($item->telat_kembali)}}
                                                    @else
                                                        0 seconds
                                                    @endif
                                                </td>   
                                                 <td>{{$item->jam_pulang}}</td>   
                                                 <td class="@if($item->cepat_pulang != 0) bg-warning text-light @endif"> 
                                                    @if ($item->cepat_pulang != 0)
                                                    {{totalTerlambat($item->cepat_pulang)}}
                                                    @else
                                                        0 seconds
                                                    @endif
                                                 </td>   
                                                 <td>
                                                    @if ($item->jam_masuk == '00:00:00' || $item->jam_pulang == '00:00:00')
                                                    <a class="btn btn-danger btn-sm btn-block"  type="button">
                                                        <i class="fas fa-minus-circle"></i>
                                                    </a>
                                                    @else
                                                    <a class="btn btn-success btn-sm btn-block"  type="button">
                                                        <i class="fas fa-check-circle"></i>
                                                    </a>
                                                    @endif
                                                 </td>
                                            </tr>
                                            @endforeach
                                           </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    @include('include.scripts')

   
</body>
 
</html>
