<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\MHasilPenilaianKriteria;
use App\Models\MKaryawan;
use App\Models\MNotifikasi;
use App\Models\MPeriode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasilKinerjaController extends Controller
{
    public function index() {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $periode = MPeriode::where('karyawan_id', $karyawan->id)->where('status_periode', 'Sudah Dinilai')->get();
        $data = [

            'role' => $role,
            'karyawan' => $karyawan,
            'periode' => $periode,
            'notifikasi'=> $notifikasi,
            'jumlah'=> $jumlah
        ];

        return view('karyawans.karyawan-hasil-kinerja', $data);
    }

    public function detail($id) {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $periode = MPeriode::findOrFail($id);
        $totalhasilkriteria = MHasilPenilaianKriteria::where('periode_id', $id)->get();
        $data = [

            'role' => $role,
            'karyawan' => $karyawan,
            'periode' => $periode,
            'notifikasi'=> $notifikasi,
            'totalhasilkriteria'=> $totalhasilkriteria,
            'jumlah'=> $jumlah
        ];

        return view('karyawans.karyawan-detail-hasil', $data);
    }
}
