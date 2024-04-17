<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Penilaian\JenisPenilaian;
use App\Models\MHr;
use App\Models\Penilaian\Penilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelolaPenilaiController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $jenispenilaian = JenisPenilaian::all();
        $kelolapenilai = Penilai::all();
        $data = [
            'role' => $role,
            'hr' => $hr,
            'jenispenilaian' => $jenispenilaian,
            'kelolapenilai' => $kelolapenilai,
        ];
        return view('hr.hr-kelola-penilai', $data);
    }

    public function save(Request $request)
    {
        $request->validate([
            'periode'=>'required'
        ],[
            'periode.required'=> 'Periode harus diisi dengan contoh: Januari 2024'
        ]);
        $periode = $request->input('periode');
        $jenispenilai = $request->input('jenis_penilai_id');
        $jenidinilai = $request->input('jenis_dinilai');
        $data = Penilai::create([
            'periode' => $periode,
            'jenis_penilai_id' => $jenispenilai,
            'jenis_dinilai' => $jenidinilai
        ]);
        $data->save();
        alert()->toast('Data berhasil ditambahkan', 'success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'periode'=>'required'
        ],[
            'periode.required'=> 'Periode harus diisi dengan contoh: Januari 2024'
        ]);
        $periode = $request->input('periode');
        $jenis_penilai_id = $request->input('jenis_penilai_id');
        $jenis_dinilai = $request->input('jenis_dinilai');
        $penilai = Penilai::find($id);
        $penilai->periode = $periode;
        $penilai->jenis_penilai_id = $jenis_penilai_id;
        $penilai->jenis_dinilai = $jenis_dinilai;
        $penilai->update();
        alert()->toast('Data berhasil diperbaharui', 'success');
        return redirect()->back();
    }

    public function delete($id)
    {
        $data = Penilai::find($id);
        $data->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
