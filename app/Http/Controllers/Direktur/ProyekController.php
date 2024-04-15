<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\MDirektur;
use App\Models\MKlien;
use App\Models\MNotifikasi;
use App\Models\MProyek;
use App\Models\MTim;
use App\Models\MTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyekController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $proyek = MProyek::all();
        $klien = MKlien::all();
        $tim = MTim::get();
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'proyek' => $proyek,
            'tim' => $tim,
            'klien' => $klien,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('direkturs.direktur-proyek', $data);
    }

    public function save(Request $request)
    {
        $request->validate(
            [
                'nama_proyek' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            ],
            [
                'nama_proyek.required' => 'Nama Proyek harus diisi',
                'tanggal_mulai.required' => 'Tanggal Mulai harus diisi',
                'tanggal_selesai.after_or_equal' => 'Tanggal Selesai harus setelah atau sama dengan Tanggal Mulai',
            ]
        );

        $klienId = $request->input('klien_id');
        $klien = MKlien::find($klienId);
        $timId = $request->input('tim_id');
        $tim = MTim::find($timId);
        $data = new MProyek([
            'nama_proyek' => $request->input('nama_proyek'),
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_selesai' => $request->input('tanggal_selesai'),
            'klien_id' => $klien->id,
            'tim_id' => $tim->id,
        ]);
        if ($data->save()) {
            alert()->toast('Data berhasil ditambahkan', 'success');
            return redirect()->back();
        }
    }

    public function update(Request $request, string $id_proyek)
    {
        $request->validate(
            [
                'nama_proyek' => 'required',
                'tanggal_mulai' => 'required',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            ],
            [
                'nama_proyek.required' => 'Nama Proyek harus diisi',
                'tanggal_mulai.required' => 'Tanggal Mulai harus diisi',
                'tanggal_selesai.after_or_equal' => 'Tanggal Selesai harus setelah atau sama dengan Tanggal Mulai',
            ]
        );

        $proyek = MProyek::find($id_proyek);

        if (!$proyek) {
            abort(404, 'Data tidak ditemukan');
        }
        $klienId = $request->input('klien_id');
        $klien = MKlien::find($klienId);

        $proyek->update([
            'nama_proyek' => $request->input('nama_proyek'),
            'tanggal_mulai' => $request->input('tanggal_mulai'),
            'tanggal_selesai' => $request->input('tanggal_selesai'),
            'klien_id' => $klien->id,
        ]);

        alert()->toast('Data berhasil diperbarui', 'success');
        return redirect()->back();
    }

    public function delete(MProyek $proyek)
    {
        $proyek->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->route('direktur.proyek');
    }



    public function laporan()
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $proyek = MProyek::whereIn('status_proyek', ['Selesai'])->get();
        $klien = MKlien::all();
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'proyek' => $proyek,
            'klien' => $klien,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('direkturs.direktur-laporan-selesai', $data);
    }

    public function proyek_selesai($proyek_id) {
        $proyek = MProyek::findOrFail($proyek_id);
        $checktugas = MTugas::where('proyek_id', $proyek_id)->where('status_tugas', '!=', 'Done')->exists();

        if ($checktugas) {
            alert()->toast('Proyek belum selesai, karena ada tugas yang belum selesai', 'error');
            return redirect()->back();
        }

        $proyek->status_proyek = 'Selesai';
        $proyek->save();
        alert()->toast('Proyek Sudah Selesai', 'success');
        return redirect()->route('direktur.proyek');
    }
}
