<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\MDirektur;
use App\Models\MKaryawan;
use App\Models\MNotifikasi;
use App\Models\MTim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TimController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $tim =  MTim::with('karyawan')->get();
        $mkaryawann = MKaryawan::with('bidang')->get();
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'mkaryawann' => $mkaryawann,
            'tim' => $tim,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('direkturs.direktur-tim', $data);
    }

    public function save(Request $request)
    {
        $request->validate([
            'nama_tim' => 'required',
            'karyawan_id.*' => 'required|exists:karyawan,id'
        ]);
        $tim = new MTim();
        $tim->nama_tim = $request->input('nama_tim');
        $tim->save();
        $timId = $tim->id;
        $karyawanIds = $request->input('karyawan_id');
        foreach ($karyawanIds as $karyawanId) {
            DB::table('m_karyawan_m_tim')->insert([
                'm_karyawan_id' => $karyawanId,
                'm_tim_id' => $timId,
            ]);
        }
        alert()->toast('Tim berhasil dibuat', 'success');
        return redirect()->back();
    }

    public function delete($id)
    {
        $tim = MTim::find($id);
        $tim->delete();
        alert()->toast('Tim berhasil disimpan', 'success');
        return redirect()->back();
    }
}
