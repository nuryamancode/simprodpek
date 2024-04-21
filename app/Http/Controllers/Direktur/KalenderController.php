<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\MDirektur;
use App\Models\MKalender;
use App\Models\MNotifikasi;
use App\Models\MProyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KalenderController extends Controller
{
    public function __invoke(Request $request)
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $proyek = MProyek::all();
        $detail_events = MKalender::all();
        $events = [];
        $timeline = MKalender::with('proyek')->get();

        foreach ($timeline as $value) {
            $events[] = [
                'title' =>  $value->proyek->nama_proyek,
                'start' => $value->proyek->tanggal_mulai,
                'end' => $value->proyek->tanggal_selesai,
            ];
        }
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'events' => $events,
            'proyek' => $proyek,
            'detail_events' => $detail_events,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];

        return view('direkturs.direktur-kalender', $data);
    }


    public function save(Request $request)
    {
        $proyek_id = $request->input('proyek_id');
        $proyek = MProyek::find($proyek_id);

        $data = new MKalender([
            'proyek_id' => $proyek->id_proyek,
        ]);

        if ($data->save()) {
            alert()->toast('Acara berhasil ditambahkan', 'success');
            return redirect()->back();
        }
    }


    public function delete(MKalender $kalender)
    {
        $kalender->delete();
        alert()->toast('Acara berhasil dihapus', 'success');
        return redirect()->back();
    }
}
