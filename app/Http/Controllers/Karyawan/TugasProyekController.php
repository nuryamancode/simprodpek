<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\MDirektur;
use App\Models\MKaryawan;
use App\Models\MKlien;
use App\Models\MNotifikasi;
use App\Models\MProyek;
use App\Models\MTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TugasProyekController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $proyek = MProyek::all();
        $klien = MKlien::all();
        $tugas = MTugas::where('m_karyawan_id', $karyawan->id)->get();
        $data = [

            'role' => $role,
            'proyek' => $proyek,
            'klien' => $klien,
            'karyawan' => $karyawan,
            'tugas' => $tugas,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('karyawans.karyawan-tugas', $data);
    }

    public function detail(string $id_tugas)
    {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $proyek = MProyek::all();
        $klien = MKlien::all();
        $tugas = MTugas::find($id_tugas);
        $data = [

            'role' => $role,
            'proyek' => $proyek,
            'klien' => $klien,
            'karyawan' => $karyawan,
            'tugas' => $tugas,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('karyawans.karyawan-detail-tugas', $data);
    }

    public function upload(Request $request, string $id_tugas)
    {
        $request->validate([
            'upload_berkas' => 'required|mimes:pdf,doc,docx,jpeg,png,xls,xlsx,zip,csv,rar'
        ], [
            'upload_berkas.required' => 'File harus diisi',
            'upload_berkas.mimes' => 'File harus berformat jpeg, png, pdf, doc, docx, zip, rar, xls, csv atau xlsx',
        ]);
        $file = $request->file('upload_berkas');
        $filename = $file->getClientOriginalName();
        $file->move('assets/dokumen/berkas_hasil/', $filename);
        $data = MTugas::find($id_tugas);
        if ($data) {
            $data->update([
                'upload_berkas' => $filename,
                'catatan_karyawan' => $request->input('catatan_karyawan'),
            ]);
            $karyawan = Auth::user()->karyawan;
            $pesan = 'Berkas telah diunggah oleh ' . $karyawan->name;
            $direkturId = $data->direktur_id;
            $direktur = MDirektur::find($direkturId);
            $direkturUserId = $direktur->user_id;
            $notifikasi = new MNotifikasi();
            $notifikasi->user_id = $direkturUserId;
            $notifikasi->judul = 'Berkas Telah Diunggah';
            $notifikasi->pesan = $pesan;
            $notifikasi->save();
            alert()->toast('Berkas berhasil ditambahkan', 'success');
            return redirect()->back();
        } else {
            alert()->toast('Berkas tidak berhasil ditambahkan', 'error');
            return redirect()->back();
        }
    }

    public function tugas_selesai()
    {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $proyek = MProyek::all();
        $klien = MKlien::all();
        $tugas = MTugas::where('m_karyawan_id', $karyawan->id)->where('status_tugas', 'Selesai')->get();
        $data = [

            'role' => $role,
            'proyek' => $proyek,
            'klien' => $klien,
            'karyawan' => $karyawan,
            'tugas' => $tugas,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('karyawans.karyawan-tugas-selesai', $data);
    }

    public function detail_tugas_selesai(string $id_tugas)
    {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $proyek = MProyek::all();
        $klien = MKlien::all();
        $tugas = MTugas::find($id_tugas);
        $data = [

            'role' => $role,
            'proyek' => $proyek,
            'klien' => $klien,
            'karyawan' => $karyawan,
            'tugas' => $tugas,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('karyawans.karyawan-detail-tugas-selesai', $data);
    }
}
