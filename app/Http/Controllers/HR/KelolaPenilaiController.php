<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Penilaian\JenisPenilaian;
use App\Models\MHr;
use App\Models\Penilaian\Penilai;
use App\Models\Penilaian\Periode;
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
        $periode = Periode::all();
        $data = [
            'role' => $role,
            'hr' => $hr,
            'jenispenilaian' => $jenispenilaian,
            'kelolapenilai' => $kelolapenilai,
            'periode' => $periode,
        ];
        return view('hr.hr-kelola-penilai', $data);
    }

    public function save(Request $request)
    {
        $periodeId = $request->input('periode_id');
        $jenispenilai = $request->input('jenis_penilai_id');
        $jenidinilai = $request->input('jenis_dinilai');
        $data = Penilai::create([
            'periode_id' => $periodeId,
            'jenis_penilai_id' => $jenispenilai,
            'jenis_dinilai' => $jenidinilai
        ]);
        $data->save();
        alert()->toast('Data berhasil ditambahkan', 'success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $periodeId = $request->input('periode_id');
        $jenis_penilai_id = $request->input('jenis_penilai_id');
        $jenis_dinilai = $request->input('jenis_dinilai');
        $penilai = Penilai::find($id);
        $penilai->periode_id = $periodeId;
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

    // periode
    public function save_periode(Request $request)
    {
        $periode = $request->input('periode');
        $data = Periode::create([
            'periode' => $periode,
        ]);
        $data->save();
        alert()->toast('Data berhasil ditambahkan', 'success');
        return redirect()->back();
    }

    public function update_periode(Request $request, $id)
    {
        $periodeId = $request->input('periode');
        $periode = Periode::find($id);
        $periode->periode = $periodeId;
        $periode->update();
        alert()->toast('Data berhasil diperbaharui', 'success');
        return redirect()->back();
    }

    public function delete_periode($id)
    {
        $data = Periode::find($id);
        $data->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
