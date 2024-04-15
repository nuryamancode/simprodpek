<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\MDirektur;
use App\Models\MNotifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DirekturController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('direkturs.direktur-dashboard', $data);
    }

    function profil()
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('direkturs.direktur-profil', $data);
    }
    function edit()
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('direkturs.direktur-edit-profil', $data);
    }

    function update(Request $request)
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

        $direktur = MDirektur::where('user_id', $user_id)->first();

        $direktur->nama_lengkap = $request->input('name');
        $direktur->alamat = $request->input('alamat');
        $direktur->no_handphone = $request->input('no_handphone');

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');

            if ($file->isValid()) {
                $fotoName = uniqid() . '.' .  $file->getClientOriginalExtension();
                $file->move('assets/dokumen/foto_profil', $fotoName);
                $direktur->foto_profil = $fotoName;
            } else {
                return redirect()->back()->withErrors(['foto_profil' => 'File tidak valid']);
            }
        }

        if ($direktur->save()) {
            alert()->toast('Profil berhasil diperbarui', 'success');
            return redirect()->route('direktur.profil');
        }
    }

    public function notifikasi(){
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $notifikasi1 = MNotifikasi::where('user_id', $user_id)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'notifikasi'=> $notifikasi,
            'notifikasi1'=> $notifikasi1,
            'jumlah'=> $jumlah
        ];
        return view('direkturs.direktur-notifikasi', $data);
    }
}
