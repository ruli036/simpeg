<?php

namespace App\Http\Controllers;

use App\Mail\KirimEmail;
use App\Models\Daftaruser;
use App\Models\JenisCuti;
use App\Models\LogEdit;
use App\Models\Surat;
use App\Models\TemporariSurat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\ErrorHandler\Exception\FlattenException as ExceptionFlattenException;

class ControllerKaryawan extends Controller

{

    public function datasuratcuti()
    {
        if (Auth::check()) {
            $jenis = "C";
            $aktive = "users";
            $id = Auth::user()->id;
            $datauser =  TemporariSurat::where('id_karyawan', $id)->get();
            return view('cuti.daftarpengajuansurat', ['datauser' => $datauser, 'jenis' => $jenis, 'aktive' => $aktive]);
        } else {
            return redirect('/');
        }
    }
    public function datasuratdisetujui()
    {
        if (Auth::check()) {
            $jenis = "C";
            $aktive = "users";
            $id = Auth::user()->id;
            $datauser =  Surat::where('id_karyawan', $id)->orderBy('tgl_surat', 'DESC')->get();;
            return view('cuti.daftrasuratdisetujui', ['datauser' => $datauser, 'jenis' => $jenis, 'aktive' => $aktive]);
        } else {
            return redirect('/');
        }
    }
    public function datasuratdisetujuidivisi()
    {
        if (Auth::check()) {
            $aktive = "umumdisetujui";
            $divisi = Auth::user()->divisi;
            if ($divisi == 'KB-TK') {
                $datauser =  Surat::where('divisi', $divisi)->orWhere('divisi', 'YAYASAN')->orderBy('tgl_surat', 'DESC')->get();
            } else {
                $datauser =  Surat::where('divisi', $divisi)->orderBy('tgl_surat', 'DESC')->get();
            }
            return view('cuti.daftarcutikaryawan', ['datauser' => $datauser, 'aktive' => $aktive]);
        } else {
            return redirect('/');
        }
    }
    public function datasuratdisetujuidivisisemua()
    {
        if (Auth::check()) {
            $aktive = "suratCuti";
            $datauser =  Surat::orderBy('tgl_surat', 'DESC')->get();
            return view('cuti.daftarcutikaryawan', ['datauser' => $datauser, 'aktive' => $aktive]);
        } else {
            return redirect('/');
        }
    }

    public function editsuratcuti($id)
    {
        if (Auth::check()) {
            $aktive = "C";
            if (Auth::user()->divisi == 'YAYASAN') {
                $cutis = JenisCuti::all();
            } else {
                $cutis = JenisCuti::where('kategori', '0')->get();
            }
            $surat =  TemporariSurat::where("id_surat", $id)->first();
            return view('cuti.formeditsurat', ['surat' => $surat, 'aktive' => $aktive, 'cutis' => $cutis]);
        } else {
            return redirect('/');
        }
    }
    public function editsuratcutidisetujui($id)
    {
        if (Auth::check()) {
            $aktive = "umumdisetujui";
            $surat =  Surat::where("id_surat", $id)->first();
            if ($surat->divisi == 'YAYASAN') {
                $cutis = JenisCuti::all();
            } else {
                $cutis = JenisCuti::where('kategori', '0')->get();
            }
            return view('pagesadmin.editsuratcuti', ['surat' => $surat, 'aktive' => $aktive, 'cutis' => $cutis]);
        } else {
            return redirect('/');
        }
    }
    //profile karyawan
    public function profile()
    {
        if (Auth::check()) {
            $aktive = 'home';
            $id = Auth::user()->id;
            $datauser =  User::where("id", $id)->first();
            return view('umum.profile', ['datauser' => $datauser, 'aktive' => $aktive]);
        } else {
            return redirect('/');
        }
    }
    // edit data sendiri
    public function editprofile(Request $request)
    {

        $id = Auth::user()->id;

        $request->validate([
            'name' => ['required', 'string'],
            'lulusan' => ['required', 'string'],
            'email' => ['required', 'string'],
            'tempat' => ['required', 'string'],
            'tgl_lahir' => ['required', 'string'],
            'jk' => ['required', 'string'],
            'jurusan' => ['required', 'string'],
            'universitas' => ['required', 'string'],
            'thn_tamat' => ['required', 'string'],
            'pernikahan' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'hp' => ['required'],
        ]);
        $lahir = date('d-m-Y', strtotime($request['tgl_lahir']));

        $result = User::find($id);
        $result->name =  $request['name'];
        $result->jk =  $request['jk'];
        $result->tempat =  $request['tempat'];
        $result->tgl_lahir =  $lahir;
        $result->email =  $request['email'];
        $result->lulusan =  $request['lulusan'];
        $result->jurusan =  $request['jurusan'];
        $result->universitas =  $request['universitas'];
        $result->thn_tamat =  $request['thn_tamat'];
        $result->pernikahan =  $request['pernikahan'];
        $result->no_hp =  $request['hp'];
        $result->alamat =  $request['alamat'];
        $result->save();

        Http::post(env('APP_URLLMS') . 'updateUser', [
            'id' => $result->id,
            'name' => $request['name'],
            'email' => $request['email'],
        ]);
        return redirect()->back()->with(['info' => 'Data User Berhasil Diubah']);
    }
    // pengajuan cuti
    public function ajukancuti(Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            if ($request['kategori'] == '') {
                $request->validate([
                    'kategori' => ['required', 'string'],
                ]);
            } else {
                $id_cuti = $request['kategori'];
                $data_cuti = JenisCuti::find($id_cuti);
                if ($data_cuti->file == "1") {
                    $request->validate([
                        'kategori' => ['required', 'string'],
                        'tgl_mulai' => ['required', 'string'],
                        'tgl_akhir' => ['required', 'string'],
                        'jumlah' => ['required'],
                        'ket' => ['required', 'string'],
                        'file' => ['required', 'max:5250'],
                    ]);
                } else {
                    $request->validate([
                        'kategori' => ['required', 'string'],
                        'tgl_mulai' => ['required', 'string'],
                        'tgl_akhir' => ['required', 'string'],
                        'jumlah' => ['required'],
                        'ket' => ['required', 'string'],
                    ]);
                }

                $id = Auth::user()->id;


                if ($data_cuti->sesi == "1") {
                    $jumlahsemua = Surat::where('id_karyawan', $id)->where('id_cuti', $id_cuti)
                        ->where(function ($query) {
                            $bulan = date('n');
                            $tahun = date('Y');
                            $removeY = Carbon::now()->subYears(1);
                            $resultY = date('Y', strtotime($removeY));
                            // $query->whereYear('tgl_surat', '=', $tahun) 
                            //         ->orWhereYear('tgl_surat', '=', $resultY);
                            if ($bulan <= 6) {
                                $query->whereYear('tgl_surat', '=', $tahun)
                                    ->orWhereYear('tgl_surat', '=', $resultY)
                                    ->whereMonth('tgl_surat', '>', 6);
                            } else {
                                $query->whereYear('tgl_surat', '=', $tahun)
                                    ->whereMonth('tgl_surat', '>', 6);
                            }
                        })
                        ->sum('jumlah');
                }

                $stars = date('Y-m-d', strtotime($request['tgl_mulai']));
                $last = date('Y-m-d', strtotime($request['tgl_akhir']));
                $jumlah = $request['jumlah'];

                if ($data_cuti->sesi == "1") {
                    if ($jumlahsemua == '0') {
                        $sisa = $data_cuti->jumlah_hari - $jumlah;
                        $jumlahcuti = $data_cuti->jumlah_hari;
                    } else {
                        $sisa = $data_cuti->jumlah_hari - ($jumlahsemua + $jumlah);
                        $jumlahcuti = $data_cuti->jumlah_hari - $jumlahsemua;
                    }
                } else {
                    $sisa = '0';
                    $jumlahcuti = $data_cuti->jumlah_hari;
                }
                $divisi = Auth::user()->divisi;
                if ($data_cuti->jk == 'P') {
                    $gender = 'Perempuan';
                } else {
                    $gender = 'Laki-Laki';
                }

                if ($data_cuti->sesi == "1" && $jumlahsemua + $jumlah > $data_cuti->jumlah_hari) {
                    return redirect()->back()->with(['warning' => 'Cuti Yang Anda Pilih Tersisa ' . $jumlahcuti . ' Hari di Tahun Ini!']);
                } elseif ($data_cuti->sesi == "0" &&  $jumlah > $data_cuti->jumlah_hari) {
                    return redirect()->back()->with(['warning' => $data_cuti->jenis . ' Maksimal ' . $data_cuti->jumlah_hari . ' Hari!']);
                } elseif ($data_cuti->jk != "all" &&  $data_cuti->jk != Auth::user()->jk) {
                    return redirect()->back()->with(['warning' => $data_cuti->jenis . ' Hanya Untuk Karyawan ' . $gender]);
                } else {
                    if ($data_cuti->file == '1') {
                        $ori_file = $request->file;
                        $nama_file = time() . "_" . $ori_file->getClientOriginalName();
                        $ori_file->move(\public_path() . '/file/', $nama_file);
                    } else {
                        $nama_file = '-';
                    }

                    if (Auth::user()->status == "5" || Auth::user()->status == "4" || Auth::user()->status == "2") {
                        $datapimpinan = Daftaruser::where("status", 1)->first();
                        $email = $datapimpinan->email;
                        TemporariSurat::insert(
                            [
                                'id_karyawan' => Auth::user()->id,
                                'id_cuti' => $request['kategori'],
                                'divisi' => Auth::user()->divisi,
                                'sts' => Auth::user()->status,
                                'tgl_mulai' => $stars,
                                'tgl_akhir' => $last,
                                'sisa' => $sisa,
                                'jumlah' => $jumlah,
                                'ket' => $request['ket'],
                                'file' => $nama_file,
                                'rekom1' => '1',
                                'ket_rekom1' => '-',
                                'rekom2' => '1',
                                'ket_rekom2' => '-',
                                'rekom3' => '0',
                                'ket_rekom3' => '-',
                                'tgl_input' => now(),

                            ]
                        );

                        $details = [
                            'name' =>       Auth::user()->name,
                            'divisi' =>     Auth::user()->divisi,
                            'email' =>      Auth::user()->email,
                            'jabatan' =>    Auth::user()->jabatan,
                            'kategori' =>   $data_cuti->jenis,
                            'mulai' =>      $stars,
                            'akhir' =>      $last,
                            'sisa' =>       $sisa,
                            'jumlah' =>     $jumlah,
                            'body' =>       $request['ket'],
                        ];
                        try {
                            Mail::to($email)->send(new KirimEmail($details));
                        } catch (\Exception $e) {
                        }
                    } elseif (Auth::user()->status == "6" || Auth::user()->status == "11" || Auth::user()->status == "12" || Auth::user()->status == "7" || Auth::user()->status == "10") {
                        if (Auth::user()->divisi == "YAYASAN") {
                            $datapimpinan =  Daftaruser::where("status", 4)->first();
                        } else if ($divisi == "DAYCARE") {
                            $datapimpinan =  Daftaruser::where(["divisi" => "KB-TK", "status" => '3'])->first();
                        } else {
                            $datapimpinan =  Daftaruser::where("status", 3)->first();
                        }
                        $email = $datapimpinan->email;
                        TemporariSurat::insert(
                            [
                                'id_karyawan' => Auth::user()->id,
                                'id_cuti' => $request['kategori'],
                                'divisi' => Auth::user()->divisi,
                                'sts' => Auth::user()->status,
                                'tgl_mulai' => $stars,
                                'tgl_akhir' => $last,
                                'sisa' => $sisa,
                                'jumlah' => $jumlah,
                                'ket' => $request['ket'],
                                'file' => $nama_file,
                                'rekom1' => '0',
                                'ket_rekom1' => '-',
                                'rekom2' => '0',
                                'ket_rekom2' => '-',
                                'rekom3' => '0',
                                'ket_rekom3' => '-',
                                'tgl_input' => now(),

                            ]
                        );

                        $details = [
                            'name' =>       Auth::user()->name,
                            'divisi' =>     Auth::user()->divisi,
                            'email' =>      Auth::user()->email,
                            'jabatan' =>    Auth::user()->jabatan,
                            'kategori' =>   $data_cuti->jenis,
                            'mulai' =>      $stars,
                            'akhir' =>      $last,
                            'sisa' =>       $sisa,
                            'jumlah' =>     $jumlah,
                            'body' =>       $request['ket'],
                        ];
                        try {
                            Mail::to($email)->send(new KirimEmail($details));
                        } catch (\Exception $e) {
                        }
                    } elseif (Auth::user()->status == "3") {
                        $datapimpinan =  Daftaruser::where("status", 2)->first();
                        $email = $datapimpinan->email;
                        TemporariSurat::insert(
                            [
                                'id_karyawan' => Auth::user()->id,
                                'id_cuti' => $request['kategori'],
                                'divisi' => Auth::user()->divisi,
                                'sts' => Auth::user()->status,
                                'tgl_mulai' => $stars,
                                'tgl_akhir' => $last,
                                'sisa' => $sisa,
                                'jumlah' => $jumlah,
                                'ket' => $request['ket'],
                                'file' => $nama_file,
                                'rekom1' => '1',
                                'ket_rekom1' => 'disetujui dengan syarat',
                                'rekom2' => '0',
                                'ket_rekom2' => '-',
                                'rekom3' => '0',
                                'ket_rekom3' => '-',
                                'tgl_input' => now(),

                            ]
                        );

                        $details = [
                            'name' =>       Auth::user()->name,
                            'divisi' =>     Auth::user()->divisi,
                            'email' =>      Auth::user()->email,
                            'jabatan' =>    Auth::user()->jabatan,
                            'kategori' =>   $data_cuti->jenis,
                            'mulai' =>      $stars,
                            'akhir' =>      $last,
                            'sisa' =>       $sisa,
                            'jumlah' =>     $jumlah,
                            'body' =>       $request['ket'],
                        ];
                        try {
                            Mail::to($email)->send(new KirimEmail($details));
                        } catch (\Exception $e) {
                        }
                    } else {
                        if (Auth::user()->status == "9") {
                            $datapimpinan =  Daftaruser::where(["status" => '2'])->first();
                            $email = $datapimpinan->email;
                            TemporariSurat::insert(
                                [
                                    'id_karyawan' => Auth::user()->id,
                                    'id_cuti' => $request['kategori'],
                                    'divisi' => Auth::user()->divisi,
                                    'sts' => Auth::user()->status,
                                    'tgl_mulai' => $stars,
                                    'tgl_akhir' => $last,
                                    'sisa' => $sisa,
                                    'jumlah' => $jumlah,
                                    'ket' => $request['ket'],
                                    'file' => $nama_file,
                                    'rekom1' => '1',
                                    'ket_rekom1' => 'disetujui dengan syarat',
                                    'rekom2' => '0',
                                    'ket_rekom2' => '-',
                                    'rekom3' => '0',
                                    'ket_rekom3' => '-',
                                    'tgl_input' => now(),

                                ]
                            );

                            $details = [
                                'name' =>       Auth::user()->name,
                                'divisi' =>     Auth::user()->divisi,
                                'email' =>      Auth::user()->email,
                                'jabatan' =>    Auth::user()->jabatan,
                                'kategori' =>   $data_cuti->jenis,
                                'mulai' =>      $stars,
                                'akhir' =>      $last,
                                'sisa' =>       $sisa,
                                'jumlah' =>     $jumlah,
                                'body' =>       $request['ket'],
                            ];
                            try {
                                Mail::to($email)->send(new KirimEmail($details));
                            } catch (\Exception $e) {
                            }
                        }
                    }
                }
            }
            return redirect('datasuratcutisaya');
        } catch (Exception $e) {
            return  redirect()->back()->with(['warning' => $e->getMessage()]);
        }
    }

    public function editajukancuti($id, Request $request)
    {
        try {
            $surat =  TemporariSurat::where("id_surat", $id)->first();
            if ($request['kategori'] == '') {
                $request->validate([
                    'kategori' => ['required', 'string'],
                ]);
            } else {
                $id_cuti = $request['kategori'];
                $data_cuti = JenisCuti::find($id_cuti);
                if ($data_cuti->file == "1") {
                    if ($surat->file != '-') {
                        $request->validate([
                            'kategori' => ['required', 'string'],
                            'tgl_mulai' => ['required', 'string'],
                            'tgl_akhir' => ['required', 'string'],
                            'jumlah' => ['required'],
                            'ket' => ['required', 'string'],
                        ]);
                    } else {
                        $request->validate([
                            'kategori' => ['required', 'string'],
                            'tgl_mulai' => ['required', 'string'],
                            'tgl_akhir' => ['required', 'string'],
                            'jumlah' => ['required'],
                            'ket' => ['required', 'string'],
                            'file' => ['required', 'max:5250'],
                        ]);
                    }
                } else {
                    $request->validate([
                        'kategori' => ['required', 'string'],
                        'tgl_mulai' => ['required', 'string'],
                        'tgl_akhir' => ['required', 'string'],
                        'jumlah' => ['required'],
                        'ket' => ['required', 'string'],
                    ]);
                }

                $idd = Auth::user()->id;
                if ($data_cuti->sesi == "1") {
                    $jumlahsemua = Surat::where('id_karyawan', $idd)->where('id_cuti', $id_cuti)
                        ->where(function ($query) {
                            $tahun = date('Y');
                            $removeY = Carbon::now()->subYears(1);
                            $resultY = date('Y', strtotime($removeY));
                            $query->whereYear('tgl_surat', '=', $tahun)
                                ->orWhereYear('tgl_surat', '=', $resultY);
                        })->where(function ($query) {
                            $bulan = date('m');
                            if ($bulan <= 6) {
                                $query->whereMonth('tgl_surat', '>', 6);
                            }
                        })
                        ->sum('jumlah');
                }
                $stars = date('Y-m-d', strtotime($request['tgl_mulai']));
                $last = date('Y-m-d', strtotime($request['tgl_akhir']));
                $jumlah = $request['jumlah'];

                if ($data_cuti->sesi == "1") {
                    if ($jumlahsemua == '0') {
                        $sisa = $data_cuti->jumlah_hari - $jumlah;
                        $jumlahcuti = $data_cuti->jumlah_hari;
                    } else {
                        $sisa = $data_cuti->jumlah_hari - ($jumlahsemua + $jumlah);
                        $jumlahcuti = $data_cuti->jumlah_hari - $jumlahsemua;
                    }
                } else {
                    $sisa = '0';
                    $jumlahcuti = $data_cuti->jumlah_hari;
                }
                if ($data_cuti->jk == 'P') {
                    $gender = 'Perempuan';
                } else {
                    $gender = 'Laki-Laki';
                }
                if ($data_cuti->sesi == "1" && $jumlahsemua + $jumlah > $data_cuti->jumlah_hari) {
                    return redirect()->back()->with(['warning' => 'Cuti Yang Anda Pilih Tersisa ' . $jumlahcuti . ' Hari di Tahun Ini!']);
                } elseif ($data_cuti->sesi == "0" && $jumlah > $data_cuti->jumlah_hari) {
                    return redirect()->back()->with(['warning' => 'Cuti Yang Anda Pilih Maksimal ' . $data_cuti->jumlah_hari . ' Hari!']);
                } elseif ($data_cuti->jk != "all" &&  $data_cuti->jk != Auth::user()->jk) {
                    return redirect()->back()->with(['warning' => $data_cuti->jenis . ' Hanya Untuk Karyawan ' . $gender]);
                } else {
                    if ($data_cuti->file == "1" && $request['file'] != null && $surat->file == '-') {
                        $ori_file = $request->file;
                        $nama_file = time() . "_" . $ori_file->getClientOriginalName();
                        $ori_file->move(\public_path() . '/file/', $nama_file);
                    } elseif ($data_cuti->file == "1" && $request['file'] != null && $surat->file != '-') {
                        unlink(\public_path() . '/file/' . $surat->file);

                        $ori_file = $request->file;
                        $nama_file = time() . "_" . $ori_file->getClientOriginalName();
                        $ori_file->move(\public_path() . '/file/', $nama_file);
                    } elseif ($surat->file != '-' && $data_cuti->file != "1") {
                        unlink(\public_path() . '/file/' . $surat->file);
                        $nama_file = '-';
                    } else {
                        $nama_file = $surat->file;
                    }
                    try {
                        $result = TemporariSurat::find($id);
                        $result->id_cuti = $request['kategori'];
                        $result->tgl_mulai = $stars;
                        $result->tgl_akhir = $last;
                        $result->sisa = $sisa;
                        $result->jumlah = $jumlah;
                        $result->ket = $request['ket'];
                        $result->file = $nama_file;
                        $result->save();
                    } catch (\Exception $e) {
                    }
                    return redirect('datasuratcutisaya');
                }
            }
        } catch (Exception $e) {
            return  redirect()->back()->with(['warning' => 'Error']);
        }
    }
    public function simpaneditsuratcuti($id, Request $request)
    {
        try {
            date_default_timezone_set('Asia/Jakarta');
            $surat =  Surat::where("id_surat", $id)->first();
            if ($request['kategori'] == '') {
                $request->validate([
                    'kategori' => ['required', 'string'],
                ]);
            } else {
                $id_cuti = $request['kategori'];
                $data_cuti = JenisCuti::find($id_cuti);
                if ($data_cuti->file == "1") {
                    if ($surat->file != '-') {
                        $request->validate([
                            'kategori' => ['required', 'string'],
                            'tgl_mulai' => ['required', 'string'],
                            'tgl_akhir' => ['required', 'string'],
                            'jumlah' => ['required'],
                            'ket' => ['required', 'string'],
                            'rekom1' => ['required', 'string'],
                            'rekom2' => ['required', 'string'],
                            'rekom3' => ['required', 'string'],
                            'tgl_surat' => ['required', 'string'],
                        ]);
                    } else {
                        $request->validate([
                            'kategori' => ['required', 'string'],
                            'tgl_mulai' => ['required', 'string'],
                            'tgl_akhir' => ['required', 'string'],
                            'jumlah' => ['required'],
                            'ket' => ['required', 'string'],
                            'rekom1' => ['required', 'string'],
                            'rekom2' => ['required', 'string'],
                            'rekom3' => ['required', 'string'],
                            'tgl_surat' => ['required', 'string'],
                            'file' => ['required', 'max:5250'],
                        ]);
                    }
                } else {
                    $request->validate([
                        'kategori' => ['required', 'string'],
                        'tgl_mulai' => ['required', 'string'],
                        'tgl_akhir' => ['required', 'string'],
                        'jumlah' => ['required'],
                        'ket' => ['required', 'string'],
                        'rekom1' => ['required', 'string'],
                        'rekom2' => ['required', 'string'],
                        'rekom3' => ['required', 'string'],
                        'tgl_surat' => ['required', 'string'],
                    ]);
                }

                $idd = Auth::user()->id;
                $tahun = date('Y');
                if ($data_cuti->sesi == "1") {
                    $jumlahsemua = Surat::where(['id_karyawan' => $idd, 'id_cuti' => $request['kategori'], 'tahun' => $tahun])->sum('jumlah');
                }
                $stars = date('d-m-Y', strtotime($request['tgl_mulai']));
                $last = date('d-m-Y', strtotime($request['tgl_akhir']));
                $jumlah = $request['jumlah'];

                if ($data_cuti->sesi == "1") {
                    if ($jumlahsemua == '0') {
                        $sisa = $data_cuti->jumlah_hari - $jumlah;
                        $jumlahcuti = $data_cuti->jumlah_hari;
                    } else {
                        $sisa = $data_cuti->jumlah_hari - ($jumlahsemua + $jumlah);
                        $jumlahcuti = $data_cuti->jumlah_hari - $jumlahsemua;
                    }
                } else {
                    $sisa = '0';
                    $jumlahcuti = $data_cuti->jumlah_hari;
                }

                if ($data_cuti->sesi == "1" && $jumlahsemua + $jumlah > $data_cuti->jumlah_hari) {
                    return redirect()->back()->with(['warning' => 'Cuti Yang Anda Pilih Tersisa ' . $jumlahcuti . ' Hari di Tahun Ini!']);
                } elseif ($data_cuti->sesi == "0" && $jumlah > $data_cuti->jumlah_hari) {
                    return redirect()->back()->with(['warning' => 'Cuti Yang Anda Pilih Maksimal ' . $data_cuti->jumlah_hari . ' Hari!']);
                } else {
                    if ($data_cuti->file == "1" && $request['file'] != null && $surat->file == '-') {
                        $ori_file = $request->file;
                        $nama_file = time() . "_" . $ori_file->getClientOriginalName();
                        $ori_file->move(\public_path() . '/file/', $nama_file);
                    } elseif ($data_cuti->file == "1" && $request['file'] != null && $surat->file != '-') {
                        unlink(\public_path() . '/file/' . $surat->file);

                        $ori_file = $request->file;
                        $nama_file = time() . "_" . $ori_file->getClientOriginalName();
                        $ori_file->move(\public_path() . '/file/', $nama_file);
                    } elseif ($surat->file != '-' && $data_cuti->file != "1") {
                        unlink(\public_path() . '/file/' . $surat->file);
                        $nama_file = '-';
                    } else {
                        $nama_file = $surat->file;
                    }
                    $result = Surat::find($id);
                    $result->id_cuti = $request['kategori'];
                    $result->kategori_cuti = $data_cuti->jenis;
                    $result->tgl_mulai = $stars;
                    $result->tgl_akhir = $last;
                    $result->sisa = $sisa;
                    $result->jumlah = $jumlah;
                    $result->ket = $request['ket'];
                    $result->ket_rekom1 = $request['rekom1'];
                    $result->ket_rekom2 = $request['rekom2'];
                    $result->ket_rekom3 = $request['rekom3'];
                    $result->tgl_surat = $request['tgl_surat'];
                    $result->file = $nama_file;
                    $result->save();

                    LogEdit::insert([
                        'id_karyawan' => Auth::user()->id,
                        'nama' => Auth::user()->name,
                        'keterangan' => 'mengubah surat cuti',
                        'date' => now(),
                    ]);
                    return redirect()->back()->with(['info' => 'Data Surat Berhasil Diubah']);
                }
            }
        } catch (Exception $e) {
            return  redirect()->back()->with(['warning' => 'Error']);
        }
    }
    // ganti pass karyawan sendiri
    public function gantipass(Request $request)
    {
        // try{
        $id = Auth::user()->id;
        $validatedData = $request->validate([
            'passwordlama' => 'required',
            'passwordbaru' => ['required', 'string', 'min:8'],
            'passwordkonformasi' => ['required', 'string', 'min:8'],
        ], [
            'passwordlama.required' => 'Kolom password lama harus diisi.',
            'passwordbaru.required' => 'Kolom password baru harus diisi.',
            'passwordbaru.min' => 'Panjang password baru minimal 8 karakter.',
            'passwordkonformasi.required' => 'Kolom konfirmasi password harus diisi.',
            'passwordkonformasi.min' => 'Panjang konfirmasi password minimal 8 karakter.',
        ]);

        if ($validatedData) {
            $pass_lama = $request['passwordlama'];
            $cek_pass = $request['passwordbaru'];
            $cek_pass2 = $request['passwordkonformasi'];
            $data = User::find($id);
            $cek_password =  Hash::check($pass_lama, $data->password);
            if (!$cek_password) {
                return redirect()->back()->with(['warning' => 'Password lama tidak sesuai']);
            } elseif ($cek_pass != $cek_pass2) {
                return redirect()->back()->with(['warning' => 'Konfirmasi password tidak sesuai']);
            } else {
                $passnew =  Hash::make($request['passwordbaru']);
                $result = User::find($id);
                $result->password = $passnew;
                $result->save();
                if ($result->sts_lms == 'Y') {
                    Http::post(env('APP_URLLMS') . 'resetPassword', [
                        'id' => $id,
                        'pass' => $passnew,
                    ]);
                }
                if ($result->stts_nse == 'Y') {
                    $data = [
                        'password_hash' => $passnew,
                        'updated_at' => now()
                    ];
                    DB::connection('nse')->table('users')->where('id_karyawan', $id)->update($data);
                }

                return redirect()->back()->with(['info' => 'Password Berhasil Diubah']);
            }
        }
        // }catch(Exception $e){
        //       return  redirect()->back()->with(['warning'=>$e->getMessage()]);
        // } 
    }
    // delete Surat
    public function hapusSurat($id)
    {
        $result = TemporariSurat::find($id);
        $result->delete();
        if ($result->file != '-') {
            unlink(\public_path() . '/file/' . $result->file);
        }
        return redirect()->back();
    }
    public function hapusSuratadmin($id)
    {
        $result = Surat::find($id);
        $result->delete();
        LogEdit::insert([
            'id_karyawan' => Auth::user()->id,
            'nama' => Auth::user()->name,
            'keterangan' => 'menghapus surat cuti',
            'date' => now(),
        ]);
        if ($result->file != '-') {
            unlink(\public_path() . '/file/' . $result->file);
        }
        return redirect()->back();
    }
}
