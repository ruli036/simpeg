<!DOCTYPE html>
<html lang="en">
@include('include.heads')
<body id="page-top">

    <!-- Page Wrapper -->
    

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
                
            
                    <!-- Page Heading -->
                 
                    <h1 class="h3 mb-2 text-gray-800">Daftar Slip Gaji</h1>
                  
                    @if ($message = Session::get('info'))
                    <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">×</button>    
                      <strong>{{ $message }}</strong>
                    </div>
                    @endif
                  
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            
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
                                            <th>Fitur</th>
                                         </tr>
                                    </thead>
                                    
                                     <tbody>
                                          @foreach ($datas as $key => $data)
                                               <tr>
                                                <td>{{$key+=1}}</td>
                                                  <td>{{date('F Y', strtotime($data->periode))}}</td>
                                                  <td>{{$data->nik}}</td>
                                                  <td>{{$data->name}}</td>
                                                  <td>
                                                      {{$data->divisi}} <br>
                                                      {{$data->jabatan}}
                                                   </td>
                                                 <td>@currency($data->subtotal??0)</td>
                                                 <td>(- @currency($data->potongan??0))</td>
                                                 <td>@currency($data->total??0)</td>
                                                <td class="text-center"> 
                                                    <a type="button" id="print" title="Detail" class="btn btn-info btn btn-sm text-light" href="{{url('detailslipgaji',[$data->id,$data->periode])}}"    >
                                                        <i class="fas fa-file-alt"></i> 
                                                    </a>
                                                    <a type="button" title="Download" onclick="printPage('{{$data->id}}','{{$data->periode}}')" id="print-preview-button" class="btn btn-primary btn btn-sm text-light" target="_blank"  >
                                                        <i class="fa fa-print"></i> 
                                                    </a>
                                                 </td>
                                               
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
<!-- Bootstrap core JavaScript-->
@include('include.scripts')

   <script>
$(document).ready(function () {
    $("button#uploude").click(function(e){
        e.preventDefault();
            document.getElementById("form").submit();
            $.LoadingOverlay("show");
        });
                    
        });
function printPage(id,date) {
    // document.getElementById('print-preview-button').addEventListener('click', function() {
    // Buka halaman pratinjau cetak dalam jendela baru
    var url = "{{ url('SlipGajiPdf') }}"+"/"+id+"/"+date;
    var printWindow = window.open(url, '_blank');
    
    // Tunggu jendela baru selesai memuat
    printWindow.onload = function() {
      // Tampilkan pratinjau cetak
      printWindow.print();
    };
//   });
}
   </script> 
 
</body>

</html>