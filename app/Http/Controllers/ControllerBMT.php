<?php

namespace App\Http\Controllers;

use App\Exports\BmtExport;
use App\Exports\TemplateFormatBMT;
use App\Imports\BmtImport;
use App\Mail\KirimEmail;
use App\Models\AnggotaBMT;
use App\Models\BiayaADM;
use App\Models\CicilanPinjaman;
use App\Models\Daftaruser;
use App\Models\LogEdit;
use App\Models\PenarikanWadiah;
use App\Models\PengeluaranADM;
use App\Models\PinjamanBmt;
use App\Models\RekapBmt;
use App\Models\SetoranBMT;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ControllerBMT extends Controller
{

    public function anggotaBmt()
    {
        if (Auth::check() && (Auth::user()->status == 7 || Auth::user()->status == 1 || Auth::user()->status == 4 || Auth::user()->status == 0)) {
            $aktive = "bmt";
            $data = AnggotaBMT::join('users', 'users.id', '=', 'tbl_anggota_bmt.id_karyawan')
                ->select('users.name', 'users.nik', 'users.jabatan', 'users.divisi', 'users.foto', 'tbl_anggota_bmt.*')
                ->where('sts_anggota', 0)
                ->groupBy('tbl_anggota_bmt.id_anggota_bmt')
                ->get();
            $totalUangBMT = SetoranBMT::join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_setoran_bmt.id_anggota_bmt')
                ->where('sts_anggota', 0)
                ->sum('nominal_bmt');
            $totalUangWadiah = SetoranBMT::join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_setoran_bmt.id_anggota_bmt')
                ->where('sts_anggota', 0)
                ->sum('nominal_wadiah');
            $totalPenarikan = PenarikanWadiah::join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_penarikan_wadiah.id_anggota_bmt')
                ->where('setuju1', '=', 0)
                ->where('sts_anggota', 0)
                ->sum('nominal');
            // return $totalPenarikan;
            return view('bmt.BMTviews.daftarAnggotaBmt', ['totalPenarikan' => $totalPenarikan, 'aktive' => $aktive, 'data' => $data, 'totalUangBMT' => $totalUangBMT, 'totalUangWadiah' => $totalUangWadiah]);
        } else {
            return redirect('/');
        }
    }
    public function laporanBmtView()
    {
        if (Auth::check()) {
            $aktive = "bmt";
            $datas = [];
            $filter = '';
            $totalBmt = 0;
            $totalWadiah = 0;
            return view('bmt.BMTviews.filterDataBmt', ['aktive' => $aktive, 'datas' => $datas, 'totalBmt' => $totalBmt, 'totalWadiah' => $totalWadiah, 'filter' => $filter]);
        } else {
            return redirect('/');
        }
    }

    public function filterLaporanBMT(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'bulan' => 'required',
                'tahun' => 'required',
            ]);
            $aktive = "bmt";
            $bln = $request['bulan'];
            $thn = $request['tahun'];
            $filter = $bln . ' ' . $thn;

            // $datas = SetoranBMT::rightJoin('tbl_anggota_bmt','tbl_anggota_bmt.id_anggota_bmt', '=','tbl_setoran_bmt.id_anggota_bmt')
            // ->rightJoin('users','users.id', '=','tbl_anggota_bmt.id_anggota_bmt')
            // // ->selectRaw('tbl_setoran_bmt.*','SUM(tbl_setoran_bmt.nominal_bmt) as bmt')
            // ->whereMonth('tbl_setoran_bmt.tgl_setor',$bln)
            // ->whereYear('tbl_setoran_bmt.tgl_setor',$thn)
            // ->get();  
            $datas = SetoranBMT::whereMonth('tbl_setoran_bmt.tgl_setor', $bln)
                ->whereYear('tbl_setoran_bmt.tgl_setor', $thn)->get();
            $totalBmt = SetoranBMT::whereMonth('tgl_setor', $bln)
                ->whereYear('tgl_setor', $thn)
                ->sum('nominal_bmt');
            $totalWadiah = SetoranBMT::whereMonth('tgl_setor', $bln)
                ->whereYear('tgl_setor', $thn)
                ->sum('nominal_wadiah');

            // return $datas[0];
            if (count($datas) > 0) {
                return view('bmt.BMTviews.filterDataBmt', ['aktive' => $aktive, 'datas' => $datas, 'totalBmt' => $totalBmt, 'totalWadiah' => $totalWadiah, 'filter' => $filter]);
            } else {
                return redirect()->back()->with(['info' => 'Data Tidak Ditemukan']);
            }
        } else {
            return redirect('/');
        }
    }
    public function anggotaBmtNonaktif()
    {
        if (Auth::check() && (Auth::user()->status == 7 || Auth::user()->status == 0)) {
            $aktive = "bmt";
            $data = AnggotaBMT::join('users', 'users.id', '=', 'tbl_anggota_bmt.id_karyawan')
                ->select('users.name', 'users.nik', 'users.jabatan', 'users.divisi', 'users.foto', 'tbl_anggota_bmt.*')
                ->where('sts_anggota', 1)
                ->groupBy('tbl_anggota_bmt.id_anggota_bmt')
                ->get();
            $totalUangBMT = SetoranBMT::join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_setoran_bmt.id_anggota_bmt')
                ->where('sts_anggota', 1)
                ->sum('nominal_bmt');
            $totalUangWadiah = SetoranBMT::join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_setoran_bmt.id_anggota_bmt')
                ->where('sts_anggota', 1)
                ->sum('nominal_wadiah');
            $totalPenarikan = PenarikanWadiah::join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_penarikan_wadiah.id_anggota_bmt')
                ->where('setuju1', '=', 0)
                ->where('sts_anggota', 1)
                ->sum('nominal');

            return view('bmt.BMTviews.daftarAnggotaBmtNonaktif', ['totalPenarikan' => $totalPenarikan, 'aktive' => $aktive, 'data' => $data, 'totalUangBMT' => $totalUangBMT, 'totalUangWadiah' => $totalUangWadiah]);
        } else {
            return redirect('/');
        }
    }
    public function formAddAnggota()
    {
        if (Auth::check() && (Auth::user()->status == 7 || Auth::user()->status == 0)) {
            $aktive = "bmt";
            $datas = DB::select("SELECT * from users where status != '0' AND status_kerja = '1' order by name asc ");
            return view('bmt.BMTform.formTambahAnggota', ['aktive' => $aktive, 'datas' => $datas]);
        } else {
            return redirect('/');
        }
    }

    public function formPinjaman()
    {
        if (Auth::check()) {
            $aktive = "bmt";
            return view('bmt.BMTform.formPinjamanBmt', ['aktive' => $aktive]);
        } else {
            return redirect('/');
        }
    }
    public function formBayarCicilan($id_cicilan)
    {
        if (Auth::check()) {
            $aktive = "bmt";
            return view('bmt.BMTform.formBayarCicilan', ['id_cicilan' => $id_cicilan, 'aktive' => $aktive]);
        } else {
            return redirect('/');
        }
    }
    public function pinjamanBmt()
    {
        if (Auth::check()) {
            $aktive = "bmt";
            $no = 1;
            $data = PinjamanBmt::join('users', 'users.id', '=', 'tbl_pengajuan_pinjaman.id_karyawan')
                ->select('tbl_pengajuan_pinjaman.*', 'users.nik', 'users.name')
                ->where('id_karyawan', '=', Auth::user()->id)->get();
            return view('bmt.BMTviews.pinjamanBmt', ['aktive' => $aktive, 'data' => $data, 'no' => $no]);
        } else {
            return redirect('/');
        }
    }
    public function pengajuanPinjamanBmtAll()
    {
        if (Auth::check() && (Auth::user()->status == 7 || Auth::user()->status == 1 || Auth::user()->status == 0)) {
            $aktive = "bmt";
            $no = 1;
            if (Auth::user()->status == 0 || Auth::user()->status == 7) {
                $data = PinjamanBmt::join('users', 'users.id', '=', 'tbl_pengajuan_pinjaman.id_karyawan')
                    ->select('tbl_pengajuan_pinjaman.*', 'users.nik', 'users.name', 'users.divisi', 'users.jabatan')
                    ->where('tbl_pengajuan_pinjaman.setuju1', '=', 1)
                    ->Orwhere('tbl_pengajuan_pinjaman.setuju1', '=', 0)
                    ->where('tbl_pengajuan_pinjaman.setuju2', '=', 1)
                    ->orderBy('tbl_pengajuan_pinjaman.tgl_pengajuan', 'DESC')
                    ->get();
            } else if (Auth::user()->status == 1) {
                $data = PinjamanBmt::join('users', 'users.id', '=', 'tbl_pengajuan_pinjaman.id_karyawan')
                    ->select('tbl_pengajuan_pinjaman.*', 'users.nik', 'users.name', 'users.divisi', 'users.jabatan')
                    ->where('tbl_pengajuan_pinjaman.setuju1', '=', 0)
                    ->where('tbl_pengajuan_pinjaman.setuju2', '!=', 0)
                    ->where('tbl_pengajuan_pinjaman.setuju2', '!=', 2)
                    ->orderBy('tbl_pengajuan_pinjaman.tgl_pengajuan', 'DESC')
                    ->get();
            }

            return view('bmt.BMTviews.daftarPengajuanPinjamanBmt', ['aktive' => $aktive, 'data' => $data, 'no' => $no]);
        } else {
            return redirect('/');
        }
    }
    public function historyPenarikanWadiah()
    {
        if (Auth::check() && (Auth::user()->status == 7 || Auth::user()->status == 4 || Auth::user()->status == 1 || Auth::user()->status == 0)) {
            $aktive = "bmt";
            $no = 1;
            $data = PenarikanWadiah::join('users', 'users.id', '=', 'tbl_penarikan_wadiah.id_karyawan')
                ->join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_penarikan_wadiah.id_anggota_bmt')
                ->select('tbl_penarikan_wadiah.*', 'tbl_anggota_bmt.*', 'users.nik', 'users.name', 'users.divisi', 'users.jabatan')
                ->where('tbl_penarikan_wadiah.setuju1', '=', 0)
                ->orderBy('tbl_penarikan_wadiah.tgl_disetujui', 'DESC')
                ->get();

            if (Auth::user()->status == 4) {
                $result = PenarikanWadiah::where('setuju1', '=', 0)
                    ->where('new', 1)
                    ->get();
                foreach ($result as $value) {
                    $value->new = 0;
                    $value->save();
                }
            }

            $totalPenarikan = PenarikanWadiah::all()
                ->where('setuju1', '=', 0)
                ->sum('nominal');
            return view('bmt.BMTviews.historiPenarikanWadiah', ['aktive' => $aktive, 'data' => $data, 'totalPenarikan' => $totalPenarikan, 'no' => $no]);
        } else {
            return redirect('/');
        }
    }
    public function pinjamanDisetujui()
    {
        if (Auth::check() && (Auth::user()->status == 7 || Auth::user()->status == 0 || Auth::user()->status == 1 || Auth::user()->status == 4)) {
            $aktive = "bmt";
            $no = 1;
            $data = PinjamanBmt::join('users', 'users.id', '=', 'tbl_pengajuan_pinjaman.id_karyawan')
                ->join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_pengajuan_pinjaman.id_anggota_bmt')
                ->join('tbl_cicilan_pinjaman', 'tbl_cicilan_pinjaman.id_pengajuan', '=', 'tbl_pengajuan_pinjaman.id_pengajuan')
                ->select('tbl_pengajuan_pinjaman.*', 'tbl_cicilan_pinjaman.*', 'users.nik', 'users.name', 'users.divisi', 'users.jabatan', 'tbl_anggota_bmt.no_rek')
                ->where('tbl_pengajuan_pinjaman.setuju1', '=', 0)
                ->where('tbl_pengajuan_pinjaman.setuju2', '=', 0)
                ->groupBy('tbl_pengajuan_pinjaman.id_pengajuan')
                ->orderBy('tbl_pengajuan_pinjaman.tgl_disetujui', 'DESC')
                // ->orderBy('tbl_pengajuan_pinjaman.tgl_pengajuan','ASC')
                ->orderBy('tbl_pengajuan_pinjaman.sts_pinjaman', 'DESC')
                ->get();
            $totalPinjaman = PinjamanBmt::join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_pengajuan_pinjaman.id_anggota_bmt')
                ->where('tbl_pengajuan_pinjaman.setuju1', '=', 0)
                ->where('tbl_pengajuan_pinjaman.setuju2', '=', 0)
                ->sum('tbl_pengajuan_pinjaman.nominal');
            $totalbayar = CicilanPinjaman::all()
                ->sum('total_bayar');
            // return $data;
            return view('bmt.BMTviews.daftarPinjamanDisetujui', ['aktive' => $aktive, 'data' => $data, 'totalbayar' => $totalbayar, 'totalPinjaman' => $totalPinjaman, 'no' => $no]);
        } else {
            return redirect('/');
        }
    }
    public function detailPinjamanDisetujui($id_pengajuan)
    {
        if (Auth::check()) {
            $aktive = "bmt";
            $no = 1;
            $data = PinjamanBmt::join('users', 'users.id', '=', 'tbl_pengajuan_pinjaman.id_karyawan')
                ->join('tbl_cicilan_pinjaman', 'tbl_cicilan_pinjaman.id_pengajuan', '=', 'tbl_pengajuan_pinjaman.id_pengajuan')
                ->join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_pengajuan_pinjaman.id_anggota_bmt')
                ->select('tbl_pengajuan_pinjaman.*', 'tbl_cicilan_pinjaman.*', 'users.nik', 'users.name', 'users.divisi', 'users.jabatan', 'tbl_anggota_bmt.no_rek')
                ->where('tbl_pengajuan_pinjaman.setuju1', '=', 0)
                ->where('tbl_pengajuan_pinjaman.setuju2', '=', 0)
                ->where('tbl_pengajuan_pinjaman.id_pengajuan', '=', $id_pengajuan)
                ->groupBy('tbl_pengajuan_pinjaman.id_pengajuan')
                ->orderBy('tbl_pengajuan_pinjaman.sts_pinjaman', 'DESC')
                ->orderBy('tbl_pengajuan_pinjaman.tgl_disetujui', 'DESC')
                ->get();
            $totalPinjaman = PinjamanBmt::all()
                ->where('setuju1', '=', 0)
                ->where('setuju2', '=', 0)
                ->where('id_pengajuan', '=', $id_pengajuan)
                ->sum('nominal');
            $totalbayar = CicilanPinjaman::where('id_pengajuan', '=', $id_pengajuan)
                ->sum('total_bayar');
            // return $data;
            return view('bmt.BMTviews.detailPenbayaranCicilanPinjaman', ['aktive' => $aktive, 'data' => $data, 'totalbayar' => $totalbayar, 'totalPinjaman' => $totalPinjaman, 'no' => $no]);
        } else {
            return redirect('/');
        }
    }
    public function pengajuanPenarikanWadiahAll()
    {
        if (Auth::check() && (Auth::user()->status == 7 || Auth::user()->status == 0)) {
            $aktive = "bmt";
            $no = 1;
            $data = PenarikanWadiah::join('users', 'users.id', '=', 'tbl_penarikan_wadiah.id_karyawan')
                ->select('tbl_penarikan_wadiah.*', 'users.nik', 'users.name', 'users.divisi', 'users.jabatan')
                ->where('tbl_penarikan_wadiah.setuju1', '=', 1)
                ->orderBy('tbl_penarikan_wadiah.tgl_pengajuan', 'DESC')
                ->get();

            return view('bmt.BMTviews.daftarPenarikanWadiah', ['aktive' => $aktive, 'data' => $data, 'no' => $no]);
        } else {
            return redirect('/');
        }
    }
    public function PenarikanWadiah()
    {
        if (Auth::check()) {
            $aktive = "bmt";
            $no = 1;
            $data = PenarikanWadiah::join('users', 'users.id', '=', 'tbl_penarikan_wadiah.id_karyawan')
                ->select('tbl_penarikan_wadiah.*', 'users.nik', 'users.name')
                ->where('id_karyawan', '=', Auth::user()->id)->get();
            return view('bmt.BMTviews.penarikanWadiah', ['aktive' => $aktive, 'data' => $data, 'no' => $no]);
        } else {
            return redirect('/');
        }
    }
    public function setoran()
    {
        if (Auth::check() && (Auth::user()->status == 7 || Auth::user()->status == 0)) {
            $aktive = "bmt";
            $datas = AnggotaBMT::join('users', 'users.id', '=', 'tbl_anggota_bmt.id_karyawan')
                ->select('users.name', 'users.nik', 'users.jabatan', 'users.divisi', 'users.status_karyawan', 'tbl_anggota_bmt.*')
                ->get();
            return view('bmt.BMTform.formSetoranBmt', ['aktive' => $aktive, 'datas' => $datas]);
        } else {
            return redirect('/');
        }
    }
    public function pengelolaanDataAdm()
    {
        if (Auth::check() && (Auth::user()->status == 7 || Auth::user()->status == 0)) {
            $aktive = "bmt";
            $data = BiayaADM::join('users', 'users.id', '=', 'tbl_biaya_adm.id_karyawan')
                ->select('tbl_biaya_adm.*', 'users.name', 'users.divisi')
                ->get();
            $pengeluaran = PengeluaranADM::paginate(5);
            $totalPendapatanADM = BiayaADM::all()->sum('nominal');
            $totalPengeluaranADM = PengeluaranADM::all()->sum('nominal');
            $anggotaBmt = AnggotaBMT::join('users', 'users.id', '=', 'tbl_anggota_bmt.id_karyawan')
                ->select('users.name', 'users.nik', 'users.jabatan', 'users.divisi', 'users.status_karyawan', 'tbl_anggota_bmt.*')
                ->get();

            return view('bmt.BMTviews.pengelolaanBiayaADM', ['aktive' => $aktive, 'data' => $data, 'pengeluaran' => $pengeluaran, 'totalPengeluaranADM' => $totalPengeluaranADM, 'anggotaBmt' => $anggotaBmt, 'totalPendapatanADM' => $totalPendapatanADM]);
        } else {
            return redirect('/');
        }
    }
    public function detailSetoran($id_anggota_bmt)
    {
        if (Auth::check()) {
            $aktive = "bmt";
            $no = [1, 1];
            $datas = SetoranBMT::join('tbl_anggota_bmt', 'tbl_anggota_bmt.id_anggota_bmt', '=', 'tbl_setoran_bmt.id_anggota_bmt')
                ->join('users', 'users.id', '=', 'tbl_anggota_bmt.id_karyawan')
                ->where('tbl_setoran_bmt.id_anggota_bmt', '=', $id_anggota_bmt)
                ->orderBy('tbl_setoran_bmt.tgl_setor', 'DESC')
                ->get();
            $total = SetoranBMT::select(DB::raw('sum(nominal_bmt) as total_bmt'), DB::raw('sum(nominal_wadiah) as total_wadiah'))
                ->where('id_anggota_bmt', $id_anggota_bmt)
                ->first();
            $getID = AnggotaBMT::find($id_anggota_bmt);
            $penarikanWadiah = PenarikanWadiah::join('users', 'users.id', '=', 'tbl_penarikan_wadiah.id_karyawan')
                ->where('tbl_penarikan_wadiah.id_karyawan', '=', $getID->id_karyawan)
                ->where('tbl_penarikan_wadiah.setuju1', '=', 0)
                ->orderBy('tbl_penarikan_wadiah.tgl_disetujui', 'DESC')
                ->paginate(5);
            $totalPenarikan = PenarikanWadiah::all()
                ->where('setuju1', '=', 0)
                ->where('id_karyawan', '=', $getID->id_karyawan)
                ->sum('nominal');
            return view('bmt.BMTviews.detailSetoranBmt', ['no' => $no, 'aktive' => $aktive, 'total' => $total, 'datas' => $datas, 'totalPenarikan' => $totalPenarikan, 'penarikanWadiah' => $penarikanWadiah]);
        } else {
            return redirect('/');
        }
    }
    public function addADM(Request $request)
    {
        try {
            BiayaADM::insert([
                'id_karyawan' => $request['id_karyawan'],
                'nominal' => str_replace(',', '', $request['adm']),
                'tgl_input' => $request['tgl']
            ]);
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function AddPengeluaran(Request $request)
    {
        try {
            PengeluaranADM::insert([
                'tgl_pembelian' => $request['tgl'],
                'tgl_input' => now(),
                'nominal' => str_replace(',', '', $request['nominal']),
                'ket' => $request['ket']
            ]);
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function addAnggota(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $request->validate([
                'nama' => ['required'],
                'id_karyawan' => ['required'],
                'tgl_gabung' => ['required'],
                'setor_awal' => ['required'],
                'no_rek' => ['required'],
                'adm' => ['required'],
            ]);
            $cekData = AnggotaBMT::where('id_karyawan', '=', $request['id_karyawan'])->count();
            if ($cekData == 0) {
                $insertID  = AnggotaBMT::insertGetId([
                    'id_karyawan' => $request['id_karyawan'],
                    'tgl_bergabung' => $request['tgl_gabung'],
                    'no_rek' => $request['no_rek'],
                ]);

                BiayaADM::insert([
                    'id_karyawan' => $request['id_karyawan'],
                    'nominal' => str_replace(',', '', $request['adm']),
                    'tgl_input' => now()
                ]);
                SetoranBMT::insert([
                    'id_anggota_bmt' => $insertID,
                    'nominal_bmt' => str_replace(',', '', $request['setor_awal']),
                    'nominal_wadiah' => '0',
                    'tgl_setor' => now(),
                    'tgl_input' => now()
                ]);

                $update = AnggotaBMT::find($insertID);
                $update->saldo_bmt = str_replace(',', '', $request['setor_awal']);
                $update->save();

                return  redirect()->back()->with(['info' => 'Berhasil Menambah Anggota']);
            } else {
                return  redirect()->back()->with(['warning' => 'Anggota Sudah Terdaftar']);
            }
        } catch (Exception $e) {
            return  redirect()->back()->with(['warning' => 'Gagal Menambah Anggota']);
        }
    }
    public function AjukanPinjaman(Request $request)
    {
        try {
            $request->validate([
                'ket' => ['required'],
                'tgl' => ['required'],
                'tabungan' => ['required'],
                'nominal' => ['required'],
            ]);
            $id_user = Auth::user()->id;
            $datapimpinan =  Daftaruser::where("status", 7)->first();
            $email = $datapimpinan->email;
            $getID = AnggotaBMT::where('id_karyawan', '=', $id_user)->first();
            $cekTabungan = SetoranBMT::select(DB::raw('sum(nominal_bmt) as nominal_bmt'), DB::raw('sum(nominal_wadiah) as nominal_wadiah'),)
                ->where('id_anggota_bmt', '=', $getID->id_anggota_bmt)
                ->first();
            $totalPenarikan = PenarikanWadiah::all()
                ->where('id_karyawan', '=', $id_user)
                ->where('setuju1', 0)
                ->sum('nominal');
            $nominal = str_replace(',', '', $request['nominal']);
            $cekHistoriPinjaman = PinjamanBmt::where('id_karyawan', $id_user)->where('sts_pinjaman', 1)->count();
            // return $cekHistoriPinjaman;
            if ($request['tabungan'] == 2) {
                if (($cekTabungan->nominal_wadiah - $totalPenarikan) >= str_replace(',', '', $request['nominal'])) {
                    PenarikanWadiah::insert([
                        'id_karyawan' => $id_user,
                        'id_anggota_bmt' => $getID->id_anggota_bmt,
                        'nominal' => str_replace('.', '', $nominal),
                        'ket_pengajuan' => $request['ket'],
                        'tgl_pengajuan' => now(),
                    ]);
                } else {
                    return  redirect()->back()->with(['warning' => 'Saldo Wadiah Anda Tidak Mencukupi, Sisa Saldo Rp ' . number_format($cekTabungan->nominal_wadiah - $totalPenarikan)]);
                }
            } else {
                if (str_replace(',', '', $request['nominal']) > 8000000) {
                    return  redirect()->back()->with(['warning' => 'Maksimal Pengajuan Pinjaman Rp 8.000.000 ']);
                } else {
                    if ($cekHistoriPinjaman == 0) {
                        PinjamanBmt::insert([
                            'id_karyawan' => $id_user,
                            'id_anggota_bmt' => $getID->id_anggota_bmt,
                            'nominal' => str_replace('.', '', $nominal),
                            'ket_pengajuan' => $request['ket'],
                            'tgl_pinjaman' => $request['tgl'],
                            'tgl_pengajuan' => now(),
                        ]);
                    } else {
                        return  redirect()->back()->with(['warning' => 'Anda Sudah Mengajukan Pinjaman Sebelumnya, Harap Menuggu Pengajuan Anda Di Proses Sebelum Mengajukan Pinjaman Yang Lain!']);
                    }
                }
            }

            $details = [
                'name' =>       Auth::user()->name,
                'divisi' =>     Auth::user()->divisi,
                'email' =>      Auth::user()->email,
                'jabatan' =>    Auth::user()->jabatan,
                'kategori' =>   $request['tabungan'] == 1 ? 'Pinjaman BMT' : 'Penarikan Wadiah',
                'mulai' =>      '-',
                'akhir' =>      '-',
                'sisa' =>       '-',
                'jumlah' =>     '-',
                'nominal' =>    $request['nominal'],
                'body' =>       $request['ket'],
            ];
            try {
                Mail::to($email)->send(new KirimEmail($details));
            } catch (\Exception $e) {
            }
            return  redirect()->back()->with(['info' => 'Berhasil Mengajukan Pinjaman']);
        } catch (Exception $e) {
            return  redirect()->back()->with(['warning' => 'Gagal Mengajukan Pinjaman']);
        }
    }

    public function pinjamanSetuju($id_pengajuan, Request $request)
    {
        try {
            $result = PinjamanBmt::find($id_pengajuan);

            if (Auth::user()->status == 0 || Auth::user()->status == 7) {
                $datapimpinan =  Daftaruser::where("status", 1)->first();
                $dataKaryawan =  Daftaruser::find($result->id_karyawan);
                $email = $datapimpinan->email;

                $result->setuju1 = 0;
                $result->ket1 = $request['ket'];
                $result->save();

                $details = [
                    'name' =>       $dataKaryawan->name,
                    'divisi' =>     $dataKaryawan->divisi,
                    'email' =>      $dataKaryawan->email,
                    'jabatan' =>    $dataKaryawan->jabatan,
                    'kategori' =>   'Pinjaman BMT',
                    'mulai' =>      '-',
                    'akhir' =>      '-',
                    'sisa' =>       '-',
                    'jumlah' =>     '-',
                    'body' =>       $result->ket_pengajuan,
                ];
                try {
                    Mail::to($email)->send(new KirimEmail($details));
                } catch (\Exception $e) {
                }
            } else if (Auth::user()->status == 1) {
                $datapimpinan =  Daftaruser::where("status", 4)->first();
                $dataKaryawan =  Daftaruser::find($result->id_karyawan);
                $noRek =  AnggotaBMT::where('id_karyawan', $result->id_karyawan)->first();
                $email = [];

                $result->setuju2 = 0;
                $result->ket2 = $request['ket'];
                $result->tgl_disetujui = now();
                $result->save();

                CicilanPinjaman::insert([
                    'id_pengajuan' => $result->id_pengajuan,
                    'created_at' => now(),
                ]);

                $details = [
                    'name' =>       $dataKaryawan->name,
                    'divisi' =>     $dataKaryawan->divisi,
                    'email' =>      $dataKaryawan->email,
                    'jabatan' =>    $dataKaryawan->jabatan,
                    'kategori' =>   'Pinjaman BMT',
                    'mulai' =>      '-',
                    'akhir' =>      '-',
                    'sisa' =>       '-',
                    'jumlah' =>     '-',
                    'nominal' =>    number_format($result->nominal),
                    'no_rek' =>     $noRek->no_rek,
                    'body' =>       'Pengajuan Pinjaman Anda Telah Disetujui Oleh Ketua Yayasan Sekolah Islam Al-azhar Cairo Banda Aceh',
                ];
                array_push($email, $datapimpinan->email);
                array_push($email, $dataKaryawan->email);
                try {
                    Mail::to($email)->send(new KirimEmail($details));
                } catch (\Exception $e) {
                }
            }

            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function penarikanSetuju($id_penarikan, Request $request)
    {
        try {
            $result = PenarikanWadiah::find($id_penarikan);

            if (Auth::user()->status == 0 || Auth::user()->status == 7) {
                $datapimpinan =  Daftaruser::where("status", 4)->first();
                $dataKaryawan =  Daftaruser::find($result->id_karyawan);
                $noRek =  AnggotaBMT::where('id_karyawan', $result->id_karyawan)->first();
                $email = [];

                $result->setuju1 = 0;
                $result->ket1 = $request['ket'];
                $result->tgl_disetujui = now();
                $result->save();

                $details = [
                    'name' =>       $dataKaryawan->name,
                    'divisi' =>     $dataKaryawan->divisi,
                    'email' =>      $dataKaryawan->email,
                    'jabatan' =>    $dataKaryawan->jabatan,
                    'kategori' =>   'Penarikan Wadiah',
                    'mulai' =>      '-',
                    'akhir' =>      '-',
                    'sisa' =>       '-',
                    'jumlah' =>     '-',
                    'nominal' =>    number_format($result->nominal),
                    'no_rek' =>     $noRek->no_rek,
                    'body' =>       $request['ket'],
                ];
                array_push($email, $datapimpinan->email);
                array_push($email, $dataKaryawan->email);

                try {
                    Mail::to($email)->send(new KirimEmail($details));
                } catch (\Exception $e) {
                }

                $totalPenarikan = PenarikanWadiah::where('id_karyawan', '=', $result->id_karyawan)
                    ->where('setuju1', '=', 0)
                    ->sum('nominal');
                $totalSaldo = SetoranBMT::select(DB::raw('sum(nominal_wadiah) as saldo_wadiah'))
                    ->where('id_anggota_bmt', '=', $result->id_anggota_bmt)
                    ->first();
                $update = AnggotaBMT::where('id_karyawan', '=', $result->id_karyawan)->first();
                $update->saldo_wadiah = ($totalSaldo->saldo_wadiah - $totalPenarikan);
                $update->total_penarikan = $totalPenarikan;
                $update->save();
            }

            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function penarikanDitolak($id_penarikan, Request $request)
    {
        try {
            $result = PenarikanWadiah::find($id_penarikan);

            if (Auth::user()->status == 0 || Auth::user()->status == 7) {
                $datapimpinan =  Daftaruser::where("status", 4)->first();
                $dataKaryawan =  Daftaruser::find($result->id_karyawan);
                $noRek =  AnggotaBMT::where('id_karyawan', $result->id_karyawan)->first();
                $email = [];

                $result->setuju1 = 2;
                $result->ket1 = $request['ket'];
                $result->tgl_disetujui = now();
                $result->save();

                $details = [
                    'name' =>       $dataKaryawan->name,
                    'divisi' =>     $dataKaryawan->divisi,
                    'email' =>      $dataKaryawan->email,
                    'jabatan' =>    $dataKaryawan->jabatan,
                    'kategori' =>   'Penarikan Wadiah Ditolak',
                    'mulai' =>      '-',
                    'akhir' =>      '-',
                    'sisa' =>       '-',
                    'jumlah' =>     '-',
                    'nominal' =>    number_format($result->nominal),
                    'no_rek' =>     $noRek->no_rek,
                    'body' =>       $request['ket'],
                ];
                array_push($email, $datapimpinan->email);
                array_push($email, $dataKaryawan->email);
                try {
                    Mail::to($email)->send(new KirimEmail($details));
                } catch (\Exception $e) {
                }
            }

            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function pinjamanDitolak($id_pengajuan, Request $request)
    {
        try {
            $result = PinjamanBmt::find($id_pengajuan);
            $dataKaryawan =  Daftaruser::find($result->id_karyawan);
            $email = $dataKaryawan->email;

            if (Auth::user()->status == 0 || Auth::user()->status == 7) {
                $result->setuju1 = 2;
                $result->ket1 = $request['ket'];
                $result->sts_pinjaman = 2;
                $result->save();
            } else if (Auth::user()->status == 1) {
                $result->setuju2 = 2;
                $result->ket2 = $request['ket'];
                $result->sts_pinjaman = 2;
                $result->save();
            }
            $details = [
                'name' =>       $dataKaryawan->name,
                'divisi' =>     $dataKaryawan->divisi,
                'email' =>      $dataKaryawan->email,
                'jabatan' =>    $dataKaryawan->jabatan,
                'kategori' =>   'Pinjaman BMT / Penarikan Wadiah',
                'mulai' =>      '-',
                'akhir' =>      '-',
                'sisa' =>       '-',
                'jumlah' =>     '-',
                'nominal' =>    number_format($result->nominal),
                'body' =>       'Mohon Maaf, Pengajuan Pinjaman Anda Tidak Disetujui / Ditolak',
            ];
            try {
                Mail::to($email)->send(new KirimEmail($details));
            } catch (\Exception $e) {
            }
            return  redirect()->back();
        } catch (Exception $e) {
        }
    }

    public function simpanSetoran(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $request->validate([
                'id_anggota_bmt' => ['required'],
                'tgl_setor' => ['required'],
                'bmt' => ['required'],
                'wadiah' => ['required'],
            ]);
            DB::transaction(function () use ($request) {
                SetoranBMT::insert([
                    'id_anggota_bmt' => $request['id_anggota_bmt'],
                    'nominal_bmt' => str_replace(',', '', $request['bmt']),
                    'nominal_wadiah' => str_replace(',', '', $request['wadiah']),
                    'tgl_setor' => $request['tgl_setor'],
                    'tgl_input' => now()
                ]);
                $totalSaldo = SetoranBMT::select(DB::raw('sum(nominal_bmt) as saldo_bmt'), DB::raw('sum(nominal_wadiah) as saldo_wadiah'))
                    ->where('id_anggota_bmt', '=', $request['id_anggota_bmt'])
                    ->first();
                $update = AnggotaBMT::find($request['id_anggota_bmt']);
                $totalPenarikan = PenarikanWadiah::where('id_karyawan', '=', $update->id_karyawan)->sum('nominal');
                $update->saldo_bmt = $totalSaldo->saldo_bmt;
                $update->saldo_wadiah = ($totalSaldo->saldo_wadiah - $totalPenarikan);
                $update->save();
            });

            return  redirect()->back()->with(['info' => 'Berhasil Menambah Setoran']);
        } catch (Exception $e) {
            return  redirect()->back()->with(['warning' => 'Gagal Menambah Setoran']);
        }
    }
    public function BayarCicilan($id_cicilan, Request $request)
    {
        try {
            $request->validate([
                'cicilan' => ['required'],
                'tgl_bayar' => ['required'],
                'nominal_bayar' => ['required'],
            ]);
            $cicilan = "cicilan" . $request['cicilan'];
            $tgl = "tgl" . $request['cicilan'];


            $update = CicilanPinjaman::find($id_cicilan);
            $update->$cicilan = str_replace(',', '', $request['nominal_bayar']);
            $update->$tgl = $request['tgl_bayar'];
            $update->save();

            $cekCicilan = CicilanPinjaman::find($id_cicilan);
            $totalCicilan = $cekCicilan->cicilan1 + $cekCicilan->cicilan2 + $cekCicilan->cicilan3 + $cekCicilan->cicilan4 + $cekCicilan->cicilan5 + $cekCicilan->cicilan6;

            $update->total_bayar = $totalCicilan;
            $update->updated_at = now();
            $update->save();

            $cekTotalCicilan = CicilanPinjaman::where('id_cicilan', $id_cicilan)->first();
            $data = PinjamanBmt::find($cekCicilan->id_pengajuan);
            if ($cekTotalCicilan->total_bayar >= $data->nominal) {
                $data->sts_pinjaman = 0;
                $data->save();
            } else {
                $data->sts_pinjaman = 1;
                $data->save();
            }
            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'Mengubah/menambah cicilan bmt ' . $id_cicilan,
                'date' => now(),
            ]);
            return  redirect('all-pinjaman-bmt-view');
        } catch (Exception $e) {
            return  redirect()->back()->with(['warning' => 'Gagal Membayar Cicilan']);
        }
    }

    public function editSetoran($id_setoran, Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            DB::transaction(function () use ($id_setoran, $request) {
                $result = SetoranBMT::find($id_setoran);
                $result->tgl_setor = $request['tgl_setor'];
                $result->nominal_bmt = str_replace(',', '', $request['bmt']);
                $result->nominal_wadiah = str_replace(',', '', $request['wadiah']);
                $result->tgl_update = now();
                $result->save();

                $totalSaldo = SetoranBMT::select(DB::raw('sum(nominal_bmt) as saldo_bmt'), DB::raw('sum(nominal_wadiah) as saldo_wadiah'))
                    ->where('id_anggota_bmt', '=', $result->id_anggota_bmt)
                    ->first();
                $update = AnggotaBMT::find($result->id_anggota_bmt);
                $totalPenarikan = PenarikanWadiah::where('id_karyawan', '=', $update->id_karyawan)->sum('nominal');
                $update->saldo_bmt = $totalSaldo->saldo_bmt;
                $update->saldo_wadiah = ($totalSaldo->saldo_wadiah - $totalPenarikan);
                $update->save();
            });


            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'Mengubah data setoran bmt ' . $id_setoran,
                'date' => now(),
            ]);
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function editAdm($id_adm, Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $result = BiayaADM::find($id_adm);
            $result->tgl_input = $request['tgl'];
            $result->tgl_update = now();
            $result->nominal = str_replace(',', '', $request['adm']);
            $result->save();

            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'Mengubah data biaya administrasi bmt ' . $id_adm,
                'date' => now(),
            ]);
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function editPengeluaranADM($id_pengeluaran, Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $result = PengeluaranADM::find($id_pengeluaran);
            $result->tgl_pembelian = $request['tgl'];
            $result->ket = $request['ket'];
            $result->tgl_update = now();
            $result->nominal = str_replace(',', '', $request['nominal']);
            $result->save();

            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'Mengubah data biaya pengeluaran administrasi bmt ' . $id_pengeluaran,
                'date' => now(),
            ]);
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }

    public function EditAnggotaBMT($id_anggota_bmt, Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $result = AnggotaBMT::find($id_anggota_bmt);
            $result->no_rek = $request['no_rek'];
            $result->tgl_bergabung = $request['tgl_gabung'];
            $result->save();

            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'Mengubah Data Anggota bmt ' . $id_anggota_bmt,
                'date' => now(),
            ]);
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }



    public function hapusAnggota($id_anggota)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $result = AnggotaBMT::find($id_anggota);
            $setoran = SetoranBMT::where('id_anggota_bmt', '=', $id_anggota)->get();
            foreach ($setoran as $value) {
                $clearsetoran = SetoranBMT::find($value->id_setoran);
                $clearsetoran->delete();
            }
            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'menghapus anggota bmt ' . $result->id_karyawan,
                'date' => now(),
            ]);
            $result->delete();
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function hapusPinjamanDisetujui($id_pengajuan)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $result1 = PinjamanBmt::find($id_pengajuan);
            // $result2 = CicilanPinjaman::where('id_pengajuan',$id_pengajuan)->first();
            // $result2->delete();
            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'fatal, menghapus pinjaman bmt yang sudah di setujui ' . $id_pengajuan,
                'date' => now(),
            ]);
            $result1->setuju1 = '2';
            $result1->setuju2 = '2';
            $result1->sts_pinjaman = '2';
            $result1->save();
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function hapusSetoran($id_setoran)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $data = SetoranBMT::find($id_setoran);
            $GetId = $data->id_anggota_bmt;

            $result = SetoranBMT::find($id_setoran);
            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'menghapus setoran bmt ' . $id_setoran,
                'date' => now(),
            ]);
            $result->delete();

            $totalSaldo = SetoranBMT::select(DB::raw('sum(nominal_bmt) as saldo_bmt'), DB::raw('sum(nominal_wadiah) as saldo_wadiah'))
                ->where('id_anggota_bmt', '=', $GetId)
                ->first();
            $update = AnggotaBMT::find($GetId);
            $totalPenarikan = PenarikanWadiah::where('id_karyawan', '=', $update->id_karyawan)->sum('nominal');
            $update->saldo_bmt = $totalSaldo->saldo_bmt;
            $update->saldo_wadiah = ($totalSaldo->saldo_wadiah - $totalPenarikan);
            $update->save();

            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function hapusADM($id_adm)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $result = BiayaADM::find($id_adm);

            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'menghapus biaya administrasi bmt ' . $id_adm,
                'date' => now(),
            ]);
            $result->delete();
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function hapusPengeluaranADM($id_adm)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $result = PengeluaranADM::find($id_adm);
            $result->delete();

            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'menghapus data biaya Pengeluaran administrasi bmt ' . $id_adm,
                'date' => now(),
            ]);
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function hapusPengajuanPinjaman($id_pengajuan)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $result = PinjamanBmt::find($id_pengajuan);
            $result->delete();
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function hapusPenarikanWadiah($id_penarikan)
    {
        try {
            $result = PenarikanWadiah::find($id_penarikan);
            $id_anggota_bmt = $result->id_anggota_bmt;
            $jumlah_penarikan = $result->nominal;
            $result->delete();
            LogEdit::insert([
                'id_karyawan' => Auth::user()->id,
                'nama' => Auth::user()->name,
                'keterangan' => 'menghapus histoari penarikan wadiah ' . $id_anggota_bmt,
                'date' => now(),
            ]);
            if (Auth::user()->status == 0) {
                $totalSaldo = SetoranBMT::select(DB::raw('sum(nominal_wadiah) as saldo_wadiah'))
                    ->where('id_anggota_bmt', '=', $id_anggota_bmt)
                    ->first();
                $update = AnggotaBMT::find($id_anggota_bmt);
                $totalPenarikan = PenarikanWadiah::where('id_karyawan', '=', $update->id_karyawan)->sum('nominal');
                $update->saldo_wadiah = ($totalSaldo->saldo_wadiah - $totalPenarikan);
                $update->total_penarikan = ($update->total_penarikan - $jumlah_penarikan);
                $update->save();
            }
            return  redirect()->back();
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function nonAKtifAnggota($id_anggota_bmt)
    {
        try {
            $result = AnggotaBMT::find($id_anggota_bmt);
            $result->sts_anggota = 1;
            $result->save();
            return  redirect()->back()->with(['info' => 'Anggota Berhasil Dinonaktifkan']);
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    public function selesaiTranfer($id_pengajuan)
    {
        try {
            $result = PinjamanBmt::find($id_pengajuan);
            $result->sts_transfer = 0;
            $result->save();
            return  redirect('all-pinjaman-bmt-view');
        } catch (Exception $e) {
            return  redirect('all-pinjaman-bmt-view');
        }
    }
    public function AKtifAnggota($id_anggota_bmt)
    {
        try {
            $result = AnggotaBMT::find($id_anggota_bmt);
            $result->sts_anggota = 0;
            $result->save();
            return  redirect()->back()->with(['info' => 'Anggota Berhasil Diaktifkan']);
        } catch (Exception $e) {
            return  redirect()->back();
        }
    }
    // download Template import data BMT
    public function exportTemplate()
    {
        date_default_timezone_set('Asia/Jakarta');
        return Excel::download(new TemplateFormatBMT(), 'Format BMT ' . date('m Y') . '.xlsx');
    }

    public function exportLaporanBMT()
    {
        if (Auth::check() && (Auth::user()->status == 7 || Auth::user()->status == 0)) {
            try {

                $dataSetoran = SetoranBMT::select(
                    DB::raw('sum(nominal_bmt) as total_bmt'),
                    DB::raw('sum(nominal_wadiah) as total_wadiah'),
                    DB::raw("DATE_FORMAT(tgl_setor, '%Y-%m-%d') new_date"),
                    DB::raw('YEAR(tgl_setor) year ,MONTH(tgl_setor) month ')
                )
                    ->groupBy('month', 'year')
                    ->orderBy('year', 'ASC')
                    ->get();

                $dataPinjaman = PinjamanBmt::select(
                    DB::raw('sum(nominal) as total_pinjaman'),
                    DB::raw("DATE_FORMAT(tgl_disetujui, '%Y-%m') new_date"),
                    DB::raw('YEAR(tgl_disetujui) year,MONTH(tgl_disetujui) month')
                )
                    ->groupBy('month', 'year')
                    ->orderBy('year', 'ASC')
                    ->get();
                // return $dataPinjaman;
                $cicilan1 = CicilanPinjaman::select(
                    DB::raw("DATE_FORMAT(tgl1, '%Y-%m-%d') new_date1"),
                    DB::raw('YEAR(tgl1) year,MONTH(tgl1) month'),
                    DB::raw('sum(cicilan1) as total_pinjaman_dibayar1')
                )
                    ->groupBy('month', 'year')
                    ->orderBy('year', 'ASC')
                    ->get();

                $cicilan2 = CicilanPinjaman::select(
                    DB::raw("DATE_FORMAT(tgl2, '%Y-%m-%d') new_date2"),
                    DB::raw('YEAR(tgl2) year,MONTH(tgl2) month'),
                    DB::raw('sum(cicilan2) as total_pinjaman_dibayar2')
                )
                    ->groupBy('month', 'year')
                    ->orderBy('year', 'ASC')
                    ->get();

                $cicilan3 = CicilanPinjaman::select(
                    DB::raw("DATE_FORMAT(tgl3, '%Y-%m-%d') new_date3"),
                    DB::raw('YEAR(tgl3) year,MONTH(tgl3) month'),
                    DB::raw('sum(cicilan3) as total_pinjaman_dibayar3')
                )
                    ->groupBy('month', 'year')
                    ->orderBy('year', 'ASC')
                    ->get();

                $cicilan4 = CicilanPinjaman::select(
                    DB::raw("DATE_FORMAT(tgl4, '%Y-%m-%d') new_date4"),
                    DB::raw('YEAR(tgl4) year,MONTH(tgl4) month'),
                    DB::raw('sum(cicilan4) as total_pinjaman_dibayar4')
                )
                    ->groupBy('month', 'year')
                    ->orderBy('year', 'ASC')
                    ->get();

                $cicilan5 = CicilanPinjaman::select(
                    DB::raw("DATE_FORMAT(tgl5, '%Y-%m-%d') new_date5"),
                    DB::raw('YEAR(tgl5) year,MONTH(tgl5) month'),
                    DB::raw('sum(cicilan5) as total_pinjaman_dibayar5')
                )
                    ->groupBy('month', 'year')
                    ->orderBy('year', 'ASC')
                    ->get();
                $cicilan6 = CicilanPinjaman::select(
                    DB::raw("DATE_FORMAT(tgl6, '%Y-%m-%d') new_date6"),
                    DB::raw('YEAR(tgl6) year,MONTH(tgl6) month'),
                    DB::raw('sum(cicilan6) as total_pinjaman_dibayar6')
                )
                    ->groupBy('month', 'year')
                    ->orderBy('year', 'ASC')
                    ->get();
                // return $dataSetoran;
                foreach ($dataSetoran as $key => $value) {
                    RekapBmt::insert([
                        'bulan' => $value->new_date,
                        'total_bmt' => $value->total_bmt,
                        'total_wadiah' => $value->total_wadiah,
                    ]);
                }


                foreach ($dataPinjaman as $key => $value) {
                    $update = RekapBmt::whereMonth('bulan', $value->month)->whereYear('bulan', $value->year)->first();
                    if ($update != null) {
                        $update->total_pinjaman = $value->total_pinjaman;
                        $update->save();
                    }
                }

                foreach ($dataSetoran as $key => $value) {
                    $total_pinjaman_dibayar1 = 0;
                    $total_pinjaman_dibayar2 = 0;
                    $total_pinjaman_dibayar3 = 0;
                    $total_pinjaman_dibayar4 = 0;
                    $total_pinjaman_dibayar5 = 0;
                    $total_pinjaman_dibayar6 = 0;
                    $update = RekapBmt::where('bulan', $value->new_date)->first();

                    foreach ($cicilan1 as $key => $cicilan) {
                        if ($value->year == $cicilan->year && $value->month == $cicilan->month) {
                            $total_pinjaman_dibayar1 = $cicilan->total_pinjaman_dibayar1;
                        }
                    }
                    foreach ($cicilan2 as $key => $cicilan) {
                        if ($value->year == $cicilan->year && $value->month == $cicilan->month) {
                            $total_pinjaman_dibayar2 = $cicilan->total_pinjaman_dibayar2;
                        }
                    }
                    foreach ($cicilan3 as $key => $cicilan) {
                        if ($value->year == $cicilan->year && $value->month == $cicilan->month) {
                            $total_pinjaman_dibayar3 = $cicilan->total_pinjaman_dibayar3;
                        }
                    }
                    foreach ($cicilan4 as $key => $cicilan) {
                        if ($value->year == $cicilan->year && $value->month == $cicilan->month) {
                            $total_pinjaman_dibayar4 = $cicilan->total_pinjaman_dibayar4;
                        }
                    }
                    foreach ($cicilan5 as $key => $cicilan) {
                        if ($value->year == $cicilan->year && $value->month == $cicilan->month) {
                            $total_pinjaman_dibayar5 = $cicilan->total_pinjaman_dibayar5;
                        }
                    }
                    foreach ($cicilan6 as $key => $cicilan) {
                        if ($value->year == $cicilan->year && $value->month == $cicilan->month) {
                            $total_pinjaman_dibayar6 = $cicilan->total_pinjaman_dibayar6;
                        }
                    }
                    $total_bayar = $total_pinjaman_dibayar1 + $total_pinjaman_dibayar2 + $total_pinjaman_dibayar3 + $total_pinjaman_dibayar4 + $total_pinjaman_dibayar5 + $total_pinjaman_dibayar6;

                    $update->total_pinjaman_dibayar = $total_bayar;
                    $update->save();
                }

                // return RekapBmt::orderBy('bulan','ASC')->get();  
                return Excel::download(new BmtExport(), 'Rekap Laporan BMT.xlsx');
            } catch (Exception $e) {
                return redirect()->back()->with(['warning' => 'Gagal Download Laporan']);
            }
        } else {
            return redirect()->back()->with(['warning' => 'Tentukan Periode Absesensi Sebelum Export']);
        }
    }

    public function importExcelBmt(Request $request)
    {
        // try{
        $request->validate([
            'file' => 'required',
        ]);
        $file = $request['file'];
        $namafile = time() . '_' . date('MY') . '_' . $file->getClientOriginalName();
        $file->move('bmt', $namafile);
        $file_patch = public_path('/bmt/' . $namafile);
        Excel::import(new BmtImport, $file_patch);

        return redirect()->back();
        //    } catch (\Exception $e) {
        //       return redirect()->back()->with(['warning'=>'Format File Excel Anda Expired, Harap Mengubah Format File Excel Anda']);               
        //  }

    }

    public function getDownload1()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/file/pembiayaan.pdf";

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, 'Surat Permohonan Pembiayaan.pdf', $headers);
    }
    public function getDownload2()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file = public_path() . "/file/bebas_pinjaman.pdf";

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, 'Surat Bebas Pinjaman.pdf', $headers);
    }
}
