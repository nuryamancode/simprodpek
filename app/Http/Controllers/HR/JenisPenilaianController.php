<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Penilaian\JenisPenilaian;
use App\Models\MHr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JenisPenilaianController extends Controller
{

    public function index()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $jenispenilaian = JenisPenilaian::all();
        $data = [
            'role' => $role,
            'hr' => $hr,
            'jenispenilaian' => $jenispenilaian,
        ];
        return view('hr.hr-jenis-penilaian', $data);
    }

    public function save(Request $request)
    {
        $nama_penilai = $request->input('nama_penilai');
        $nilai_bobot = $request->input('nilai_bobot');
        $exists = JenisPenilaian::where('nama_penilai', $nama_penilai)->first();
        $max2data = JenisPenilaian::count();
        $total_bobot = JenisPenilaian::sum('nilai_bobot') + $nilai_bobot;

        if ($exists) {
            alert()->toast('Nama Penilai Sudah ada', 'error');
            return redirect()->back();
        }
        if ($max2data >= 2) {
            alert()->toast('Kamu hanya bisa menambahkan 2 data saja', 'error');
            return redirect()->back();
        } else {
            if ($total_bobot > 100) {
                alert()->toast('Nilai Bobot tidak lebih 100%', 'error');
                return redirect()->back();
            }
        }
        $data = new JenisPenilaian([
            'nama_penilai' => $nama_penilai,
            'nilai_bobot' => $nilai_bobot,
        ]);
        $data->save();
        alert()->toast('Data berhasil ditambahkan', 'success');
        return redirect()->back();
    }


    public function update(Request $request, string $id)
    {
        $nilai_bobot = $request->input('nilai_bobot');
        $total_bobot = JenisPenilaian::sum('nilai_bobot') + $nilai_bobot;
        $jenispenilaian = JenisPenilaian::find($id);
        $jenispenilaian->nilai_bobot = $nilai_bobot;
        $jenispenilaian->update();
        alert()->toast('Data berhasil diperbaharui', 'success');
        return redirect()->back();
    }

    public function delete(string $id)
    {
        $jenispenilaian = JenisPenilaian::find($id);
        $jenispenilaian->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
