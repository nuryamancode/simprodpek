<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\MKaryawan;
use App\Models\MNotifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    public function index() {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $data = [

            'role' => $role,
            'karyawan' => $karyawan,
            'notifikasi'=> $notifikasi,
            'jumlah'=> $jumlah
        ];

        return view('karyawans.karyawan-dashboard', $data);
    }
    public function profil() {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id',$user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $data = [

            'role' => $role,
            'karyawan' => $karyawan,
            'notifikasi'=> $notifikasi,
            'jumlah'=> $jumlah
        ];
        return view('karyawans.karyawan-profil', $data);
    }
    public function edit() {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $data = [

            'role' => $role,
            'karyawan' => $karyawan,
            'notifikasi'=> $notifikasi,
            'jumlah'=> $jumlah
        ];
        return view('karyawans.karyawan-edit-profil', $data);
    }

    public function update(Request $request)
    {
        $user_id = auth()->id();

        $request->validate([
            'nama_lengkap' => 'required|string',
            'foto_profil' => 'image|mimes:jpeg,png,jpg|max:2048',
            'alamat'=> 'required',
            'no_handphone'=> 'required'
        ], [
            'nama_lengkap.required' => 'Nama Lengkap wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'no_handphone.required' => 'Nomor Handphone wajib diisi',
            'nama_lengkap.string' => 'Nama harus berupa huruf',
            'foto_profil.image' => 'File harus berupa gambar',
            'foto_profil.mimes' => 'Format gambar yang diperbolehkan: jpeg, png, jpg',
            'foto_profil.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);

        $karyawan = MKaryawan::where('user_id', $user_id)->first();


        $karyawan->nama_lengkap = $request->input('nama_lengkap');
        $karyawan->alamat = $request->input('alamat');
        $karyawan->no_handphone = $request->input('no_handphone');

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $fotoName = uniqid() . '.' .  $file->getClientOriginalExtension();
            $file->move('assets/dokumen/foto_profil', $fotoName);
            $karyawan->foto_profil = $fotoName;
        }

        if ($karyawan->save()) {
            alert()->toast('Profil berhasil diperbarui', 'success');
            return redirect()->route('karyawan.profil');
        }
    }

    public function notifikasi(){
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $notifikasi1 = MNotifikasi::where('user_id', $user_id)->latest()->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $data = [

            'role' => $role,
            'karyawan' => $karyawan,
            'notifikasi'=> $notifikasi,
            'notifikasi1'=> $notifikasi1,
            'jumlah'=> $jumlah
        ];
        return view('karyawans.karyawan-notifikasi', $data);
    }
}
