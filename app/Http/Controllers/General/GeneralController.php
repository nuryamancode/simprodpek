<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\MNotifikasi;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function download_berkas_proyek($berkas)
    {
        return response()->download(public_path('assets/dokumen/berkas_tugas/' . $berkas));
    }
    public function download_hasil_proyek($uploadberkas)
    {
        return response()->download(public_path('assets/dokumen/berkas_hasil/' . $uploadberkas));
    }

    public function download_berkas_klien($berkas_klien)
    {
        $filePath = public_path('assets/dokumen/berkas_klien/' . $berkas_klien);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found');
        }
    }

    public function notifikasi_dibaca($id_notifikasi)
    {
        $notifikasi = MNotifikasi::findOrFail($id_notifikasi);
        $notifikasi->update(['dibaca' => true]);
        return redirect()->back();
    }

    public function delete_all_notifikasi(Request $request)
    {
        $user_id = auth()->id();
        MNotifikasi::where('user_id', $user_id)->delete();
        return redirect()->back();
    }
}
