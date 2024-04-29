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
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Form Tambah Anggota BMT!</h1>
                                        </div>
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
                                            <form id="surat" name="slip"  class="user" method="POST" action="{{url('add-user-absensi')}}" enctype="multipart/form-data">
                                                @csrf
                                                  <div class="form-group row ">
                                                    <div class="col-sm-11 mb-3 mb-sm-0">
                                                        <i class="fas fa-user"></i>
                                                    <span>Nama</span>
                                                        <input id="nama" type="text" readonly value="{{old('nama')}}"  class=" form-control form-control-user @error('nama') is-invalid @enderror" name="nama"    placeholder="Nama"  >
                                                         @error('nama')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    </div>
                                                    <div class="col-sm-1 " style="padding-top: 28px"> 
                                                        <span>
                                                            <a class="btn btn-primary"  data-toggle="modal" data-target="#modaldata">
                                                                <i class="fas fa-search"></i>
                                                            </a>
                                                         </span>
                                                     </div>
                                                </div> 
                                                 <div class="form-group row d-none">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-id-badge"></i>
                                                        <span>ID Absensi Karyawan</span>
                                                            <input id="id_absensi" type="text" value="{{old('id_absensi')}}" class="form-control form-control-user @error('id_absensi') is-invalid @enderror" name="id_absensi" readonly   placeholder="ID Karyawan" required >
                                                             @error('id_absensi')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>                             
                                                <div class="form-group">
                                                    <i class="fa fa-fingerprint"></i>
                                                    <span>Perangkat Absensi </span>
                                                    <select class="form-control  @error('mesin')is-invalid @enderror" id="type" value="{{ old('mesin') }}"  name="mesin" id="inputGroupSelect01" required>
                                                      <option disabled  selected value="0">Perangkat</option>
                                                      @foreach ($mesinAbsensi as $item)
                                                           <option value= "{{$item->Id}}" {{old('mesin')== $item->sn ? 'selected':''}}>{{$item->name}}</option>
                                                      @endforeach
                                                     
                                                    </select>
                                                    @error('mesin')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                  </div>
                                                 
                                             <button id="go" type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Tambah Data') }}
                                            </button>
                                        </form>                                       
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
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
 
    <!-- Logout Modal-->
    <div class="modal fade bd-example-modal-xl" id="modaldata"  
        aria-hidden="true">
        <div class="modal-dialog modal-xl"  role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Karyawan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body table-responsive"> 
                    <table class="table table-sm table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Divisi</th>
                                <th>Jabatan</th>
                                <th>Status Karyawan</th>
                                 <th class="text-center">Fitur Tersedia</th>
                            </tr>
                        </thead>
                         <tbody>
                             @foreach ($datas as $item)
                                  <tr>
                                     <td>{{$item->nik}}</td>
                                     <td>{{$item->name}}</td>
                                     <td>{{$item->divisi}}</td>
                                     <td>{{$item->jabatan}}</td>
                                     <td>{{$item->status_karyawan}}</td>
                                      <td class="text-center"> 
                                        <button class="btn btn-xs btn-info" id="select" data-id_absensi ="{{$item->id_absensi_karyawan}}" data-nama ="{{$item->name}}">
                                            <i class="fa fa-check"></i> Select
                                        </button>
                                     </td>
                                 </tr>
                             @endforeach
                         </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                 </div>
            </div>
        </div>
    </div> 
         
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Keluar?</h5>
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
   <!-- Bootstrap core JavaScript-->
    <script>
        $(document).ready(function () {
          
        $("button#go").click(function(e){
        e.preventDefault();
            document.getElementById("surat").submit();
            $.LoadingOverlay("show");
        });
        $("button#uploude").click(function(e){
  e.preventDefault();
      document.getElementById("form").submit();
      $.LoadingOverlay("show");
  });

            $(document).on('click','#select',function(){
                var item_id_absensi = $(this).data('id_absensi');
                var item_nama = $(this).data('nama');
                $('#id_absensi').val(item_id_absensi);
                $('#nama').val(item_nama);
                $('#modaldata').modal('hide');
                });

          
         });      
        
 

          
     
   </script> 
</body>

</html> 
