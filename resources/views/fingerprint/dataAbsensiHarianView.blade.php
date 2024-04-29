<!DOCTYPE html>
<html lang="en">
@include('include.heads')
<body id="page-top">
    <!-- Page Wrapper -->
          <!-- Sidebar -->
     @include('include.menu') 
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('include.header')
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Daftar Absensi Hari Ini</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <Form action="{{url('absensi-masuk-harian')}}" method="GET">
                            <div class="row">
                                @if (Auth::user()->status != 10)
                                <div class="col-md-10" style="padding-top: 5px">
                                    <select class="form-control @error('divisi')is-invalid @enderror" id="type" value="{{ old('divisi') }}"  name="divisi" id="inputGroupSelect01" required>
                                        <option disabled  selected value="0">Piliih Divisi...</option>
                                        <option value="ALL"{{$divisi=="ALL"? 'selected':''}}>ALL DIVISI</option>
                                        <option value="YAYASAN"{{$divisi=="YAYASAN"? 'selected':''}}>YAYASAN</option>
                                        <option value="DAYCARE"{{$divisi=="DAYCARE"? 'selected':''}}>DAYCARE</option>
                                        <option value="KB-TK"{{$divisi=="KB-TK"? 'selected':''}}>KB-TK</option>
                                        <option value="SD"{{$divisi=="SD"? 'selected':''}}>SD</option>
                                        <option value="SMP"{{$divisi=="SMP"? 'selected':''}}>SMP</option>
                                      </select>
                                    @error('divisi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> 
                                     
                                <div class="col-md-2" style="padding-top: 5px" >
                                        <button class="btn btn-primary btn-block"  type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                </div>
                                @endif
                                    
                                  </div>
                                </Form>
                                </div>                       
                             
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th>Profile</th>
                                            <th>INFO</th>
                                            <th>Tanggal</th>
                                            <th>Jam Masuk</th>
                                            <th>Telat Masuk</th>
                                            <th>Jam Pulang</th>
                                            <th>Cepat Pulang</th>
                                            <th>Status Karyawan</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                         @foreach ($data as $datas)
                                            @php
                                                $tanggal = $datas->tgl_absen;
                                                $nama_hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                                $tanggal_carbon = strtotime($tanggal);
                                                $hari_indonesia = $nama_hari[date('w', $tanggal_carbon)];
                                            @endphp
                                        
                                             <tr>
                                                 <td class="align-text-top"> 
                                                   <div class="sidebar-brand d-flex align-items-center justify-content-center" >
                                                      @if ($datas->foto=='-')
                                                     <img class="img-profile rounded-circle" src="{{asset('img/undraw_profile.svg')}}" height="50" width="50"  >
                                                        @else
                                                        <img class="img-profile rounded-circle" src="{{asset('img_profil/'.$datas->foto)}}" height="50"  width="50" style="object-fit: cover">
                                                    @endif
                                                    </div>
                                                 </td>
                                                 <td>
                                                    {{$datas->nik}} <br>
                                                    {{$datas->name}} <br>
                                                    {{$datas->divisi}} /
                                                    {{$datas->jabatan}}
                                                </td>
                                                <td> {{$hari_indonesia}}, {{date('d F Y', strtotime($datas->tgl_absen))}}</td>
                                                 <td> 
                                                    {{$datas->jam_masuk}}
                                                </td>
                                                <td class="@if($datas->telat_masuk != 0) bg-warning text-light @endif"> 
                                                    @if ($datas->telat_masuk != 0) 
                                                    {{totalTerlambat($datas->telat_masuk)}}
                                                    @else
                                                        0 seconds
                                                    @endif</td>
                                                  <td>
                                                    {{$datas->jam_pulang    }}
                                                </td>
                                               
                                                <td class="@if($datas->cepat_pulang != 0) bg-warning text-light @endif">
                                                     @if ($datas->cepat_pulang != 0)
                                                    {{totalTerlambat($datas->cepat_pulang)}}
                                                    @else
                                                        0 seconds
                                                    @endif</td>
                                                 <td>{{$datas->status_karyawan}}</td>
                                             </tr>
                                         @endforeach
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

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

    @include('include.scripts')

   <script>
$(document).ready(function () {
    $("button#uploude").click(function(e){
        e.preventDefault();
            document.getElementById("form").submit();
            $.LoadingOverlay("show");
        });
                    
        });
     
   </script> 
</body>

</html>