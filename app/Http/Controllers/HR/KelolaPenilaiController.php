<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\JenisPenilaian;
use App\Models\KelolaPenilai;
use App\Models\MHr;
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
        $kelolapenilai = KelolaPenilai::all();
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
        $periode = $request->input('periode');
        $jenispenilai = $request->input('jenis_penilai_id');
        $jenidinilai = $request->input('jenis_dinilai');
        $data = KelolaPenilai::create([
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
        $periode = $request->input('periode');
        $jenis_penilai_id = $request->input('jenis_penilai_id');
        $jenis_dinilai = $request->input('jenis_dinilai');
        $penilai = KelolaPenilai::find($id);
        $penilai->periode = $periode;
        $penilai->jenis_penilai_id = $jenis_penilai_id;
        $penilai->jenis_dinilai = $jenis_dinilai;
        $penilai->update();
        alert()->toast('Data berhasil diperbaharui', 'success');
        return redirect()->back();
    }

    public function delete($id)
    {
        $data = KelolaPenilai::find($id);
        $data->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
