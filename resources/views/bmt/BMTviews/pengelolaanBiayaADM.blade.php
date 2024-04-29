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
                    <h1 class="h3 mb-2 text-gray-800">Pendapatan Biaya Administrasi BMT</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-10">
                                    <button type="button" title="Tambah Data" class="btn btn-success btn btn-sm" data-toggle="modal" data-target="#exampleModaltambah">
                                    Tambah Data
                                    </button> 
                                </div>
                              
                                <div class="col-md-2">
                                    <b> Sisa Saldo : @currency($totalPendapatanADM - $totalPengeluaranADM)</b>
                                </div>
                            </div>
                                
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-success text-light">
                                            <th style="width: 200px">Tanggal</th>
                                            <th style="width: 200px">Nama</th>
                                            <th>Divisi</th>
                                            <th>Biaya Administrasi</th>
                                            <th style="width: 200px" class="text-center">#</th>
                                        </tr>
                                    </thead>
                                     <tbody>
                                         @foreach ($data as $datas)
                                             <tr>
                                                 <td> {{date('d F Y', strtotime($datas->tgl_input))}}</td>
                                                 <td>{{$datas->name}}</td>
                                                 <td>{{$datas->divisi}}</td>
                                                 <td class="text-right ">@currency($datas->nominal)</td>
                                                 <td class="text-center"> 
                                                    <button type="button" title="Edit" class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#exampleModalEdit{{$datas->id_adm}}">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$datas->id_adm}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>  
                                                 </td>
                                             </tr>
                                         @endforeach
                                     </tbody>
                                     <tfoot>
                                        <tr>
                                            <th colspan="3">Total Pendapatan Biaya Administrasi</th>
                                            <th class="d-flex justify-content-end" colspan="2">@currency($totalPendapatanADM)</th>
                                        </tr>
                                     </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Pengeluaran Biaya Administrasi BMT</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                                <button type="button" title="Tambah Data" class="btn btn-success btn btn-sm" data-toggle="modal" data-target="#exampleModaltambahPengeluaran">
                                Tambah Data
                                </button> 
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table table-striped">
                                <table class="table table-sm table-bordered text-capitalize" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center bg-warning text-light">
                                            <th style="width: 200px">Tanggal</th>
                                            <th>Keterangan</th>
                                            <th style="width: 300px">Nominal</th>
                                            <th class="text-center" style="width: 200px">#</th>
                                        </tr>
                                    </thead>
                                    
                                     <tbody>
                                         @foreach ($pengeluaran as $datas)
                                             <tr>
                                                 <td>{{date('d F Y', strtotime($datas->tgl_pembelian))}}</td>
                                                 <td>{{$datas->ket}}</td>
                                                 <td class="text-right bg-info text-light">@currency($datas->nominal)</td>
                                                 <td class="text-center"> 
                                                    <button type="button" title="Edit" class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#exampleModalEditPengeluaran{{$datas->id_pengeluaran}}">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapusPengeluaran{{$datas->id_pengeluaran}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>  
                                                 </td>
                                             </tr>
                                         @endforeach
                                     </tbody>
                                     <tfoot>
                                        <tr>
                                            <th colspan="2">Total Pengeluaran Biaya Administrasi</th>
                                            <th  colspan="2" class="d-flex justify-content-end" >@currency($totalPengeluaranADM)</th> 
                                        </tr>
                                     </tfoot>
                                </table>
                                <div class="d-flex justify-content-end" data-aos="fade-up" >
                                    <span class="small">
                                        @if ($pengeluaran->currentPage()==$pengeluaran->lastPage())
                                        Data {{$pengeluaran->total()}} dari {{$pengeluaran->total()}}
                                        {{$pengeluaran->links('pagination::bootstrap-4')}}
                                        @else
                                        Data {{$pengeluaran->count() * $pengeluaran->currentPage()}} dari {{$pengeluaran->total()}}
                                        {{$pengeluaran->links('pagination::bootstrap-4')}}
                                        @endif
                                     
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
    @foreach ($data as $item)
        <!-- Button trigger modal -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModalhapus{{$item->id_adm}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Hapus Data Administrasi?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"> Yakin Ingin Menghapus Administrasi Ini <b class="text-uppercase">!!!</b> </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{url('/hapus-adm-bmt',$item->id_adm)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yakin</button>
                    </form>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="exampleModalEdit{{$item->id_adm}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Ubah Data Biaya Administrasi?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" method="POST" action="{{url('/edit-adm-bmt',$item->id_adm)}}">
                    @csrf
                    <div class="form-group row ">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <i class="fas fa-calendar"></i>
                            <span>Tanggal</span>
                                <input id="tgl" value="{{$item->tgl_input}}" type="date" class="form-control form-control-user @error('tgl') is-invalid @enderror" name="tgl"  placeholder="Tanggal" required >
                                 @error('tgl')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 ">
                            <i class="fas fa-money-bill-wave-alt"></i>
                            <span>Biaya Administrasi</span>
                            <input id="adm" type="text" value="{{number_format($item->nominal)}}" class="text-right form-control form-control-user number-separator @error('adm') is-invalid @enderror" name="adm"  placeholder="Biaya Administrasi" required >
                            @error('adm')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </span>
                            @enderror
                         </div>
                     </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
               
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
          </div>
        </div>
      </div>
           
    @endforeach
        <div class="modal fade" id="exampleModaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus">Tambah Data Biaya Administrasi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="user" method="POST" action="{{url('/tambah-data-adm-bmt')}}">
                        @csrf
                        <div class="form-group row ">
                            <div class="col-sm-10 mb-3 mb-sm-0">
                                <i class="fas fa-user"></i>
                            <span>Nama</span>
                                <input id="nama" type="text" readonly value="{{old('nama')}}"  class=" form-control form-control-user @error('nama') is-invalid @enderror" name="nama"    placeholder="Nama"  >
                                @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                            <div class="col-sm-2 " style="padding-top: 28px"> 
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
                                    <input id="id_karyawan" type="text" value="{{old('id_karyawan')}}" class="form-control form-control-user @error('id_karyawan') is-invalid @enderror" name="id_karyawan" readonly   placeholder="ID Karyawan" required >
                                    @error('id_karyawan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> 
                        <div class="form-group row ">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <i class="fas fa-calendar"></i>
                                <span>Tanggal</span>
                                    <input id="tgl" type="date" class="form-control form-control-user @error('tgl') is-invalid @enderror" name="tgl"  placeholder="Tanggal" required >
                                    @error('tgl')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6 ">
                                <i class="fas fa-money-bill-wave-alt"></i>
                                <span>Biaya Administrasi</span>
                                <input id="adm" type="text" value="0" class="text-right form-control form-control-user number-separator @error('adm') is-invalid @enderror" name="adm"  placeholder="Biaya Administrasi" required >
                                @error('adm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} </strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
           
      <div class="modal fade bd-example-modal-xl" id="modaldata" aria-hidden="true">
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
                            @foreach ($anggotaBmt as $item)
                                    <tr>
                                    <td>{{$item->nik}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->divisi}}</td>
                                    <td>{{$item->jabatan}}</td>
                                    <td>{{$item->status_karyawan}}</td>
                                        <td class="text-center"> 
                                        <button class="btn btn-xs btn-info" id="select" data-id_karyawan ="{{$item->id_karyawan}}" data-nama ="{{$item->name}}">
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
  
        <div class="modal fade" id="exampleModaltambahPengeluaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus">Tambah Pengeluaran Biaya Administrasi?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="user" method="POST" action="{{url('/tambah-pengeluaran-adm-bmt')}}">
                        @csrf
                        <div class="form-group row ">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <i class="fas fa-calendar"></i>
                                <span>Tanggal</span>
                                    <input id="tgl" type="date" class="form-control form-control-user @error('tgl') is-invalid @enderror" name="tgl"  placeholder="Tanggal" required >
                                    @error('tgl')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-sm-6 ">
                                <i class="fas fa-money-bill-wave-alt"></i>
                                <span>Nominal</span>
                                <input id="nominal" type="text" value="0" class="text-right form-control form-control-user number-separator @error('nominal') is-invalid @enderror" name="nominal"  placeholder="Nominal" required >
                                @error('nominal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }} </strong>
                                    </span>
                                @enderror
                            </div>                        
                        </div>
                        <div>
                            <textarea name="ket" id="ket" class=" form-control @error('ket') is-invalid @enderror"  cols="30" rows="5"  placeholder="Keterangan" required></textarea>
                            @error('ket')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </span>
                            @enderror
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
           
       
        @foreach ($pengeluaran as $item)
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="exampleModalhapusPengeluaran{{$item->id_pengeluaran}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Hapus Pengeluaran Administrasi?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"> Yakin Ingin Menghapus Data Pengeluaran Administrasi Tanggal <b class="text-uppercase"> {{$item->tgl_pembelian}}!!!</b> </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{url('/hapus-pengeluaran-adm-bmt',$item->id_pengeluaran)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yakin</button>
                    </form>
            </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="exampleModalEditPengeluaran{{$item->id_pengeluaran}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Ubah Data Pengeluaran Administrasi?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" method="POST" action="{{url('/edit-pengeluaran-adm-bmt',$item->id_pengeluaran)}}">
                    @csrf
                    <div class="form-group row ">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <i class="fas fa-calendar"></i>
                            <span>Tanggal</span>
                                <input id="tgl" type="date" value="{{$item->tgl_pembelian}}" class="form-control form-control-user @error('tgl') is-invalid @enderror" name="tgl"  placeholder="Tanggal" required >
                                @error('tgl')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 ">
                            <i class="fas fa-money-bill-wave-alt"></i>
                            <span>Nominal</span>
                            <input id="nominal" type="text" value="{{number_format($item->nominal)}}" class="text-right form-control form-control-user number-separator @error('nominal') is-invalid @enderror" name="nominal"  placeholder="Nominal" required >
                            @error('nominal')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </span>
                            @enderror
                        </div>                        
                    </div>
                    <div>
                        <textarea name="ket" id="ket" class=" form-control @error('ket') is-invalid @enderror"  cols="30" rows="5"  placeholder="Keterangan" required>{{$item->ket}}</textarea>
                        @error('ket')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }} </strong>
                            </span>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                
                    <button type="submit" class="btn btn-success">Simpan</button>
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

   <script>
$(document).ready(function () {
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