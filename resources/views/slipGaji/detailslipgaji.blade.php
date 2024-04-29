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
                <div class="container">

                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                
                                <div class="col-lg-12">
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
                                    <div class="p-5">
                                        @if (Auth::user()->status == 0 ||Auth::user()->status == 2)
                                        <button type="button" title="Hapus" class="btn btn-success btn btn-sm" data-toggle="modal" data-target="#addItem">
                                            Tambah Item Gaji 
                                        </button> 
                                        @endif
                                      
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Detail Slip Gaji {{$masukan[0]->name??""}}</h1>
                                        </div>
                                       
                                        <div class="table-responsive">
                                    <table class="table table-sm  table-striped text-capitalize" style="width: 100%">
                                        <tr>
                                            <th colspan="3">Nama </th>
                                            <td class="text-right"> {{$masukan[0]->name??""}}</td>
                                        </tr> 
                                        <tr>
                                            <th colspan="3">Jabatan </th>
                                            <td class="text-right"> {{$masukan[0]->jabatan??""}}</td>
                                        </tr> 
                                         <tr>
                                            <th colspan="3">Divisi </th>
                                            <td class="text-right"> {{$masukan[0]->divisi??""}}</td>
                                        </tr> 
                                        <tr>
                                            <th colspan="3">Periode </th>
                                            <td class="text-right"> {{date('F Y', strtotime($masukan[0]->periode??now()))}}</td>
                                        </tr> 
                                        @foreach ($datas as $item)
                                        <tr>
                                            <th colspan="3">{{$item->nama}} </th>
                                            <td class="text-right"> 
                                                {{$item->amount}} Hari
                                            </td>
                                        </tr>                                         
                                        @endforeach
                                        <tr>
                                            <th colspan="4" class="text-center">PEMASUKAN</th>
                                        </tr> 
                                        @php
                                             $totalMasukan = 0;
                                             $totalPotongan = 0;
                                              
                                        @endphp
                                        @foreach ($masukan as $item)
                                        @php
                                            $totalMasukan += $item->amount; 
                                        @endphp
                                        <tr>
                                            <th colspan="3">{{$item->nama}} </th>
                                            <td class="text-right"> 
                                                @currency($item->amount)
                                                @if (Auth::user()->status == 0 ||Auth::user()->status == 2)
                                                <a  title="Edit"  class=" text-success" style="padding-left: 10px"  data-toggle="modal" data-target="#editDataPemasukan{{$item->iditem}}">
                                                    <i class="far fa-edit"></i> 
                                                </a>  
                                                <a  title="Hapus"  class=" text-danger"  style="padding-left: 10px"  data-toggle="modal" data-target="#hapusDataPemasukan{{$item->iditem}}">
                                                    <i class="far fa-trash-alt"></i> 
                                                </a>  
                                                @endif
                                            </td>
                                           
                                        </tr>                                         
                                        @endforeach
                                         
                                        <tr style="background-color: rgb(216, 216, 80);color: white">
                                            <th colspan="3" > Subtotal Gaji</th>
                                            <td class="text-right">  
                                                @currency($totalMasukan)
                                            </td>
                                        </tr>  
                                         <tr>
                                            <th colspan="4" class="text-center">PEMOTONGAN</th>
                                        </tr> 
                                        @foreach ($potongan as $item)
                                        @php
                                        $totalPotongan += $item->amount; 
                                        @endphp
                                        <tr>
                                            <th colspan="3">{{$item->nama}} </th>
                                            <td class="text-right"> 
                                                (- @currency($item->amount))
                                                    
                                                @if (Auth::user()->status == 0 ||Auth::user()->status == 2)
                                                <a  title="Edit"  class=" text-success" style="padding-left: 10px"  data-toggle="modal" data-target="#editDataPemotongan{{$item->iditem}}">
                                                    <i class="far fa-edit"></i> 
                                                </a>  
                                                <a  title="Hapus"  class=" text-danger"  style="padding-left: 10px"  data-toggle="modal" data-target="#hapusDataPemotongan{{$item->iditem}}">
                                                    <i class="far fa-trash-alt"></i> 
                                                </a>  
                                                
                                                @endif
                                            </td>
                                        </tr>                                         
                                        @endforeach
                                        <tr style="background-color: rgb(216, 216, 80);color: white">
                                            <th colspan="3" > Total Potongan</th>
                                            <td class="text-right">  
                                                (- @currency($totalPotongan))
                                            </td>
                                        </tr>  
                                        <tr>
                                            <th colspan="4" class="text-center">TOTAL PENDAPATAN</th>
                                        </tr> 
                                        <tr style="background-color: rgb(216, 216, 80);color: white">
                                            <th colspan="3" > Total Gaji Bersih</th>
                                            <td class="text-right">  
                                                @currency($totalMasukan - $totalPotongan)
                                            </td>
                                        </tr>  
                                       
                                    </table>
                                         
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
    <div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Tambahkan Komponen Gaji?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"> 
                <form method="POST" class="user" action="{{url('/addItemGaji')}}">
                    @csrf
                    <div class="form-group">
                        <i class="fa fa-list"></i>
                        <span>Komponen Gaji </span>
                        <select class="form-control  @error('id_componen_gaji')is-invalid @enderror" id="type" value="{{ old('id_componen_gaji') }}"  name="id_componen_gaji" id="inputGroupSelect01" required>
                          @foreach ($masterGaji as $item)
                               <option value= "{{$item->id}}" {{old('id_componen_gaji')== $item->id ? 'selected':''}}>{{$item->nama}}</option>
                          @endforeach
                         
                        </select>
                        @error('id_componen_gaji')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    <div class="form-group">
                        <i class="fas fa-money-bill-wave-alt"></i>
                        <span>Nominal</span>
                        <input id="amount" type="text"  class="text-right form-control form-control-user number-separator @error('amount') is-invalid @enderror" name="amount" placeholder="Nominal" required >
                        @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }} </strong>
                            </span>
                        @enderror
                     </div>
                     
                      <input id="id_karyawan" type="hidden" value="{{$masukan[0]->id_karyawan}}" class="form-control form-control-user" name="id_karyawan">
                      <input id="jabatan" type="hidden" value="{{$masukan[0]->jabatan}}" class="form-control form-control-user" name="jabatan">
                      <input id="divisi" type="hidden" value="{{$masukan[0]->divisi}}" class="form-control form-control-user" name="divisi">
                      <input id="periode" type="hidden" value="{{$masukan[0]->periode}}" class="form-control form-control-user" name="periode">
                      <input id="stts_karyawan" type="hidden" value="{{$masukan[0]->stts_karyawan}}" class="form-control form-control-user" name="stts_karyawan">
                      <input id="id_aprov" type="hidden" value="{{$masukan[0]->id_aprov}}" class="form-control form-control-user" name="id_aprov">
                      <input id="aprov" type="hidden" value="{{$masukan[0]->aprov}}" class="form-control form-control-user" name="aprov">
                      <input id="sync" type="hidden" value="{{$masukan[0]->sync}}" class="form-control form-control-user" name="sync">
                    <button type="submit" class="btn btn-success" style="padding: 10px">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
             </div>
        </div>
        </div>
    </div>
    @foreach ($masukan as $datas)
     
    <div class="modal fade" id="hapusDataPemasukan{{$datas->iditem}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Hapus Komponen Gaji Ini?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"> Yakin Ingin Menghapus Komponen Gaji <b class="text-uppercase"> {{$datas->nama}}   </b> </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{url('/deleteItemGaji',$datas->iditem)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yakin</button>
                    </form>
            </div>
        </div>
        </div>
    </div>
     <div class="modal fade" id="editDataPemasukan{{$datas->iditem}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Ubah Nominal {{$datas->nama}}?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">  
                <form method="POST" action="{{url('/editItemGaji')}}">
                @csrf
                <div class="form-group">
                    <i class="fas fa-money-bill-wave-alt"></i>
                    <span>Nominal</span>
                    <input id="amount" type="text"  value="{{number_format($datas->amount)}}"  class="text-right form-control form-control-user number-separator @error('amount') is-invalid @enderror" name="amount" placeholder="Nominal" required >
                    @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }} </strong>
                        </span>
                    @enderror
                </div>
                <input id="iditem" type="hidden" value="{{$datas->iditem}}" class="form-control form-control-user" name="iditem">

                <button type="submit" class="btn btn-success">Simpan</button>
                </form></div>
            <div class="modal-footer">
                 
            </div>
        </div>
        </div>
    </div>
            
    @endforeach
    @foreach ($potongan as $datas)
     
    <div class="modal fade" id="hapusDataPemotongan{{$datas->iditem}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Hapus Komponen Gaji Ini?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body"> Yakin Ingin Menghapus Komponen Gaji <b class="text-uppercase"> {{$datas->nama}}   </b> </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <form method="POST" action="{{url('/deleteItemGaji',$datas->iditem)}}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Yakin</button>
                    </form>
            </div>
        </div>
        </div>
    </div>
     <div class="modal fade" id="editDataPemotongan{{$datas->iditem}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapus">Ubah Nominal {{$datas->nama}}?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">  
                <form method="POST" action="{{url('/editItemGaji')}}">
                @csrf
                <div class="form-group">
                    <i class="fas fa-money-bill-wave-alt"></i>
                    <span>Nominal</span>
                    <input id="amount" type="text"  value="{{number_format($datas->amount)}}"  class="text-right form-control form-control-user number-separator @error('amount') is-invalid @enderror" name="amount" placeholder="Nominal" required >
                    @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }} </strong>
                        </span>
                    @enderror
                </div>
                <input id="iditem" type="hidden" value="{{$datas->iditem}}" class="form-control form-control-user" name="iditem">

                <button type="submit" class="btn btn-success">Simpan</button>
                </form></div>
            <div class="modal-footer">
                 
            </div>
        </div>
        </div>
    </div>
            
    @endforeach
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
   <!-- Bootstrap core JavaScript-->
    
</body>

</html>
 