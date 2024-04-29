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
                                            <h1 class="h4 text-gray-900 mb-4">Form Slip Gaji Karyawan!</h1>
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
                                            <form id="surat" name="slip"  class="user" method="POST" action="{{url('tambahdata')}}" enctype="multipart/form-data">
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
                                                 <div class="form-group ">
                                                        <i class="fas fa-user-graduate"></i>
                                                    <span>Jabatan</span>
                                                        <input id="jabatan" type="text" readonly value="{{old('jabatan')}}"  class=" form-control form-control-user @error('jabatan') is-invalid @enderror" name="jabatan"    placeholder="Jabatan"  >
                                                         @error('jabatan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div> 
                                                 <div class="form-group row ">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-id-badge"></i>
                                                        <span>Nomor NIK</span>
                                                            <input id="nik" type="text" value="{{old('nik')}}" class="form-control form-control-user @error('nik') is-invalid @enderror" name="nik" readonly   placeholder="Nomor NIK" required >
                                                             @error('nik')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <i class="fas fa-calendar"></i>
                                                        <span>Tahun Mulai Bekerja</span>
                                                        <input id="tahun" type="text" value="{{old('tahun')}}" class="form-control form-control-user @error('tahun') is-invalid @enderror" name="tahun"  readonly placeholder="Tahun Mulai Bekerja" required >
                                                        @error('tahun')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                </div>
                                                 <div class="form-group row ">
                                                    <div class="col-sm-6 ">
                                                        <i class="fas fa-calendar"></i>
                                                        <span>Divisi</span>
                                                        <input id="divisi" type="text" value="{{old('divisi')}}" class="form-control form-control-user @error('divisi') is-invalid @enderror" name="divisi"  readonly placeholder="Divisi" required >
                                                        @error('divisi')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-calendar"></i>
                                                        <span>Status Karyawan</span>
                                                        <input id="sts_karyawan" type="text"  value="{{old('sts_karyawan')}}" class="form-control form-control-user @error('sts_karyawan') is-invalid @enderror" name="sts_karyawan"  readonly placeholder="Status Karyawan" required >
                                                        @error('sts_karyawan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                 </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-6">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        <span>Bulan</span>
                                                        <select class="form-control @error('bulan')is-invalid @enderror" id="bulan" name="bulan" required>
                                                            <option disabled selected value="0">Pilih Bulan...</option>
                                                             <option class="text-capitalize" id="select"  value="01" {{old('bulan')== '01' ? 'selected':''}}>Januari</option>
                                                             <option class="text-capitalize" id="select"  value="02" {{old('bulan')== '02' ? 'selected':''}}>Febuari</option>
                                                             <option class="text-capitalize" id="select"  value="03" {{old('bulan')== '03' ? 'selected':''}}>Maret</option>
                                                             <option class="text-capitalize" id="select"  value="04" {{old('bulan')== '04' ? 'selected':''}}>April</option>
                                                             <option class="text-capitalize" id="select"  value="05" {{old('bulan')== '05' ? 'selected':''}}>Mei</option>
                                                             <option class="text-capitalize" id="select"  value="06" {{old('bulan')== '06' ? 'selected':''}}>Juni</option>
                                                             <option class="text-capitalize" id="select"  value="07" {{old('bulan')== '07' ? 'selected':''}}>Juli</option>
                                                             <option class="text-capitalize" id="select"  value="08" {{old('bulan')== '08' ? 'selected':''}}>Agustus</option>
                                                             <option class="text-capitalize" id="select"  value="09" {{old('bulan')== '09' ? 'selected':''}}>September</option>
                                                             <option class="text-capitalize" id="select"  value="10" {{old('bulan')== '10' ? 'selected':''}}>Oktober</option>
                                                             <option class="text-capitalize" id="select"  value="11" {{old('bulan')== '11' ? 'selected':''}}>November</option>
                                                             <option class="text-capitalize" id="select"  value="12" {{old('bulan')== '12' ? 'selected':''}}>Desember</option>
                                                          </select>
                                                          @error('bulan')
                                                          <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                          </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6">
                                                        <i class="fas fa-calendar-alt"></i>
                                                        <span>Tahun</span>
                                                        <select class="form-control @error('tahun_slip')is-invalid @enderror" id="tahun_slip" name="tahun_slip" required>
                                                            <option disabled selected value="0">Pilih Tahun...</option>
                                                                <option id="select"  value="2021" {{old('tahun_slip')== '2021' ? 'selected':''}}>2021 </option>
                                                                <option id="select"  value="2022" {{old('tahun_slip')== '2022' ? 'selected':''}}>2022 </option>
                                                                <option id="select"  value="2023" {{old('tahun_slip')== '2023' ? 'selected':''}}>2023 </option>
                                                                <option id="select"  value="2024" {{old('tahun_slip')== '2024' ? 'selected':''}}>2024 </option>
                                                                <option id="select"  value="2025" {{old('tahun_slip')== '2025' ? 'selected':''}}>2025 </option>
                                                                <option id="select"  value="2026" {{old('tahun_slip')== '2026' ? 'selected':''}}>2026 </option>
                                                                <option id="select"  value="2027" {{old('tahun_slip')== '2027' ? 'selected':''}}>2027 </option>
                                                                <option id="select"  value="2028" {{old('tahun_slip')== '2028' ? 'selected':''}}>2028 </option>
                                                                <option id="select"  value="2029" {{old('tahun_slip')== '2029' ? 'selected':''}}>2029 </option>
                                                             </select>
                                                            @error('tahun_slip')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                 </div>
                                                 <div class="form-group row ">
                                                    <div class="col-sm-12 mb-6 mb-sm-0">
                                                        <i class="fas fa-id-badge"></i>
                                                        <span>Hari Kerja</span>
                                                            <input id="hari_kerja" value="{{old('hari_kerja')}}" type="text" class="form-control form-control-user @error('hari_kerja') is-invalid @enderror" name="hari_kerja"  placeholder="Hari Kerja" required >
                                                             @error('hari_kerja')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    
                                                </div>
                                                <div class="text-center">
                                                    <span >RUTIN</span> 
                                                </div>
                                                 <hr>
                                                    <div>
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Gaji Pokok</span>
                                                        <input id="gp" type="text" onkeyup="sum()"  value="0" class="text-right form-control form-control-user number-separator @error('gp') is-invalid @enderror" name="gp" placeholder="Gaji Pokok" required >
                                                        @error('gp')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                 <div class="form-group row ">
                                                    <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>BPJS Kesehatan</span>
                                                        <input id="bpjs_kesehatan_add" type="text" onkeyup="sum()"  value="0" class="text-right form-control form-control-user number-separator @error('bpjs_kesehatan_add') is-invalid @enderror" name="bpjs_kesehatan_add" placeholder="BPJS Kesehatan" required >
                                                        @error('bpjs_kesehatan_add')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>BPJS Ketenaga Kerjaan</span>
                                                        <input id="bpjs_tenagakerja_add" type="text" onkeyup="sum()" value="0" class="text-right form-control form-control-user number-separator @error('bpjs_tenagakerja_add') is-invalid @enderror" name="bpjs_tenagakerja_add" placeholder="BPJS Ketenaga Kerjaan" required >
                                                        @error('bpjs_tenagakerja_add')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                     <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Keagamaan</span>
                                                        <input id="koor_keagamaan" type="text" onkeyup="sum()" value="0" class="text-right form-control form-control-user number-separator @error('koor_keagamaan') is-invalid @enderror" name="koor_keagamaan" placeholder="Koordinator Keagamaan" required >
                                                        @error('koor_keagamaan')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Kepala Bidang </span>
                                                            <input id="kabid"  onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('kabid') is-invalid @enderror" name="kabid"  placeholder="Tunjangan Kepala Bidang" required >
                                                             @error('kabid')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                 </div>
                                                
                                                 <div class="form-group row ">
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Kepala Sekolah </span>
                                                            <input id="kpl_sekolah"  onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('kpl_sekolah') is-invalid @enderror" name="kpl_sekolah"  placeholder="Tunjangan Kepala Sekolah" required >
                                                             @error('kpl_sekolah')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Wakil Kepala Sekolah</span>
                                                        <input id="waka" onkeyup="sum()" type="text"value="0" class="text-right form-control form-control-user number-separator @error('waka') is-invalid @enderror" name="waka"  placeholder="Tunjangan Wakil Kepala Sekolah" required >
                                                        @error('waka')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                     <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Wali Kelas</span>
                                                        <input id="walas" onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('walas') is-invalid @enderror" name="walas"  placeholder="Tunjangan Wali Kelas" required >
                                                        @error('walas')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                     <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Jam+ / Kerja+</span>
                                                            <input id="jk" onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('jk') is-invalid @enderror" name="jk"  placeholder="Jam+ / Kerja+" required >
                                                             @error('jk')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Kelas</span>
                                                            <input id="koor_kelas" onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('koor_kelas') is-invalid @enderror" name="koor_kelas"  placeholder="Tunjanga Koordinator Kelas" required >
                                                             @error('koor_kelas')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Bidang Studi</span>
                                                        <input id="koor_bidang_studi" onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('koor_bidang_studi') is-invalid @enderror" name="koor_bidang_studi"  placeholder="Tunjangan Koordinator Bidang Studi" required >
                                                        @error('koor_bidang_studi')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                     <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Sapras</span>
                                                        <input id="koor_sapras" onkeyup="sum()" type="text"value="0" class="text-right form-control form-control-user number-separator @error('koor_sapras') is-invalid @enderror" name="koor_sapras"  placeholder="Tunjangan Koordinator Sapras" required >
                                                        @error('koor_sapras')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                     <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator PAB</span>
                                                        <input id="koor_pab" onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('koor_pab') is-invalid @enderror" name="koor_pab"  placeholder="Tunjangan Koordinator PAB" required >
                                                        @error('koor_pab')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                </div>
                                                <div class="form-group row ">
                                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator IT</span>
                                                            <input id="koor_it" onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('koor_it') is-invalid @enderror" name="koor_it"  placeholder="Tunjangan Koordinator IT" required >
                                                             @error('koor_it')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Ekstrakurikuler</span>
                                                        <input id="koor_exschool" onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('koor_exschool') is-invalid @enderror" name="koor_exschool"  placeholder="Tunjangan Koordinator Ekstrakurikuler" required >
                                                        @error('koor_exschool')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                     <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Konseling</span>
                                                        <input id="koor_konseling" onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('koor_konseling') is-invalid @enderror" name="koor_konseling"  placeholder="Tunjangan Koordinator Konseling" required >
                                                        @error('koor_konseling')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                     <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Hafalan Tahfiz</span>
                                                        <input id="tahfiz"  onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('tahfiz') is-invalid @enderror" name="tahfiz"  placeholder="Tahfiz" required >
                                                        @error('tahfiz')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                </div>
                                                 <div class="form-group row ">
                                                     <div class="col-sm-3 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Tahfiz</span>
                                                            <input id="koor_tahfiz" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('koor_tahfiz') is-invalid @enderror" name="koor_tahfiz"  placeholder="Tunjangan Koordinator Tahfiz" required >
                                                             @error('koor_tahfiz')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Infaq</span>
                                                        <input id="koor_infaq" type="text"onkeyup="sum()" value="0" class="text-right form-control form-control-user number-separator @error('koor_infaq') is-invalid @enderror" name="koor_infaq"  placeholder="Tunjangan Koordinator Infaq" required >
                                                        @error('koor_infaq')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                     <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator TOP 3/11 </span>
                                                        <input id="koor_top3" type="text" onkeyup="sum()" value="0" class="text-right form-control form-control-user number-separator @error('koor_top3') is-invalid @enderror" name="koor_top3"  placeholder="Tunjangan Koordinator TOP 3/11" required >
                                                        @error('koor_top3')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                     <div class="col-sm-3 ">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>THR</span>
                                                        <input id="thr" type="text" onkeyup="sum()"value="0" class="text-right form-control form-control-user number-separator @error('thr') is-invalid @enderror" name="thr"  placeholder="THR" required >
                                                        @error('thr')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>        
                                                 </div>
                                                  <div class="form-group row ">
                                                     <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator muhadasah</span>
                                                            <input id="koor_muhadasah" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('koor_muhadasah') is-invalid @enderror" name="koor_muhadasah"  placeholder="Tunjangan Koordinator Mudahasah" required >
                                                             @error('koor_muhadasah')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                     <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Katering</span>
                                                            <input id="koor_katering" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('koor_katering') is-invalid @enderror" name="koor_katering"  placeholder="Tunjangan Koordinator Katering" required >
                                                             @error('koor_katering')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                      <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator TFL</span>
                                                            <input id="koor_tfl" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('koor_tfl') is-invalid @enderror" name="koor_tfl"  placeholder="Tunjangan Koordinator TFL" required >
                                                             @error('koor_tfl')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Mading</span>
                                                            <input id="koor_mading" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('koor_mading') is-invalid @enderror" name="koor_mading"  placeholder="Tunjangan Koordinator Mading" required >
                                                             @error('koor_mading')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                  </div>
                                                <div class="form-group row ">
                                                     <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Dana Bos</span>
                                                            <input id="koor_dana_bos" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('koor_dana_bos') is-invalid @enderror" name="koor_dana_bos"  placeholder="Tunjangan Koordinator Dana Bos" required >
                                                             @error('koor_dana_bos')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Osis</span>
                                                            <input id="koor_osis" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('koor_osis') is-invalid @enderror" name="koor_osis"  placeholder="Tunjangan Koordinator Osis" required >
                                                             @error('koor_osis')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                      <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Lab IT</span>
                                                            <input id="koor_lab_it" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('koor_lab_it') is-invalid @enderror" name="koor_lab_it"  placeholder="Tunjangan Koordinator Lab IT" required >
                                                             @error('koor_lab_it')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator BMT</span>
                                                            <input id="koor_bmt" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('koor_bmt') is-invalid @enderror" name="koor_bmt"  placeholder="Tunjangan Koordinator BMT" required >
                                                             @error('koor_bmt')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    </div>
                                                      <div class="form-group row ">
                                                    
                                                    <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Umrah</span>
                                                            <input id="koor_umrah" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('koor_umrah') is-invalid @enderror" name="koor_umrah"  placeholder="Tunjangan Koordinator Umrah" required >
                                                             @error('koor_umrah')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Koordinator Kelas Inspirasi</span>
                                                            <input id="koor_kelas_isp" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('koor_kelas_isp') is-invalid @enderror" name="koor_kelas_isp"  placeholder="Tunjangan Koordinator Kelas Inspirasi" required >
                                                             @error('koor_kelas_isp')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                     
                                                    <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Sertifikasi</span>
                                                            <input id="sertifikasi" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('sertifikasi') is-invalid @enderror" name="sertifikasi"  placeholder="Tunjangan Sertifikasi" required >
                                                             @error('sertifikasi')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Pramuka</span>
                                                            <input id="pramuka" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('pramuka') is-invalid @enderror" name="pramuka"  placeholder="Tunjangan Pramuka" required >
                                                             @error('pramuka')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                  </div>
                                                    <div class="form-group row ">
                                                        <div class="col-sm-3">
                                                            <i class="fas fa-money-bill-wave-alt"></i>
                                                            <span>Operator Yayasan</span>
                                                                <input id="operator" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('operator') is-invalid @enderror" name="operator"  placeholder="Tunjangan Operator" required >
                                                                 @error('operator')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Publikasi Dokumentasi </span>
                                                            <input id="pubdoc" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('pubdoc') is-invalid @enderror" name="pubdoc"  placeholder="Tunjangan Publikasi Dokumentasi" required >
                                                             @error('pubdoc')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Laboran </span>
                                                            <input id="laboran" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('laboran') is-invalid @enderror" name="laboran"  placeholder="Tunjangan Laboran" required >
                                                             @error('laboran')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Taller</span>
                                                            <input id="taller" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('taller') is-invalid @enderror" name="taller"  placeholder="Tunjangan Taller" required >
                                                             @error('taller')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                  </div>
                                 
                                                 <div class="form-group">
                                                    <i class="fas fa-money-bill-wave-alt"></i>
                                                    <span>Total Tunjangan</span>
                                                    <input id="total_tunjangan" readonly type="text"  value="0" class="text-right form-control form-control-user number-separator @error('total_tunjangan') is-invalid @enderror" name="total_tunjangan"  placeholder="Total Tunjangan" required >
                                                    @error('total_tunjangan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }} </strong>
                                                        </span>
                                                    @enderror
                                                 </div>
                                                 <div class="text-center">
                                                    <span>UANG TAMBAHAN</span> 
                                                </div>
                                                <hr>
                                                <div class="form-group row ">
                                                <div class="col-sm-6 ">
                                                    <i class="fas fa-money-bill-wave-alt"></i>
                                                    <span>Uang Jam Siang </span>
                                                    <input id="jam_tambahan" onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('jam_tambahan') is-invalid @enderror" name="jam_tambahan"  placeholder="Uang Jam Siang" required >
                                                    @error('jam_tambahan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }} </strong>
                                                        </span>
                                                    @enderror
                                                 </div>
                                                  <div class="col-sm-6 ">
                                                    <i class="fas fa-money-bill-wave-alt"></i>
                                                    <span>Uang Jam Ganti</span>
                                                    <input id="jam_ganti" onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('jam_ganti') is-invalid @enderror" name="jam_ganti"  placeholder="Uang Jam Ganti" required >
                                                    @error('jam_ganti')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }} </strong>
                                                        </span>
                                                    @enderror
                                                 </div>
                                                 </div>
                                                <div class="form-group row ">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Uang Harian</span>
                                                        <input id="uang_harian" onkeyup="sum()" type="text" value="0" class="text-right form-control form-control-user number-separator @error('uang_harian') is-invalid @enderror" name="uang_harian"  placeholder="Uang Harian" required >
                                                        @error('uang_harian')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-6 ">
                                                        <i class="fas fa-calendar"></i>
                                                        <span>Lembur Kegiatan</span>
                                                        <input id="lembur_kegiatan" type="text" onkeyup="sum()" value="0" class="text-right form-control form-control-user number-separator @error('lembur_kegiatan') is-invalid @enderror" name="lembur_kegiatan"  placeholder="Lembur Kegiatan" required >
                                                        @error('lembur_kegiatan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }} </strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 ">
                                                    <i class="fas fa-calendar"></i>
                                                    <span>Piket Siang</span>
                                                    <input id="lembur_harian" type="text" onkeyup="sum()" value="0" class="text-right form-control form-control-user number-separator @error('lembur_harian') is-invalid @enderror" name="lembur_harian"  placeholder="Lembur Harian" required >
                                                    @error('lembur_harian')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }} </strong>
                                                        </span>
                                                    @enderror
                                                 </div>
                                                 <div class="col-sm-6 ">
                                                    <i class="fas fa-money-bill-wave-alt"></i>
                                                    <span>Uang Lembur</span>
                                                    <input id="gl" type="text" onkeyup="sum()" value="0" class="text-right form-control form-control-user number-separator @error('gl') is-invalid @enderror" name="gl" placeholder="Uang Lembur" required >
                                                    @error('gl')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }} </strong>
                                                        </span>
                                                    @enderror
                                                 </div> 
                                                </div>
                                               
                                                  <div class="form-group">
                                                    <i class="fas fa-money-bill-wave-alt"></i>
                                                    <span>Total Uang Tambahan</span>
                                                    <input id="total_uang_tambahan" readonly type="text"  value="0" class="text-right form-control form-control-user number-separator @error('total_uang_tambahan') is-invalid @enderror" name="total_uang_tambahan"  placeholder="Total Uang Tambahan" required >
                                                    @error('total_uang_tambahan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }} </strong>
                                                        </span>
                                                    @enderror
                                                 </div>
                                                 <div class="text-center">
                                                    <span>BONUS</span> 
                                                </div>
                                                <hr>
                                                <div class="field_wrapper">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                    <input class="form-control form-control-user " placeholder="Keterangan" type="text" name="ket[]" value=""/>
                                                            </div>
                                                            <div class="col-md-5">
                                                                    <input class="text-right form-control form-control-user number-separator" onkeyup="sum()" placeholder="Jumlah" type="text" name="upah_tambahan[]" value=""/ >
                                                            </div>
                                                            <div class="col-sm-1" style="padding-top:5px ">
                                                                    <a class="btn btn-success btn-circle text-center" href="javascript:void(0);" id="add_button" title="Add field"> <i class="fas fa-plus-circle fa-lg"></i></a>
                                                            </div>           
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="text-center">
                                                    <span>PEMOTONGAN</span> 
                                                </div>
                                                <hr>
                                                <div class="form-group row ">
                                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>BPJS Ketenaga Kerjaan Yayasan</span>
                                                            <input id="bpjs_tenagakerja_min_y" type="text" onkeyup="sum()" value="0" class="text-right form-control form-control-user number-separator @error('bpjs_tenagakerja_min_y') is-invalid @enderror" name="bpjs_tenagakerja_min_y"  placeholder="BPJS Ketenaga Kerjaan Di Tanggung Yayasan" required >
                                                             @error('bpjs_tenagakerja_min_y')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>BPJS Ketenaga Kerjaan Pribadi</span>
                                                            <input id="bpjs_tenagakerja_min_p" type="text" onkeyup="sum()" value="0" class="text-right form-control form-control-user number-separator @error('bpjs_tenagakerja_min_p') is-invalid @enderror" name="bpjs_tenagakerja_min_p"  placeholder="BPJS Ketenaga Kerjaan Di Tanggung Pribadi" required >
                                                             @error('bpjs_tenagakerja_min_p')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                     
                                                     <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>BPJS Kesehatan Yayasan</span>
                                                            <input id="bpjs_kesehatan_min_y" type="text" onkeyup="sum()"  value="0" class="text-right form-control form-control-user number-separator @error('bpjs_kesehatan_min_y') is-invalid @enderror" name="bpjs_kesehatan_min_y"  placeholder="BPJS Kesehatan Di Tanggung Yayasan" required >
                                                             @error('bpjs_kesehatan_min_y')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror   
                                                    </div>
                                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>BPJS Kesehatan Pribadi</span>
                                                            <input id="bpjs_kesehatan_min_p" type="text" onkeyup="sum()"  value="0" class="text-right form-control form-control-user number-separator @error('bpjs_kesehatan_min_p') is-invalid @enderror" name="bpjs_kesehatan_min_p"  placeholder="BPJS Kesehatan Di Tanggung Pribadi" required >
                                                             @error('bpjs_kesehatan_min_p')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                     <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Hikmah Wakilah</span>
                                                            <input id="hikmah_wakilah" type="text" onkeyup="sum()"  value="0" class="text-right form-control form-control-user number-separator @error('hikmah_wakilah') is-invalid @enderror" name="hikmah_wakilah"  placeholder="Hikmah Wakilah" required >
                                                             @error('hikmah_wakilah')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                     <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Dana Sosial</span>
                                                            <input id="dana_sosial" type="text" onkeyup="sum()"  value="0" class="text-right form-control form-control-user number-separator @error('dana_sosial') is-invalid @enderror" name="dana_sosial"  placeholder="Dana Sosial" required >
                                                             @error('dana_sosial')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                      <div class="col-sm-4">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>BMT</span>
                                                        <input id="bmt" type="text" onkeyup="sum()" value="0" class="text-right form-control form-control-user number-separator @error('bmt') is-invalid @enderror" name="bmt"  placeholder="BMT" required >
                                                        @error('bmt')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }} </strong>
                                                            </span>
                                                        @enderror
                                                     </div>
                                                     <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>Daftar Ulang</span>
                                                            <input id="daftar_ulang" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('daftar_ulang') is-invalid @enderror" name="daftar_ulang"  placeholder="Daftar Ulang" required >
                                                             @error('daftar_ulang')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                                        <i class="fas fa-money-bill-wave-alt"></i>
                                                        <span>SPP</span>
                                                            <input id="spp" onkeyup="sum()" value="0" type="text" class="text-right form-control form-control-user number-separator @error('spp') is-invalid @enderror" name="spp"  placeholder="SPP" required >
                                                             @error('spp')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                 </div>

                                                 <div class="form-group">
                                                    <i class="fas fa-money-bill-wave-alt"></i>
                                                    <span>Total Potongan</span>
                                                    <input id="potongan" readonly type="text"  value="0" onkeyup="sum()" class="text-right form-control form-control-user number-separator @error('potongan') is-invalid @enderror" name="potongan"  placeholder="Total Potongan" required >
                                                    @error('potongan')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }} </strong>
                                                        </span>
                                                    @enderror
                                                 </div>
                                                 <div class="form-group">
                                                    <i class="fas fa-money-bill-wave-alt"></i>
                                                    <span>Total Keseluruhan</span>
                                                    <input id="total" type="text" readonly value="0" class="text-right form-control form-control-user number-separator @error('total') is-invalid @enderror" name="total"  placeholder="Total Keseluruhan" required >
                                                    @error('total')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }} </strong>
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
                                <th>Masa Kerja</th>
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
                                     <td>{{$item->tgl_mulai_bekerja}}</td>
                                     <td>{{$item->status_karyawan}}</td>
                                      <td class="text-center"> 
                                        <button class="btn btn-xs btn-info" id="select" data-nik ="{{$item->nik}}" data-jabatan ="{{$item->jabatan}}" data-status ="{{$item->status}}" data-sts_karyawan ="{{$item->status_karyawan}}" data-divisi ="{{$item->divisi}}" data-nama ="{{$item->name}}"data-tahun ="{{substr($item->tgl_mulai_bekerja,-4)}}">
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
                var item_nik = $(this).data('nik');
                var item_nama = $(this).data('nama');
                var item_tahun = $(this).data('tahun');
                var item_divisi = $(this).data('divisi');
                var item_sk = $(this).data('sts_karyawan');
                var item_jabatan = $(this).data('jabatan');
                $('#nik').val(item_nik);
                $('#nama').val(item_nama);
                $('#tahun').val(item_tahun);
                $('#divisi').val(item_divisi);
                $('#sts_karyawan').val(item_sk);
                $('#jabatan').val(item_jabatan);
                $('#modaldata').modal('hide');
                });

                  var maxField = 5; //Input fields increment limitation
                    var addButton = $('#add_button'); //Add button selector
                    var wrapper = $('.field_wrapper'); //Input field wrapper
                    var fieldHTML = '<div class="form-group add"><div class="row">';
                    fieldHTML=fieldHTML + '<div class="col-md-6"><input class="form-control form-control-user " placeholder="Keterangan" type="text" name="ket[]" value=""/></div><div class="col-md-5"><input class="text-right form-control form-control-user number-separator" onkeyup="sum()" placeholder="Jumlah" type="text" name="upah_tambahan[]" value=""/> </div>';
                    fieldHTML=fieldHTML + '<div class="col-md-1" style="padding-top:5px "><a href="javascript:void(0);" class="remove_button btn btn-circle btn-danger"><i class="fas fa-minus-circle fa-lg"></i></a></div>';
                    fieldHTML=fieldHTML + '</div></div>'; 
                    var x = 1; //Initial field counter is 1
                    //Once add button is clicked
                    $(addButton).click(function(){
                        //Check maximum number of input fields
                        if(x < maxField){ 
                            x++; //Increment field counter
                            $(wrapper).append(fieldHTML); //Add field html
                        }
                    });
                    
                    //Once remove button is clicked
                    $(wrapper).on('click', '.remove_button', function(e){
                        e.preventDefault();
                        $(this).parent('').parent('').remove(); //Remove field html
                        x--; //Decrement field counter
                    });
         });      
        
 
          function sum() {
                var bpjs_tenagakerja_add = removeComma(document.getElementById("bpjs_tenagakerja_add").value) == "" ? 0 : removeComma(document.getElementById("bpjs_tenagakerja_add").value);
                var bpjs_kesehatan_add = removeComma(document.getElementById("bpjs_kesehatan_add").value) == "" ? 0 : removeComma(document.getElementById("bpjs_kesehatan_add").value);
                var bpjs_tenagakerja_min_y = removeComma(document.getElementById("bpjs_tenagakerja_min_y").value) == "" ? 0 : removeComma(document.getElementById("bpjs_tenagakerja_min_y").value);
                var bpjs_tenagakerja_min_p = removeComma(document.getElementById("bpjs_tenagakerja_min_p").value) == "" ? 0 : removeComma(document.getElementById("bpjs_tenagakerja_min_p").value);
                var bpjs_kesehatan_min_y = removeComma(document.getElementById("bpjs_kesehatan_min_y").value) == "" ? 0 : removeComma(document.getElementById("bpjs_kesehatan_min_y").value);
                var bpjs_kesehatan_min_p = removeComma(document.getElementById("bpjs_kesehatan_min_p").value) == "" ? 0 : removeComma(document.getElementById("bpjs_kesehatan_min_p").value);
                var bmt = removeComma(document.getElementById('bmt').value) == "" ? 0 : removeComma(document.getElementById('bmt').value);
                var spp = removeComma(document.getElementById('spp').value) == "" ? 0 : removeComma(document.getElementById('spp').value);
                var daftar_ulang = removeComma(document.getElementById('daftar_ulang').value) == "" ? 0 : removeComma(document.getElementById('daftar_ulang').value);
                var hikmah_wakilah = removeComma(document.getElementById('hikmah_wakilah').value) == "" ? 0 : removeComma(document.getElementById('hikmah_wakilah').value);
                var dana_sosial = removeComma(document.getElementById('dana_sosial').value) == "" ? 0 : removeComma(document.getElementById('dana_sosial').value);
                var item_GP = removeComma(document.getElementById('gp').value) == "" ? 0 : removeComma(document.getElementById('gp').value);
                var item_GL = removeComma(document.getElementById('gl').value) == "" ? 0 :  removeComma(document.getElementById('gl').value);
                var koor_dana_bos = removeComma(document.getElementById('koor_dana_bos').value) == "" ? 0 : removeComma(document.getElementById('koor_dana_bos').value);
                var koor_bidang_studi = removeComma(document.getElementById('koor_bidang_studi').value) == "" ? 0 : removeComma(document.getElementById('koor_bidang_studi').value);

                var koor_exschool = removeComma(document.getElementById('koor_exschool').value) == "" ? 0 : removeComma(document.getElementById('koor_exschool').value);
                var koor_bmt= removeComma(document.getElementById('koor_bmt').value) == "" ? 0 : removeComma(document.getElementById('koor_bmt').value);
                var koor_umrah = removeComma(document.getElementById('koor_umrah').value) == "" ? 0 : removeComma(document.getElementById('koor_umrah').value);
                var taller = removeComma(document.getElementById('taller').value) == "" ? 0 : removeComma(document.getElementById('taller').value);
                var koor_infaq = removeComma(document.getElementById('koor_infaq').value) == "" ? 0 : removeComma(document.getElementById('koor_infaq').value);
                var koor_it = removeComma(document.getElementById('koor_it').value) == "" ? 0 : removeComma(document.getElementById('koor_it').value);
                var koor_katering = removeComma(document.getElementById('koor_katering').value) == "" ? 0 : removeComma(document.getElementById('koor_katering').value);
                var koor_kelas = removeComma(document.getElementById('koor_kelas').value) == "" ? 0 : removeComma(document.getElementById('koor_kelas').value);
                var koor_kelas_isp = removeComma(document.getElementById('koor_kelas_isp').value) == "" ? 0 : removeComma(document.getElementById('koor_kelas_isp').value);
                var koor_konseling = removeComma(document.getElementById('koor_konseling').value) == "" ? 0 : removeComma(document.getElementById('koor_konseling').value);
                var koor_lab_it = removeComma(document.getElementById('koor_lab_it').value) == "" ? 0 : removeComma(document.getElementById('koor_lab_it').value);
                var THR = removeComma(document.getElementById('thr').value) == "" ? 0 : removeComma(document.getElementById('thr').value);
                var Tahfiz = removeComma(document.getElementById('tahfiz').value) == "" ? 0 : removeComma(document.getElementById('tahfiz').value);
                var koor_mading = removeComma(document.getElementById('koor_mading').value) == "" ? 0 : removeComma(document.getElementById('koor_mading').value);
                var waka = removeComma(document.getElementById('waka').value) == "" ? 0 : removeComma(document.getElementById('waka').value);
                var walas = removeComma(document.getElementById('walas').value) == "" ? 0 : removeComma(document.getElementById('walas').value);
                var koor_muhadasah = removeComma(document.getElementById('koor_muhadasah').value) == "" ? 0 : removeComma(document.getElementById('koor_muhadasah').value);
                var koor_osis = removeComma(document.getElementById('koor_osis').value) == "" ? 0 : removeComma(document.getElementById('koor_osis').value);
                var koor_pab = removeComma(document.getElementById('koor_pab').value) == "" ? 0 : removeComma(document.getElementById('koor_pab').value);
                var koor_sapras = removeComma(document.getElementById('koor_sapras').value) == "" ? 0 : removeComma(document.getElementById('koor_sapras').value);
                var koor_tahfiz = removeComma(document.getElementById('koor_tahfiz').value) == "" ? 0 : removeComma(document.getElementById('koor_tahfiz').value);
                var koor_tfl = removeComma(document.getElementById('koor_tfl').value) == "" ? 0 : removeComma(document.getElementById('koor_tfl').value);
                var koor_top3 = removeComma(document.getElementById('koor_top3').value) == "" ? 0 : removeComma(document.getElementById('koor_top3').value);
                var koor_keagamaan = removeComma(document.getElementById('koor_keagamaan').value) == "" ? 0 : removeComma(document.getElementById('koor_keagamaan').value);
                var sertifikasi = removeComma(document.getElementById('sertifikasi').value) == "" ? 0 : removeComma(document.getElementById('sertifikasi').value);
                var pramuka = removeComma(document.getElementById('pramuka').value) == "" ? 0 : removeComma(document.getElementById('pramuka').value);
                var pubdoc = removeComma(document.getElementById('pubdoc').value) == "" ? 0 : removeComma(document.getElementById('pubdoc').value);
                var operator = removeComma(document.getElementById('operator').value) == "" ? 0 : removeComma(document.getElementById('operator').value);
                var laboran = removeComma(document.getElementById('laboran').value) == "" ? 0 : removeComma(document.getElementById('laboran').value);
                var kabid = removeComma(document.getElementById('kabid').value) == "" ? 0 : removeComma(document.getElementById('kabid').value);
                var jam_ganti = removeComma(document.getElementById('jam_ganti').value) == "" ? 0 : removeComma(document.getElementById('jam_ganti').value);
                var leburHarian = removeComma(document.getElementById("lembur_harian").value) == "" ? 0 : removeComma(document.getElementById("lembur_harian").value);
                var lembur_kegiatan = removeComma(document.getElementById("lembur_kegiatan").value) == "" ? 0 : removeComma(document.getElementById("lembur_kegiatan").value);
                var uang_harian = removeComma(document.getElementById("uang_harian").value) == "" ? 0 : removeComma(document.getElementById("uang_harian").value);
                var kerjaPlus = removeComma(document.getElementById("jk").value) == "" ? 0 : removeComma(document.getElementById("jk").value);
                var jam_tambahan = removeComma(document.getElementById("jam_tambahan").value) == "" ? 0 : removeComma(document.getElementById("jam_tambahan").value);
                var kpl_sekolah = removeComma(document.getElementById("kpl_sekolah").value) == "" ? 0 : removeComma(document.getElementById("kpl_sekolah").value);
                // var upah_tambahan = removeComma(document.getElementById("upah_tambahan")) == null ? 0 : removeComma(document.getElementById("upah_tambahan"));

                var totalTunjangan = parseFloat(item_GP)+parseFloat(bpjs_kesehatan_add)+parseFloat(bpjs_tenagakerja_add)+parseFloat(kabid)+parseFloat(waka)+parseFloat(walas)+
                                     parseFloat(kerjaPlus)+parseFloat(koor_kelas)+parseFloat(koor_bidang_studi)+parseFloat(koor_dana_bos)+parseFloat(koor_exschool)+
                                     parseFloat(koor_infaq)+parseFloat(THR)+parseFloat(Tahfiz)+parseFloat(koor_it)+parseFloat(koor_katering)+parseFloat(koor_kelas_isp)+
                                     parseFloat(koor_konseling)+parseFloat(koor_lab_it)+parseFloat(koor_mading)+parseFloat(koor_muhadasah)+parseFloat(koor_tahfiz)+parseFloat(koor_tfl)+
                                     parseFloat(koor_osis)+parseFloat(koor_pab)+parseFloat(koor_sapras)+parseFloat(koor_top3)+parseFloat(koor_bmt)+parseFloat(koor_umrah)+parseFloat(taller)+
                                     parseFloat(sertifikasi)+parseFloat(laboran)+parseFloat(pramuka)+parseFloat(pubdoc)+parseFloat(operator)+parseFloat(koor_keagamaan)+parseFloat(kpl_sekolah);
                var totalPotongan = parseFloat(bpjs_kesehatan_min_p)+parseFloat(bpjs_kesehatan_min_y)+parseFloat(bpjs_tenagakerja_min_p)+parseFloat(bpjs_tenagakerja_min_y)+
                                    parseFloat(spp)+ parseFloat(dana_sosial)+parseFloat(hikmah_wakilah)+parseFloat(daftar_ulang)+parseFloat(bmt);
                // var uangLembur = leburHarian * 20000;
                var total_uang_tambahan = parseFloat(uang_harian) + parseFloat(item_GL)+ parseFloat(leburHarian)+ parseFloat(lembur_kegiatan)+ parseFloat(jam_tambahan)+ parseFloat(jam_ganti);
                var total = (parseFloat(totalTunjangan) + parseFloat(total_uang_tambahan)) - parseFloat(totalPotongan);
              
                // var result = result3 + result1 - result2;
                // var upah_tambahan = [document.getElementById('upah_tambahan')].length;
                // var lodash = require('lodash');
                // var sum = lodash.sum(arr);
                // let sum2 = 0;
                // for (let i = 0; i < upah_tambahan.length; i++) {
                //         sum2 +=  upah_tambahan[i];
                //     }
               
                    // document.getElementById('gl').value = number_format(uangLembur);
                    document.getElementById('total_tunjangan').value = number_format(totalTunjangan);
                    document.getElementById('potongan').value = number_format(totalPotongan);
                    document.getElementById('total_uang_tambahan').value = number_format(total_uang_tambahan);
                    document.getElementById('total').value = number_format(total);
         
     }
     function lebur(){
        var leburHarian = removeComma(document.getElementById("lembur_harian").value) == "" ? 0 : removeComma(document.getElementById("lembur_harian").value);
        var uangLembur = leburHarian * 20000
        document.getElementById('gl').value = number_format(uangLembur);
     }
          
     
   </script> 
</body>

</html> 
