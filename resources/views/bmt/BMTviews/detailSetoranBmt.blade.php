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
                                            <h1 class="h4 text-gray-900 mb-4">Detail Setoran BMT {{$datas[0]->name}} !</h1>
                                        </div>
                                        <table>
                                            <tr>
                                                <td>Saldo BMT </td>
                                                <td>: @currency($total->total_bmt)</td>
                                            </tr>
                                             <tr>
                                                <td> Sisa Saldo Wadiah  </td>
                                                <td>:  @currency($total->total_wadiah - $totalPenarikan)</td>
                                            </tr>
                                        </table>
                                        <hr>
                                        <div class="table-responsive table table-striped">
                                        <table class="table table-sm table-bordered text-capitalize" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="text-center bg-success text-light">
                                                <th>No</th>
                                                <th>Tanggal Setoran</th>
                                                <th>Nama</th>
                                                <th>Divisi</th>
                                                <th>BMT</th>
                                                <th>Wadiah</th>
                                                @if (Auth::user()->status == 7 ||Auth::user()->status == 0)
                                                <th>#</th>
                                                @endif
                                            </tr> 
                                            </thead>
                                           <tbody>
                                            @foreach ($datas as $item)
                                            <tr>
                                                <td>{{$no[0]++}}</td>
                                                 <td>{{date('d F Y', strtotime($item->tgl_setor))}}</td>
                                                 <td>{{$item->name}}</td>   
                                                 <td>{{$item->divisi}}</td>   
                                                 <td>@currency($item->nominal_bmt)</td>   
                                                 <td>@currency($item->nominal_wadiah)</td>  
                                                 @if (Auth::user()->status == 7 ||Auth::user()->status == 0)
                                                 <td class="text-center">
                                                    <button type="button" title="Edit" class="btn btn-primary btn btn-sm" data-toggle="modal" data-target="#exampleModalEdit{{$item->id_setoran}}">
                                                        <i class="far fa-edit"></i>
                                                    </button>
                                                    <button type="button" title="Hapus" class="btn btn-danger btn btn-sm" data-toggle="modal" data-target="#exampleModalhapus{{$item->id_setoran}}">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>    
                                                </td>   
                                                 @endif
                                            </tr>
                                            @endforeach
                                           </tbody>
                                           <tfoot>
                                            <tr>
                                                <th colspan="4">
                                                Total Dana BMT
                                            </th>
                                            <th >
                                                @currency($total->total_bmt??0)
                                            </th> 
                                             <th >
                                                @currency($total->total_wadiah??0)
                                            </th> 
                                            @if (Auth::user()->status == 7 || Auth::user()->status == 0)
                                            <th></th>
                                            @endif
                                            </tr>
                                           </tfoot>
                                        </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                </div>
                <div class="container">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Detail Penarikan Wadiah {{$datas[0]->name}} !</h1>
                                        </div>
                                        <div class="table-responsive table table-striped">
                                        <table class="table table-sm table-bordered text-capitalize" id="#" width="100%" cellspacing="0">
                                            <thead>
                                                <tr class="text-center bg-success text-light">
                                                    <th>No</th>
                                                    <th>Tanggal Pengajuan</th>
                                                    <th>Tanggal Disetujui</th>
                                                    <th>Nama</th>
                                                    <th>Keterangan</th>
                                                    <th>Nominal Penarikan Wadiah</th>
                                                </tr> 
                                            </thead>
                                           <tbody>
                                            @foreach ($penarikanWadiah as $item)
                                            <tr>
                                                <td>{{$no[1]++}}</td>
                                                 <td>{{date('d F Y', strtotime($item->tgl_pengajuan))}}</td>
                                                 <td>{{date('d F Y', strtotime($item->tgl_disetujui))}}</td>
                                                 <td>{{$item->name}}</td>   
                                                 <td>{{$item->ket_pengajuan}}</td>   
                                                 <td class="bg-warning text-light">@currency($item->nominal)</td>   
                                            </tr>
                                            @endforeach
                                           </tbody>
                                           <tfoot>
                                            <th colspan="5">
                                                Total Penarikan
                                            </th>
                                            <th class="bg-warning text-light">
                                                @currency($totalPenarikan)
                                            </th>
                                           </tfoot>
                                        </table>
                                        <div class="d-flex justify-content-end" data-aos="fade-up" >
                                            <span class="small">
                                                @if ($penarikanWadiah->currentPage()==$penarikanWadiah->lastPage())
                                                Penarikan {{$penarikanWadiah->total()}} dari {{$penarikanWadiah->total()}}
                                                {{$penarikanWadiah->links('pagination::bootstrap-4')}}
                                                @else
                                                Penarikan {{$penarikanWadiah->count() * $penarikanWadiah->currentPage()}} dari {{$penarikanWadiah->total()}}
                                                {{$penarikanWadiah->links('pagination::bootstrap-4')}}
                                                @endif
                                             
                                             </span>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                </div>
            

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        {{-- <span>Copyright &copy; Your Website 2021</span> --}}
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
        @foreach ($datas as $item)
        <!-- Button trigger modal -->
      <!-- Modal -->
      <div class="modal fade" id="exampleModalhapus{{$item->id_setoran}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Hapus Data Setoran?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"> Yakin Ingin Menghapus Setoran Tanggal <b class="text-uppercase"> {{$item->tgl_setor}} !!!</b> </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{url('/hapus-setoran-bmt',$item->id_setoran)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yakin</button>
                    </form>
            </div>
          </div>
        </div>
      </div>
      
      <div class="modal fade" id="exampleModalEdit{{$item->id_setoran}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Ubah Data Setoran?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" method="POST" action="{{url('/edit-setoran-bmt',$item->id_setoran)}}">
                    @csrf
                    <div class="form-group row ">
                        <div class="col-sm-12 mb-6 mb-sm-0">
                            <i class="fas fa-calendar"></i>
                            <span>Tanggal Setoran</span>
                                <input id="tgl_setor" value="{{$item->tgl_setor}}" type="date" class="form-control form-control-user @error('tgl_setor') is-invalid @enderror" name="tgl_setor"  placeholder="Tanggal Setoran" required >
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
                            <input id="bmt" type="text" value="{{number_format($item->nominal_bmt)}}" class="text-right form-control form-control-user number-separator @error('bmt') is-invalid @enderror" name="bmt"  placeholder="Setoran BMT" required >
                            @error('bmt')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }} </strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-sm-6 ">
                            <i class="fas fa-money-bill-wave-alt"></i>
                            <span>Setoran Wadiah</span>
                            <input id="wadiah" type="text" value="{{number_format($item->nominal_wadiah)}}" class="text-right form-control form-control-user number-separator @error('wadiah') is-invalid @enderror" name="wadiah"  placeholder="Setoran Wadiah" required >
                            @error('wadiah')
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
