<!DOCTYPE html>
<html lang="en">
    
@include('include.heads')
<body id="page-top">
          <!-- Sidebar -->
     @include('include.menu') 
 
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('include.header')
                <!-- End of Topbar -->
                 <div class="container-fluid">
           
                <!-- Begin Page Content -->
                
                    <!-- Page Heading -->
                     <h1 class="h3 mb-2 text-gray-800">Daftar Slip Gaji Karyawan </h1>
                    @if ($message = Session::get('info'))
                    <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>    
                      <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    @if ($message = Session::get('warning'))
                    <div class="alert alert-warning alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>    
                      <strong>{{ $message }}</strong>
                    </div>
                    @endif
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                               
                                <div class="col-md-12">
                                    <form action="{{url('filter-aproval-slip-gaji')}}" id="cari" method="POST">
                                        @csrf
                                         <div class="row">
                                         <div class="col-md-3">
                                            <select class="form-control @error('divisi')is-invalid @enderror" id="type"  name="divisi" id="inputGroupSelect01" required>
                                                <option disabled selected value="0">Piliih Divisi...</option>
                                                <option value="all"{{$divisi=="all"? 'selected':''}}>Semua Divisi</option>
                                                <option value="DAYCARE"{{$divisi=="DAYCARE"? 'selected':''}}>DAYCARE</option>
                                                <option value="KB-TK"{{$divisi=="KB-TK"? 'selected':''}}>KB-TK</option>
                                                <option value="SD"{{$divisi=="SD"? 'selected':''}}>SD</option>
                                                <option value="SMP"{{$divisi=="SMP"? 'selected':''}}>SMP</option>
                                                <option value="YAYASAN"{{$divisi=="YAYASAN"? 'selected':''}}>YAYASAN</option>
                                              </select>
                                            @error('divisi')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div> 
                                         <div class="col-md-3">
                                            <select class="form-control @error('bulan')is-invalid @enderror" id="bulan" name="bulan" required>
                                                <option disabled selected value="0">Pilih Bulan...</option>
                                                    <option class="text-capitalize" id="select"  value="01" {{$bulan== '01' ? 'selected':''}}>Januari</option>
                                                    <option class="text-capitalize" id="select"  value="02" {{$bulan== '02' ? 'selected':''}}>Febuari </option>
                                                    <option class="text-capitalize" id="select"  value="03" {{$bulan== '03' ? 'selected':''}}>Maret </option>
                                                    <option class="text-capitalize" id="select"  value="04" {{$bulan== '04' ? 'selected':''}}>April </option>
                                                    <option class="text-capitalize" id="select"  value="05" {{$bulan== '05' ? 'selected':''}}>Mei </option>
                                                    <option class="text-capitalize" id="select"  value="06" {{$bulan== '06' ? 'selected':''}}>Juni </option>
                                                    <option class="text-capitalize" id="select"  value="07" {{$bulan== '07' ? 'selected':''}}>Juli </option>
                                                    <option class="text-capitalize" id="select"  value="08" {{$bulan== '08' ? 'selected':''}}>Agustus </option>
                                                    <option class="text-capitalize" id="select"  value="09" {{$bulan== '09' ? 'selected':''}}>September </option>
                                                    <option class="text-capitalize" id="select"  value="10" {{$bulan== '10' ? 'selected':''}}>Oktober </option>
                                                    <option class="text-capitalize" id="select"  value="11" {{$bulan== '11' ? 'selected':''}}>November </option>
                                                    <option class="text-capitalize" id="select"  value="12" {{$bulan== '12' ? 'selected':''}}>Desember </option>
                                                </select>
                                                @error('bulan')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> 
                                        <div class="col-md-3">
                                            <select class="form-control @error('tahun')is-invalid @enderror" id="tahun" name="tahun" required>
                                                <option disabled selected value="0">Pilih Tahun...</option>
                                                    <option id="select"  value="2021" {{$tahun== '2021' ? 'selected':''}}>2021 </option>
                                                    <option id="select"  value="2022" {{$tahun== '2022' ? 'selected':''}}>2022 </option>
                                                    <option id="select"  value="2023" {{$tahun== '2023' ? 'selected':''}}>2023 </option>
                                                    <option id="select"  value="2024" {{$tahun== '2024' ? 'selected':''}}>2024 </option>
                                                    <option id="select"  value="2025" {{$tahun== '2025' ? 'selected':''}}>2025 </option>
                                                    <option id="select"  value="2026" {{$tahun== '2026' ? 'selected':''}}>2026 </option>
                                                    <option id="select"  value="2027" {{$tahun== '2027' ? 'selected':''}}>2027 </option>
                                                    <option id="select"  value="2028" {{$tahun== '2028' ? 'selected':''}}>2028 </option>
                                                    <option id="select"  value="2029" {{$tahun== '2029' ? 'selected':''}}>2029 </option>
                                                    <option id="select"  value="2029" {{$tahun== '2030' ? 'selected':''}}>2029 </option>
                                                 </select>
                                                @error('tahun')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                         <div class="col-md-1" style="padding-top: 3px">
                                            <button type="submit" id="delete"  class="btn btn-primary btn-user btn-sm">  <i class="fas fa-search"></i> </button>
                                        </div>
                                         <div class="col-md-1" style="padding-top: 3px">
                                            <a type="button" data-target="#alert" data-toggle="modal" class="  @if(count($datas) == 0) disabled btn btn-success btn-user btn-sm @else btn btn-success btn-info btn-sm @endif "> Approved </a>
                                        </div>
                                    </div>
                                     </form>
                                  </div>
                             </div> 
                         </div>
                         
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light"> 
                                            <th>No</th>
                                            <th>Periode</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Divisi / Jabatan</th>
                                            <th>Subtotal Pendapatan</th>
                                            <th>Total Pemotongan</th>
                                            <th>Total Gaji Bersih</th>
                                          </tr>
                                    </thead>
                                     <tbody style="font-size: 15px">
                                          @foreach ($datas as $key => $data)
                                          
                                             <tr>
                                                <td class="text-center">{{$key+=1}}</td>
                                                  <td>{{date('F Y', strtotime($data->periode))}}</td>
                                                  <td>{{$data->nik}}</td>
                                                  <td>{{$data->name}}</td>
                                                  <td>
                                                      {{$data->divisi}} <br>
                                                      {{$data->jabatan}}
                                                   </td>
                                                 <td>@currency($data->subtotal)</td>
                                                 <td>(- @currency($data->potongan))</td>
                                                 <td>@currency($data->total)</td>
                                                   
                                              </tr>
                                         @endforeach
                                     </tbody>
                                     <tfoot>
                                        <th colspan="2">
                                            Total Gaji Karyawan
                                        </th>
                                        <th colspan="6" class="text-right">
                                            @currency($totalSeluruhGaji)
                                        </th>
                                     </tfoot>
                                </table>
                                

                                <div class="d-flex justify-content-end" data-aos="fade-up" style="padding: 10px">
                                    <span class="small">
                                     </span>
                                  </div>
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
    <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="alert" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Setujui Untuk Singkronisasi Slip Gaji?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">  
               Harap Mengecek Data Sebelum Menyetujui!
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a id="approved" href="{{url('/approved-slip-gaji',[$divisi,$tahun,$bulan])}}" type="button"class="btn btn-success">Approved</a>
             </div>
        </form>
        </div>
    </div>
    </div>
       
    @include('include.scripts')
<!-- Bootstrap core JavaScript-->
<script>
   
    $(document).ready(function () {
        $(document).on('click','#addCek',function(){
                var item_id_slip = $(this).data('id_slip');
                 $('#id_slip').val(item_id_slip);
                 });
    $("button#go").click(function(e){
    e.preventDefault();
        document.getElementById("import").submit();
        $.LoadingOverlay("show");});
    $("button#delete").click(function(e){
    e.preventDefault();
        document.getElementById("cari").submit();
        $.LoadingOverlay("show");});
    $("button#uploude").click(function(e){
  e.preventDefault();
      document.getElementById("approved").submit();
      $.LoadingOverlay("show");
  });

 })
      
   
</script> 
</body>

</html>