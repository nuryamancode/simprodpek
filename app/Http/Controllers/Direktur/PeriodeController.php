<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\MDirektur;
use App\Models\MKaryawan;
use App\Models\MNotifikasi;
use App\Models\MPeriode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodeController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $periode = MPeriode::where('status_periode', 'Belum Dinilai')->get();
        $karyawan = MKaryawan::all();
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'karyawan' => $karyawan,
            'periode' => $periode,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('direkturs.direktur-kelola-penilaian', $data);
    }

}
