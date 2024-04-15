<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\MDirektur;
use App\Models\MHr;
use App\Models\MKaryawan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManajemenUserController extends Controller
{
    function index()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $user = User::whereIn('role', ['Direktur', 'Karyawan'])->get();
        $role = Auth::user()->role;
        $direktur = MDirektur::where('user_id')->get();
        $karyawan = MKaryawan::where('user_id')->get();
        $data = [
            'role' => $role,
            'user' => $user,
            'hr' => $hr,
            'direktur' => $direktur,
            'karyawan' => $karyawan,
        ];
        return view('hr.hr-manajemen-user', $data);
    }

    function save(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'name' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'name.required' => 'Nama wajib diisi',
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
        $role = $request->input('role');
        $name = $request->input('name');

        $user = User::create([
            'email' => $email,
            'password' => bcrypt($password),
            'role' => $role,
        ]);
        if ($user) {
            if ($role == 'Human Resource') {
                MHr::create([
                    'nama_lengkap' => $name,
                    'user_id' => $user->id
                ]);
            } elseif ($role == 'Direktur') {
                MDirektur::create([
                    'nama_lengkap' => $name,
                    'user_id' => $user->id
                ]);
            } elseif ($role == 'Karyawan') {
                $karyawan = MKaryawan::create([
                    'nama_lengkap' => $name,
                    'user_id' => $user->id
                ]);
                if ($karyawan) {
                    event(new Registered($user));
                    alert()->toast('Registrasi Berhasil Silahkan Verifikasi Email', 'success');
                    Auth::login($user);
                    return redirect()->back()->with('success', 'Email sudah terverifikasi');
                } else {
                    $user->delete();
                    alert()->toast('Registrasi Gagal', 'error');
                    return redirect()->back();
                }
            }
            alert()->toast('Berhasil menambahkan data', 'success');
            return redirect()->back();
        } else {
            alert()->toast('Registrasi Gagal', 'error');
            return redirect()->back();
        }
    }

    function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'email.email' => 'Email harus ada "@"',
            'password.min' => 'Password harus minimal 8 character',
        ]);
        $user = User::find($id);
        $name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $create = $user->save();
        if ($create) {
            if ($user->role == 'Human Resource') {
                $hr = MHr::where('user_id', $user->id)->first();
                if ($hr) {
                    $hr->update(['nama_lengkap' => $name]);
                } else {
                    MHr::create(['user_id' => $user->id, 'nama_lengkap' => $name]);
                }
            } elseif ($user->role == 'Direktur') {
                $direktur = MDirektur::where('user_id', $user->id)->first();
                if ($direktur) {
                    $direktur->update(['nama_lengkap' => $name]);
                } else {
                    MDirektur::create(['user_id' => $user->id, 'nama_lengkap' => $name]);
                }
            } elseif ($user->role == 'Karyawan') {
                $karyawan = MKaryawan::where('user_id', $user->id)->first();
                if ($karyawan) {
                    $karyawan->update(['nama_lengkap' => $name]);
                } else {
                    MKaryawan::create(['user_id' => $user->id, 'nama_lengkap' => $name]);
                }
            }
            alert()->toast('Data berhasil diperbarui', 'success');
            return redirect()->back();
        } else {
            alert()->toast('Data tidak berhasil diperbarui', 'error');
            return redirect()->back();
        }
    }

    function delete(User $user)
    {
        alert()->toast('Data berhasil dihapus', 'success');
        $user->delete();
        return redirect()->back();
    }
}
