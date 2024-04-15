<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\MKaryawan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function index()
    {
        return view('auths.login');
    }
    function home()
    {
        return view('auths.home');
    }

    function register()
    {
        return view('auths.register');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email salah, berikan tanda @',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = auth()->user();

            if ($user->email_verified_at === null) {
                switch ($user->role) {
                    case 'Human Resource':
                        return redirect('/hr');
                    case 'Direktur':
                        return redirect('/direktur');
                    default:
                        Auth::logout();
                        alert()->toast('Email harus terverifikasi', 'error');
                        return redirect('/login');
                }
            } else {
                if ($user->role == 'Karyawan') {
                    return redirect('/karyawann');
                } else {
                    Auth::logout();
                    alert()->toast('Email harus terverifikasi', 'error');
                    return redirect('/login');
                }
            }
        } else {
            alert()->toast('Email dan Password tidak sesuai', 'error');
            return redirect()->back();
        }
    }

    function proses_register(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'nama_lengkap' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'nama_lengkap.required' => 'Nama wajib diisi',
            'email.email' => 'Format email salah, berikan tanda @',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 ch',
        ]);

        $userexs = User::where('email', $request->input('email'))->first();
        if ($userexs) {
            alert()->toast('Email sudah terdaftar', 'error');
            return redirect()->back();
        }

        $email = $request->input('email');
        $password = $request->input('password');
        $nama_lengkap = $request->input('nama_lengkap');

        $user = User::create([
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        if ($user) {
            if (!empty($nama_lengkap)) {
                $karyawan = MKaryawan::create([
                    'nama_lengkap' => $nama_lengkap,
                    'user_id' => $user->id,
                ]);

                if ($karyawan) {
                    event(new Registered($user));
                    alert()->toast('Registrasi Berhasil Silahkan Verifikasi Email', 'success');
                    if (Auth::login($user)) {
                        return redirect('/login')->with('success', 'Email sudah terverifikasi');
                    }

                    return redirect('/email/verify');
                } else {
                    $user->delete();
                    alert()->toast('Registrasi Gagal', 'error');
                    return redirect()->back();
                }
            } else {
                $user->delete();
                alert()->toast('Nama wajib diisi', 'error');
                return redirect()->back();
            }
        } else {
            alert()->toast('Registrasi Gagal', 'error');
            return redirect()->back();
        }
    }

    public function home_redirect()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'Human Resource') {
                return redirect()->route('hr.dashboard');
            } elseif (Auth::user()->role == 'Direktur') {
                return redirect()->route('direktur.dashboard');
            } elseif (Auth::user()->role == 'Karyawan') {
                return redirect()->route('karyawan.dashboard');
            } else {
                Auth::logout();
                return redirect('/');
            }
        }
    }

    function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
