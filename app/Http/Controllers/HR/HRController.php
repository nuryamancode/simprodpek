<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\MHr;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HRController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $data = [

            'role' => $role,
            'hr' => $hr,
        ];
        return view('hr.hr-dashboard', $data);
    }

    function profil()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $password = Auth::user()->password;
        $data = [

            'role' => $role,
            'password' => $password,
            'hr' => $hr,
        ];
        return view('hr.hr-profil', $data);
    }

    public function ganti_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            alert()->toast('Password tidak sesuai', 'error');
            return back();
        }

        User::whereId(auth()->user()->id)->update([
            'password' => bcrypt($request->new_password),
        ]);
        alert()->toast('Password berhasil diperbarui', 'success');
        return back()->with('Password berhasil diperbarui');
    }

    public function edit()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $data = [
            'role' => $role,
            'hr' => $hr,
        ];
        return view('hr.hr-edit-profil', $data);
    }


    public function update(Request $request)
    {
        $user_id = auth()->id();

        $request->validate([
            'name' => 'required|string',
            'foto_profil' => 'image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'required',
            'no_handphone' => 'required'
        ], [
            'name.required' => 'Nama Lengkap wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_handphone.required' => 'Nomor Handphone wajib diisi',
            'name.string' => 'Nama harus berupa huruf',
            'foto_profil.image' => 'File harus berupa gambar',
            'foto_profil.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg',
            'foto_profil.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);

        $hr = MHr::where('user_id', $user_id)->first();

        $hr->nama_lengkap = $request->input('name');
        $hr->alamat = $request->input('alamat');
        $hr->no_handphone = $request->input('no_handphone');
        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $fotoName = $file->getClientOriginalExtension();
            $file->move('assets/dokumen/foto_profil/', $fotoName);
            $hr->foto_profil = $fotoName;
        }

        if ($hr->save()) {
            alert()->toast('Profil berhasil diperbarui', 'success');
            return redirect()->route('hr.profil');
        }
    }
}
