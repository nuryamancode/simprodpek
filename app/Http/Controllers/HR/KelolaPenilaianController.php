<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\MHasilPenilaian;
use App\Models\MHasilPenilaianKriteria;
use App\Models\MHr;
use App\Models\MKaryawan;
use App\Models\MPeriode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelolaPenilaianController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $karyawan = MKaryawan::all();
        $periode = MPeriode::all();
        $data = [
            'role' => $role,
            'hr' => $hr,
            'karyawan' => $karyawan,
            'periode' => $periode,
        ];
        return view('hr.hr-kelola-penilaian', $data);
    }

    public function detail($id)
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $karyawan = MKaryawan::all();
        $periode = MPeriode::findOrFail($id);
        $totalhasilkriteria = MHasilPenilaianKriteria::where('periode_id', $id)->get();
        $totalakhir = MHasilPenilaian::where('periode_id', $id)->get();
        $data = [
            'role' => $role,
            'hr' => $hr,
            'karyawan' => $karyawan,
            'totalhasilkriteria' => $totalhasilkriteria,
            'totalakhir' => $totalakhir,
            'periode' => $periode,
        ];
        return view('hr.hr-detail-penilaian', $data);
    }

    public function save(Request $request)
    {
        $request->validate([]);

        $karyawanID = $request->input('karyawan_id');
        $tanggalPeriode = $request->input('tanggal_periode');
        if (MPeriode::where('tanggal_periode', $tanggalPeriode)->exists()) {
            alert()->toast('Data periode sudah ada', 'error');
            return redirect()->back();
        }
        $karyawan = MKaryawan::findOrFail($karyawanID);
        $periode = new MPeriode([
            'karyawan_id' => $karyawan->id,
            'tanggal_periode' => $tanggalPeriode,
        ]);
        if ($periode->save()) {
            alert()->toast('Data berhasil ditambahkan', 'success');
            return redirect()->back();
        } else {
            alert()->toast('Data tidak berhasil ditambahkan', 'error');
            return redirect()->back();
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([]);
        $periode = MPeriode::findOrFail($id);
        $karyawanID = $request->input('karyawan_id');
        $karyawan = MKaryawan::findOrFail($karyawanID);
        $periode->tanggal_periode = $request->input('tanggal_periode');
        $periode->karyawan_id = $karyawan->id;
        if ($periode->save()) {
            alert()->toast('Data berhasil diperbarui', 'success');
            return redirect()->back();
        } else {
            alert()->toast('Data tidak berhasil diperbarui', 'error');
            return redirect()->back();
        }
    }

    public function delete(MPeriode $periode)
    {
        $periode->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
