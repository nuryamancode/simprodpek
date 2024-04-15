<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\MBidang;
use App\Models\MHr;
use App\Models\MKaryawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataKaryawanController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $karyawan = MKaryawan::with('user')->get();
        $bidang = MBidang::all();
        $data = [
            'role' => $role,
            'hr' => $hr,
            'karyawan' => $karyawan,
            'bidang' => $bidang,
        ];
        return view('hr.hr-data-karyawan', $data);
    }

    public function tambah_bidang(string $id_karyawan, Request $request)
    {
        $karyawan = MKaryawan::find($id_karyawan);
        $bidang_id = $request->input('bidang_id');
        $karyawan->update([
            'bidang_id' => $bidang_id
        ]);
        alert()->toast('Bidang berhasil ditambahkan', 'success');
        return redirect()->back();
    }

    function delete($id)
    {
        alert()->toast('Data berhasil dihapus', 'success');
        $karyawan = MKaryawan::find($id);
        if ($karyawan) {
            $karyawan->delete();
            return redirect()->back();
        }
    }
}
