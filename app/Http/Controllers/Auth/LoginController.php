<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        // Validasi input login
        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') && $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Logika kustom untuk cek NIK dan status kerja
        $cek = User::whereNik($request->input('nik'))->first();
        if (!$cek) {
            return redirect()->back()->with('info', 'NIK Yang Anda Masukkan Tidak Terdaftar');
        }

        $user = User::whereNik($request->input('nik'))->whereStatus_kerja('1')->first();
        if (!$user) {
            return redirect()->back()->with('danger', 'Akun Anda Nonaktif, Silahkan Hubungi Admin');
        }

        if (!Hash::check($request->input('password'), $user->password)) {
            return redirect()->back()->with('warning', 'Password Anda Salah');
        }

        // Jika semua cek lolos, login user
        Auth::login($user);
        return $this->sendLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
        return [
            'nik' => $request->input('nik'),
            'password' => $request->input('password'),
        ];
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'nik' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
