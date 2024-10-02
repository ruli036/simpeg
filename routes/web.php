<?php

use App\Http\Controllers\ControllerUmum;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Route::get('pdfview',array('as'=>'pdfview','uses'=>'ItemController@pdfview'));

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('generate-pdf/{id}', [ControllerUmum::class, 'generatePDF']);
Route::get('SlipGajiPdf/{id}/{periode}', [ControllerUmum::class, 'SlipGajiPdf']);

//route daftar karayawan untuk kepala sekolah
Route::get('/daftartarkaryawan', [App\Http\Controllers\ControllerCek::class, 'daftartarkaryawan']);
Route::get('/halamangantipass', [App\Http\Controllers\ControllerCek::class, 'halamangantipass']);
Route::get('/halamanajukansurat', [App\Http\Controllers\ControllerCek::class, 'halamanajukansurat']);
Route::get('/dataftarsurattunggu', [App\Http\Controllers\ControllerCek::class, 'dataftarsurattunggu']);
Route::get('/dataftarsurattungguOB', [App\Http\Controllers\ControllerCek::class, 'dataftarsurattungguOB']);

//rekom1
Route::post('/setuju/{id}', [App\Http\Controllers\ControllerCek::class, 'setuju']);
Route::post('/ditolak/{id}', [App\Http\Controllers\ControllerCek::class, 'ditolak']);
// rekom2
Route::post('/setujuOB/{id}', [App\Http\Controllers\ControllerCek::class, 'setujuOb']);
Route::post('/ditolakOB/{id}', [App\Http\Controllers\ControllerCek::class, 'ditolakOb']);


//route halaman karyawan
Route::get('/profile', [App\Http\Controllers\ControllerKaryawan::class, 'profile']);
Route::get('/datasuratcutisaya', [App\Http\Controllers\ControllerKaryawan::class, 'datasuratcuti']);
Route::get('/datasuratdisetujui', [App\Http\Controllers\ControllerKaryawan::class, 'datasuratdisetujui']);
Route::get('/datasuratdisetujuidivisi', [App\Http\Controllers\ControllerKaryawan::class, 'datasuratdisetujuidivisi']);
Route::get('/datasuratdisetujuidivisisemua', [App\Http\Controllers\ControllerKaryawan::class, 'datasuratdisetujuidivisisemua']);
Route::get('/editsuratcuti/{id}', [App\Http\Controllers\ControllerKaryawan::class, 'editsuratcuti']);
//route karyawan edit data
Route::post('/editprofile', [App\Http\Controllers\ControllerKaryawan::class, 'editprofile']);
Route::post('/ajukancuti', [App\Http\Controllers\ControllerKaryawan::class, 'ajukancuti']);
Route::post('/gantipass', [App\Http\Controllers\ControllerKaryawan::class, 'gantipass']);
Route::post('/editajukancuti/{id}', [App\Http\Controllers\ControllerKaryawan::class, 'editajukancuti']);
Route::post('/uploudfoto', [App\Http\Controllers\DaftarUserController::class, 'uploudfoto']);


Route::delete('/hapusSurat/{id}', [App\Http\Controllers\ControllerKaryawan::class, 'hapusSurat']);
Route::delete('/hapusSuratadmin/{id}', [App\Http\Controllers\ControllerKaryawan::class, 'hapusSuratadmin']);

//route admin halaman
Route::get('/Registrasi', [App\Http\Controllers\DaftarUserController::class, 'Registrasi']);
Route::get('/datauser', [App\Http\Controllers\DaftarUserController::class, 'datauser']);
Route::get('/searchuser', [App\Http\Controllers\DaftarUserController::class, 'searchuser']);
Route::get('/profile2/{id}', [App\Http\Controllers\DaftarUserController::class, 'profile2']);
Route::get('/datausernonaktif', [App\Http\Controllers\DaftarUserController::class, 'datausernonaktif']);
//route admin edit
Route::post('/DaftarUser', [App\Http\Controllers\DaftarUserController::class, 'DaftarUser']);
Route::post('/editdatauser/{id}', [App\Http\Controllers\DaftarUserController::class, 'editdatauser']);
Route::post('/editpassuser/{id}', [App\Http\Controllers\DaftarUserController::class, 'editpassuser']);
Route::post('/nonaktif/{id}', [App\Http\Controllers\DaftarUserController::class, 'nonaktif']);
Route::post('/aktif/{id}', [App\Http\Controllers\DaftarUserController::class, 'aktif']);
Route::get('/editsuratcutidisetujui/{id}', [App\Http\Controllers\ControllerKaryawan::class, 'editsuratcutidisetujui']);
Route::post('/simpaneditsuratcuti/{id}', [App\Http\Controllers\ControllerKaryawan::class, 'simpaneditsuratcuti']);


//route admin hapus
Route::delete('/hapususer/{id}', [App\Http\Controllers\DaftarUserController::class, 'hapususer']);

//route format surat
Route::get('/formatsurat', [App\Http\Controllers\ControllerLogo::class, 'formatsurat']);
Route::get('/tambahformat', [App\Http\Controllers\ControllerLogo::class, 'halamantambah']);
Route::get('/editformat/{id}', [App\Http\Controllers\ControllerLogo::class, 'editformat']);
Route::post('/tambah', [App\Http\Controllers\ControllerLogo::class, 'tambah']);
Route::post('/editformatsurat/{id}', [App\Http\Controllers\ControllerLogo::class, 'editformatsurat']);
Route::delete('/hapusformat/{id}', [App\Http\Controllers\ControllerLogo::class, 'hapusformat']);
//route kategori jabatan
Route::get('/daftarjabatan', [App\Http\Controllers\ControllerJabatan::class, 'daftarjabatan']);
Route::get('/tambahjabatan', [App\Http\Controllers\ControllerJabatan::class, 'tambahjabatan']);
Route::get('/editjabatan/{id}', [App\Http\Controllers\ControllerJabatan::class, 'editjabatan']);
Route::post('/simpaneditjabatan/{id}', [App\Http\Controllers\ControllerJabatan::class, 'simpaneditjabatan']);
Route::post('/simpanjabatan', [App\Http\Controllers\ControllerJabatan::class, 'simpanjabatan']);
Route::delete('/hapusjabatan/{id}', [App\Http\Controllers\ControllerJabatan::class, 'hapusjabatan']);

//route slip gaji
Route::get('daftarslipgajikaryawan',  [App\Http\Controllers\ControllerSlipGaji::class, 'daftarslipgajikaryawan']);
Route::get('aproval-slip-gaji-view',  [App\Http\Controllers\ControllerSlipGaji::class, 'aprovalSlipGajiView']);
Route::post('/filter-aproval-slip-gaji', [App\Http\Controllers\ControllerSlipGaji::class, 'filterAprovalSlipGaji']);
Route::get('/approved-slip-gaji/{divisi}/{tahun}/{bulan}', [App\Http\Controllers\ControllerSlipGaji::class, 'ApprovedSlipGaji']);

Route::get('item-gaji',  [App\Http\Controllers\ControllerSlipGaji::class, 'componentGaji'])->name('component');
Route::get('searchcomponen',  [App\Http\Controllers\ControllerSlipGaji::class, 'searchcomponen'])->name('searchcomponen');
Route::get('daftarslipgaji',  [App\Http\Controllers\ControllerSlipGaji::class, 'daftarslipgaji']);
Route::get('search-slipGaji',  [App\Http\Controllers\ControllerSlipGaji::class, 'pencarianSlipGaji']);
Route::get('/detailslipgaji/{id}/{periode}', [App\Http\Controllers\ControllerSlipGaji::class, 'detailslipgaji']);
Route::post('add_component_gaji', [App\Http\Controllers\ControllerSlipGaji::class, 'addComponentGaji']);
Route::post('edit_component_gaji/{id}', [App\Http\Controllers\ControllerSlipGaji::class, 'editComponentGaji']);
Route::post('/edit_upah/{id}', [App\Http\Controllers\ControllerSlipGaji::class, 'edit_upah']);
Route::delete('hapus_component_gaji',  [App\Http\Controllers\ControllerSlipGaji::class, 'hapusComponentGaji']);
Route::delete('/hapusslip/{id}/{periode}', [App\Http\Controllers\ControllerSlipGaji::class, 'hapusslip']);
Route::delete('/hapus_upah/{id}', [App\Http\Controllers\ControllerSlipGaji::class, 'hapus_upah']);
Route::delete('/hapusriwayatimport/{id}', [App\Http\Controllers\ControllerSlipGaji::class, 'hapusriwayatimport']);
Route::delete('/hapusbanyakdata', [App\Http\Controllers\ControllerSlipGaji::class, 'hapusbanyakdata']);
Route::post('/addItemGaji', [App\Http\Controllers\ControllerSlipGaji::class, 'addItemGaji']);
Route::post('/editItemGaji', [App\Http\Controllers\ControllerSlipGaji::class, 'editItemGaji']);
Route::delete('/deleteItemGaji/{id}', [App\Http\Controllers\ControllerSlipGaji::class, 'deleteItemGaji']);

// fitur di hidden
Route::get('formslipgaji',  [App\Http\Controllers\ControllerSlipGaji::class, 'formslipgaji']);
Route::get('/editslip/{id}', [App\Http\Controllers\ControllerSlipGaji::class, 'editslip']);
Route::post('/tambahdata', [App\Http\Controllers\ControllerSlipGaji::class, 'tambahdata']);
Route::post('/simpaneditslip/{id}', [App\Http\Controllers\ControllerSlipGaji::class, 'simpaneditslip']);



// Route::get('export',  [App\Http\Controllers\ControllerSlipGaji::class, 'export']);
Route::get('exporttemplate',  [App\Http\Controllers\ControllerSlipGaji::class, 'export']);
Route::get('halamanexport',  [App\Http\Controllers\ControllerSlipGaji::class, 'halamanexport']);
Route::get('riwayatimport',  [App\Http\Controllers\ControllerSlipGaji::class, 'riwayatimport']);
Route::get('filter',  [App\Http\Controllers\ControllerSlipGaji::class, 'filter']);
Route::post('import',  [App\Http\Controllers\ControllerSlipGaji::class, 'importexcel']);
Route::get('exportslip',  [App\Http\Controllers\ControllerSlipGaji::class, 'exportslip']);

// route jenis cuti
Route::get('daftarjeniscuti',  [App\Http\Controllers\ControllerJenisCuti::class, 'daftarjeniscuti']);
Route::get('halamantambahjeniscuti',  [App\Http\Controllers\ControllerJenisCuti::class, 'tambahjeniscuti']);
Route::get('halamaneditjeniscuti/{id}',  [App\Http\Controllers\ControllerJenisCuti::class, 'editjeniscuti']);
Route::post('simpanjeniscuti',  [App\Http\Controllers\ControllerJenisCuti::class, 'simpanjeniscuti']);
Route::post('simpaneditjeniscuti/{id}',  [App\Http\Controllers\ControllerJenisCuti::class, 'simpaneditjeniscuti']);
Route::delete('/hapusjeniscuti/{id}', [App\Http\Controllers\ControllerJenisCuti::class, 'hapusjeniscuti']);
Route::delete('/hapusjeniscuti/{id}', [App\Http\Controllers\ControllerJenisCuti::class, 'hapusjeniscuti']);

// route pengelolaan absensi karyawan
Route::get('absensi-masuk-harian',  [App\Http\Controllers\ControllerAbsensi::class, 'absensiMasukHarian']);
Route::get('rekap-absensi-view',  [App\Http\Controllers\ControllerAbsensi::class, 'rekapAbsensiView']);
Route::get('form-add-user-absensi-view',  [App\Http\Controllers\ControllerAbsensi::class, 'viewFormAddUserAbsensi']);
Route::get('form-add-data-absensi-view',  [App\Http\Controllers\ControllerAbsensi::class, 'viewFormAddDataAbsensi']);
Route::get('rekap-absensi-bulanan',  [App\Http\Controllers\ControllerAbsensi::class, 'rekapAbsensiBulanan']);
Route::get('Kehadiran',  [App\Http\Controllers\ControllerAbsensi::class, 'Kehadiran']);
Route::get('kehadirankaryawan',  [App\Http\Controllers\ControllerAbsensi::class, 'kehadiranKaryawan']);
Route::get('detail-absensi-karyawan-view/{id_absensi}/{tgl_awal}/{tgl_akhir}',  [App\Http\Controllers\ControllerAbsensi::class, 'detailAbsensiKaryawan']);
Route::get('export-rekap-absensi/{tgl_awal}/{tgl_akhir}/{divisi}',  [App\Http\Controllers\ControllerAbsensi::class, 'exportAbsensi']);
Route::get('format-slip-gaji/{tgl_awal}/{tgl_akhir}',  [App\Http\Controllers\ControllerAbsensi::class, 'formatExportAbsensiSlipGaji']);
Route::post('add-user-absensi',  [App\Http\Controllers\ControllerAbsensi::class, 'addUserAbsensi']);
Route::post('add-data-absensi',  [App\Http\Controllers\ControllerAbsensi::class, 'addDataAbsensi']);


// route pengelolaan untuk BMT
Route::get('daftar-anggota-bmt-view',  [App\Http\Controllers\ControllerBMT::class, 'anggotaBmt']);
Route::get('daftar-anggota-bmt-nonaktif-view',  [App\Http\Controllers\ControllerBMT::class, 'anggotaBmtNonaktif']);
Route::get('pinjaman-bmt-view',  [App\Http\Controllers\ControllerBMT::class, 'pinjamanBmt']);
Route::get('pengajuan-pinjaman-bmt-view',  [App\Http\Controllers\ControllerBMT::class, 'pengajuanPinjamanBmtAll']);
Route::get('all-penarikan-bmt-view',  [App\Http\Controllers\ControllerBMT::class, 'historyPenarikanWadiah']);
Route::get('all-pinjaman-bmt-view',  [App\Http\Controllers\ControllerBMT::class, 'pinjamanDisetujui']);
Route::get('detail-pinjaman-bmt-view/{id}',  [App\Http\Controllers\ControllerBMT::class, 'detailPinjamanDisetujui']);
Route::get('pengajuan-penarikan-wadiah-view',  [App\Http\Controllers\ControllerBMT::class, 'pengajuanPenarikanWadiahAll']);
Route::get('penarikan-wadiah-view',  [App\Http\Controllers\ControllerBMT::class, 'PenarikanWadiah']);
Route::get('form-pinjaman-view',  [App\Http\Controllers\ControllerBMT::class, 'formPinjaman']);
Route::get('form-edit-pinjaman-view/{id}',  [App\Http\Controllers\ControllerBMT::class, 'formEditPinjaman']);
Route::get('form-bayar-cicilan-pinjaman/{id}',  [App\Http\Controllers\ControllerBMT::class, 'formBayarCicilan']);
Route::get('tambah-anggota-view',  [App\Http\Controllers\ControllerBMT::class, 'formAddAnggota']);
Route::get('setoran-view',  [App\Http\Controllers\ControllerBMT::class, 'setoran']);
Route::get('pengelolaan-adm-view',  [App\Http\Controllers\ControllerBMT::class, 'pengelolaanDataAdm']);
Route::get('detail-setoran-bmt-view/{id_anggota_bmt}',  [App\Http\Controllers\ControllerBMT::class, 'detailSetoran']);
Route::get('filter-laporan-bmt-view',  [App\Http\Controllers\ControllerBMT::class, 'laporanBmtView']);
Route::get('filter-laporan-bmt',  [App\Http\Controllers\ControllerBMT::class, 'filterLaporanBMT']);
Route::get('export-laporan-bulanan-bmt',  [App\Http\Controllers\ControllerBMT::class, 'detailSetoran']);

Route::post('tambah-anggota-bmt',  [App\Http\Controllers\ControllerBMT::class, 'AddAnggota']);
Route::post('ajukan-pinjaman',  [App\Http\Controllers\ControllerBMT::class, 'AjukanPinjaman']);
Route::post('tambah-data-adm-bmt',  [App\Http\Controllers\ControllerBMT::class, 'AddADM']);
Route::post('tambah-pengeluaran-adm-bmt',  [App\Http\Controllers\ControllerBMT::class, 'AddPengeluaran']);
Route::post('simpan-setoran',  [App\Http\Controllers\ControllerBMT::class, 'simpanSetoran']);
Route::post('bayar-cicilan-pinjaman/{id}',  [App\Http\Controllers\ControllerBMT::class, 'BayarCicilan']);
Route::post('/edit-setoran-bmt/{id}', [App\Http\Controllers\ControllerBMT::class, 'editSetoran']);
Route::post('/edit-adm-bmt/{id}', [App\Http\Controllers\ControllerBMT::class, 'editADM']);
Route::post('/edit-pengeluaran-adm-bmt/{id}', [App\Http\Controllers\ControllerBMT::class, 'editPengeluaranADM']);
Route::post('/edit-anggota-bmt/{id}', [App\Http\Controllers\ControllerBMT::class, 'EditAnggotaBMT']);
Route::post('/pinjaman-setuju/{id}', [App\Http\Controllers\ControllerBMT::class, 'pinjamanSetuju']);
Route::post('/penarikan-setuju/{id}', [App\Http\Controllers\ControllerBMT::class, 'penarikanSetuju']);
Route::post('/penarikan-ditolak/{id}', [App\Http\Controllers\ControllerBMT::class, 'penarikanDitolak']);
Route::post('/pinjaman-ditolak/{id}', [App\Http\Controllers\ControllerBMT::class, 'pinjamanDitolak']);
Route::post('/nonaktif-anggota-bmt/{id}', [App\Http\Controllers\ControllerBMT::class, 'nonAKtifAnggota']);
Route::post('/selesai-tranfer/{id}', [App\Http\Controllers\ControllerBMT::class, 'selesaiTranfer']);
Route::post('/aktifkan-anggota-bmt/{id}', [App\Http\Controllers\ControllerBMT::class, 'AKtifAnggota']);
Route::post('import-bmt',  [App\Http\Controllers\ControllerBMT::class, 'importExcelBmt']);

Route::get('template-bmt',  [App\Http\Controllers\ControllerBMT::class, 'exportTemplate']);
Route::get('export-laporan-bmt',  [App\Http\Controllers\ControllerBMT::class, 'exportLaporanBMT']);
Route::get('download-surat1-bmt',  [App\Http\Controllers\ControllerBMT::class, 'getDownload1']);
Route::get('download-surat2-bmt',  [App\Http\Controllers\ControllerBMT::class, 'getDownload2']);

Route::delete('/hapus-anggota-bmt/{id}', [App\Http\Controllers\ControllerBMT::class, 'hapusAnggota']);
Route::delete('/hapus-pinjaman-disetujui/{id}', [App\Http\Controllers\ControllerBMT::class, 'hapusPinjamanDisetujui']);
Route::delete('/hapus-setoran-bmt/{id}', [App\Http\Controllers\ControllerBMT::class, 'hapusSetoran']);
Route::delete('/hapus-adm-bmt/{id}', [App\Http\Controllers\ControllerBMT::class, 'hapusADM']);
Route::delete('/hapus-pengeluaran-adm-bmt/{id}', [App\Http\Controllers\ControllerBMT::class, 'hapusPengeluaranADM']);
Route::delete('/hapus-pengajuan-pinjaman/{id}', [App\Http\Controllers\ControllerBMT::class, 'hapusPengajuanPinjaman']);
Route::delete('/hapus-penarikan-wadiah/{id}', [App\Http\Controllers\ControllerBMT::class, 'hapusPenarikanWadiah']);

// route koneksi API ke web LMS 
Route::get('/nonAktifkanUserLMS-lms/{id}', [App\Http\Controllers\DaftarUserController::class, 'nonAktifkanUserLMS']);
Route::get('/aktifkanUserLMS-lms/{id}', [App\Http\Controllers\DaftarUserController::class, 'aktifkanUserLMS']);
Route::get('/daftar-lms/{id}', [App\Http\Controllers\DaftarUserController::class, 'daftarLMS']);

Route::get('/daftar nse/{id}', [App\Http\Controllers\DaftarUserController::class, 'daftarNSE']);
Route::get('/hapus akun nse/{id}', [App\Http\Controllers\DaftarUserController::class, 'deleteAkunNse']);

// route lupa password
Route::get('forget-password', [App\Http\Controllers\ResetPassController::class, 'showForgetPasswordForm'])->name('forgetPasswordForm');
Route::post('forget-password', [App\Http\Controllers\ResetPassController::class, 'submitForgetPasswordForm'])->name('submitresetpass');
Route::get('reset-password/{token}', [App\Http\Controllers\ResetPassController::class, 'showResetPasswordForm'])->name('resetPasswordForm');
Route::post('reset-password', [App\Http\Controllers\ResetPassController::class, 'submitResetPasswordForm'])->name('submitResetPassword');
