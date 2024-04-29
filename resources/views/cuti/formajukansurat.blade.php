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
                                            <h1 class="h4 text-gray-900 mb-4">Form Pengajuan Surat Cuti!</h1>
                                        </div>
                                        @if ($message = Session::get('warning'))
                                        <div class="alert alert-danger alert-block">
                                          <button type="button" class="close" data-dismiss="alert">×</button>    
                                          <strong class="text-capitalize">{{ $message }}</strong>
                                        </div>
                                        @endif
                                        @if ($message = Session::get('info'))
                                        <div class="alert  alert-primary alert-block">
                                          <button type="button" class="close" data-dismiss="alert">×</button>    
                                          <strong class="text-capitalize">{{ $message }}</strong>
                                        </div>
                                        @endif
                                            <form id="surat"  class="user" method="POST" action="{{ url('ajukancuti') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group">
                                                    <select  class="form-control text-capitalize @error('kategori')is-invalid @enderror"  name="kategori" id="kategori" required>     
                                                      <option  disabled selected value="0" >Pilih Kategori Cuti</option>
                                                      @foreach ($cutis as $cuti)
                                                      <option class="text-capitalize" title="Max {{$cuti->jumlah_hari}} Hari @if($cuti->sesi == '1') Tahunan @else Fleksibel @endif /  @if($cuti->file == '1') Rekomendasi Dibutuhkan @else Rekomendasi Tidak Dibutuhkan @endif" value="{{$cuti->id_cuti}}" {{ old('kategori')== $cuti->id_cuti ? 'selected':''}}>{{$cuti->jenis}}  </option>
                                                      @endforeach
                                                    </select>
                                                  </div> 
                                                 @error('kategori')
                                                 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                 </span>
                                                @enderror 
                                                <div class="form-group" id="Jumlah">
                                                    <i class="fas fa-calculator"></i>
                                                    <span>Jumlah Cuti</span>
                                                        <input id="jumlah" type="number" class="form-control form-control-user @error('jumlah') is-invalid @enderror" name="jumlah" value="{{ old('jumlah') }}"  placeholder="Hari" required >
                                                @error('jumlah')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div> 
                                                 <div class="form-group row ">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-calendar-week"></i>
                                                            <span>Tanggal Mulai Cuti</span>
                                                                <input id="tgl_mulai" type="date" class="form-control form-control-user @error('tgl_mulai') is-invalid @enderror" name="tgl_mulai" value="{{ old('tgl_mulai') }}"  required >
                                                        @error('tgl_mulai')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                            <i class="fas fa-calendar-week"></i>
                                                            <span>Tanggal Akhir Cuti</span>
                                                                <input id="tgl_akhir" type="date" class="form-control form-control-user @error('tgl_akhir') is-invalid @enderror" name="tgl_akhir" value="{{ old('tgl_akhir') }}"  required >
                                                        @error('tgl_akhir')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror                    
                                                    </div>
                                                </div>
                                            <div class="form-group">
                                                <i class="fas fa-file fa-cog"></i>
                                                <span>Keterangan</span>
                                                <textarea name="ket"  class="form-control @error('ket') is-invalid @enderror" placeholder="Keterangan" id="ket" cols="30" rows="5" required>{{ old('ket') }}</textarea>
                                             @error('ket')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>  
                                             <label class="text-danger" for="">PENTING!</label><br>
                                            <label class="text-warning" for="">( Jika Menggambil CUTI SAKIT BERAT Harap Menyertakan Surat Rekomendasi Dokter )</label>
                                            <div class="form-group">
                                                <i class="fas fa-calendar-week"></i>
                                                <span>Surat Rekom Dokter</span><br>
                                                    <input id="file" type="file" class="  @error('file') is-invalid @enderror" name="file" >
                                            @error('file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                             <button id="go" type="submit" class="btn btn-primary btn-user btn-block">
                                                {{ __('Ajukan Surat') }}
                                            </button>
                                        </form>
                                         
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
                        <span>Copyright &copy; Your Website 2021</span>
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

   <script>
        $(document).ready(function () {
        $("button#go").click(function(e){
        e.preventDefault();
            document.getElementById("surat").submit();
            $.LoadingOverlay("show");});
        });
        $("button#uploude").click(function(e){
        e.preventDefault();
            document.getElementById("form").submit();
            $.LoadingOverlay("show");
        });
    </script>

</body>

</html>
