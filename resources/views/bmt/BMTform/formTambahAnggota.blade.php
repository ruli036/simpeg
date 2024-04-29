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
                                            <form id="surat" name="slip"  class="user" method="POST" action="{{url('tambah-anggota-bmt')}}" enctype="multipart/form-data">
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
                                                    <div class="col-sm-1 "><br>
                                                        <span>
                                                            <a class="btn btn-primary" data-toggle="modal" data-target="#modaldata">
                                                                <i class="fas fa-search"></i>
                                                            </a>
                                                         </span>
                                                     </div>
                                                </div> 
                                                 <div class="form-group row d-none">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-id-badge"></i>
                                                        <span>Nomor NIK</span>
                                                            <input id="id_karyawan" type="text" value="{{old('id_karyawan')}}" class="form-control form-control-user @error('id_karyawan') is-invalid @enderror" name="id_karyawan" readonly   placeholder="ID Karyawan" required >
                                                             @error('id_karyawan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>                             
                                                 <div class="form-group row ">
                                                    <div class="col-sm-6 mb-6 mb-sm-0">
                                                        <i class="fas fa-calendar"></i>
                                                        <span>Mulai Bergabung</span>
                                                            <input id="tgl_gabung" value="{{old('tgl_gabung')}}" type="date" class="form-control form-control-user @error('tgl_gabung') is-invalid @enderror" name="tgl_gabung"  placeholder="Tanggal Bergabung" required >
                                                             @error('tgl_gabung')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div> 
                                                    <div class="col-sm-6 mb-6 mb-sm-0">
                                                        <i class="fa fa-credit-card"></i>
                                                        <span>No Rekening</span>
                                                            <input id="no_rek" value="{{old('no_rek')}}" type="text" maxlength="20" class="form-control form-control-user @error('no_rek') is-invalid @enderror" name="no_rek"  placeholder="Nomor Rekening" required >
                                                             @error('no_rek')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                     <div class="form-group row ">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Setoran Awal</span>
                                                        <input id="setor_awal" type="text" value="0" maxlength="100" class="text-right form-control form-control-user number-separator @error('setor_awal') is-invalid @enderror" name="setor_awal"  placeholder="Setoran Awal" required >
                                                        @error('setor_awal')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Biaya Administrasi</span>
                                                        <input id="adm" type="text" maxlength="100" class="text-right form-control form-control-user number-separator @error('adm') is-invalid @enderror" name="adm"  placeholder="Administrasi" required >
                                                        @error('adm')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
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
                                        <button class="btn btn-xs btn-info" id="select" data-id_karyawan ="{{$item->id}}" data-nama ="{{$item->name}}">
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
                var item_nik = $(this).data('id_karyawan');
                var item_nama = $(this).data('nama');
                $('#id_karyawan').val(item_nik);
                $('#nama').val(item_nama);
                $('#modaldata').modal('hide');
                });

          
         });      
        
 

          
     
   </script> 
</body>

</html> 
