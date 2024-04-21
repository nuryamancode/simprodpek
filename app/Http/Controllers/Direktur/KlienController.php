<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\MDirektur;
use App\Models\MKlien;
use App\Models\MNotifikasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KlienController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $klien = MKlien::all();
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'klien' => $klien,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('direkturs.direktur-klien', $data);
    }

    public function save(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'nomor_handphone' => 'required',
            'berkas_klien' => 'required|file'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus disertai dengan @',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'nomor_handphone.required' => 'No Handphone tidak boleh kosong',
            'berkas_klien.required' => 'Berkas tidak boleh kosong'
        ]);

        if ($request->hasFile('berkas_klien')) {
            $file = $request->file('berkas_klien');
            $filename = $file->getClientOriginalName();
            $file->move('assets/dokumen/berkas_klien/', $filename);

            $nama_klien = $request->input('name');
            $email = $request->input('email');
            $alamat = $request->input('alamat');
            $nomor_handphone = $request->input('nomor_handphone');

            $data = new MKlien([
                'nama_klien' => $nama_klien,
                'email' => $email,
                'alamat' => $alamat,
                'nomor_handphone' => $nomor_handphone,
                'berkas_klien' => $filename,
            ]);

            if ($data->save()) {
                alert()->toast('Data berhasil ditambahkan', 'success');
                return redirect()->back();
            } else {
                alert()->toast('Data tidak berhasil ditambahkan', 'error');
                return redirect()->back();
            }
        } else {
            alert()->toast('Berkas tidak ditemukan', 'error');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id_klien)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
            'nomor_handphone' => 'required'
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus disertai dengan @',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'nomor_handphone.required' => 'No Handphone tidak boleh kosong',
        ]);

        $data = MKlien::find($id_klien);

        if (!$data) {
            abort(404, 'Data tidak ditemukan');
        }

        $data->nama_klien = $request->input('name');
        $data->email = $request->input('email');
        $data->alamat = $request->input('alamat');
        $data->nomor_handphone = $request->input('nomor_handphone');

        if ($request->hasFile('berkas_klien')) {
            if ($data->berkas_klien) {
                $oldFilePath = public_path('dokumen/berkas_klien/' . $data->berkas_klien);
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
            $file = $request->file('berkas_klien');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('dokumen/berkas_klien/'), $filename);
            $data->berkas_klien = $filename;
        }

        if ($data->save()) {
            alert()->toast('Data berhasil diperbaharui', 'success');
            return redirect()->back();
        } else {
            alert()->toast('Data tidak berhasil diperbaharui', 'error');
            return redirect()->back();
        }
    }

    public function delete(MKlien $klien)
    {
        $klien->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
