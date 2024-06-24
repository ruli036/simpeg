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
                                            <form id="surat" name="slip"  class="user" method="POST" action="{{url('simpan-setoran')}}" enctype="multipart/form-data">
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
                                                        <span>Nomor NIK</span>
                                                            <input id="id_anggota_bmt" type="text" value="{{old('id_anggota_bmt')}}" class="form-control form-control-user @error('id_anggota_bmt') is-invalid @enderror" name="id_anggota_bmt" readonly   placeholder="ID Karyawan" required >
                                                             @error('id_anggota_bmt')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>                             
                                                 <div class="form-group row ">
                                                    <div class="col-sm-12 mb-6 mb-sm-0">
                                                        <i class="fas fa-calendar"></i>
                                                        <span>Tanggal Setoran</span>
                                                            <input id="tgl_setor" value="{{old('tgl_setor')}}" type="date" class="form-control form-control-user @error('tgl_setor') is-invalid @enderror" name="tgl_setor"  placeholder="Tanggal Setoran" required >
                                                             @error('tgl_setor')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Setoran BMT</span>
                                                        <input id="bmt" type="text" value="0" class="text-right form-control form-control-user number-separator @error('bmt') is-invalid @enderror" name="bmt"  placeholder="Setoran BMT" required >
                                                        @error('bmt')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Setoran Wadiah</span>
                                                        <input id="wadiah" type="text" value="0" class="text-right form-control form-control-user number-separator @error('wadiah') is-invalid @enderror" name="wadiah"  placeholder="Setoran Wadiah" required >
                                                        @error('wadiah')
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
                                        <button class="btn btn-xs btn-info" id="select" data-id_anggota_bmt ="{{$item->id_anggota_bmt}}" data-nama ="{{$item->name}}">
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
                var item_nik = $(this).data('id_anggota_bmt');
                var item_nama = $(this).data('nama');
                $('#id_anggota_bmt').val(item_nik);
                $('#nama').val(item_nama);
                $('#modaldata').modal('hide');
                });

          
         });      
        
 

          
     
   </script> 
</body>

</html> 
