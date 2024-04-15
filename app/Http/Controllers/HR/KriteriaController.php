<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\MHr;
use App\Models\MKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KriteriaController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $kriteria = MKriteria::all();
        $data = [
            'role' => $role,
            'hr' => $hr,
            'kriteria' => $kriteria,
        ];
        return view('hr.hr-kriteria', $data);
    }

    function save(Request $request)
    {
        $nama_kriteria = $request->input('nama_kriteria');
        $bobot_kriteria = $request->input('bobot');
        $existingKriteria = MKriteria::where('nama_kriteria', $nama_kriteria)->first();
        if ($existingKriteria) {
            alert()->toast('Nama kriteria sudah ada', 'error');
            return redirect()->back();
        }
        $total_bobot = MKriteria::sum('bobot_kriteria') + $bobot_kriteria;
        if ($total_bobot > 100) {
            alert()->toast('Total bobot kriteria melebihi 100', 'error');
            return redirect()->back();
        }
        $data = new MKriteria([
            'nama_kriteria' => $nama_kriteria,
            'bobot_kriteria' => $bobot_kriteria,
        ]);
        if ($data->save()) {
            alert()->toast('Data berhasil ditambahkan', 'success');
            return redirect()->back();
        }
    }

    function update(Request $request, $id_kriteria)
    {
        $kriteria = MKriteria::find($id_kriteria);
        $nama_kriteria = $request->input('nama_kriteria');
        $existingKriteria = MKriteria::where('nama_kriteria', $nama_kriteria)
            ->where('id', '<>', $id_kriteria)
            ->first();
        if ($existingKriteria) {
            alert()->toast('Nama kriteria sudah ada', 'error');
            return redirect()->back();
        }

        $total_bobot = MKriteria::where('id', '<>', $id_kriteria)->sum('bobot_kriteria') + $request->input('bobot');

        if ($total_bobot > 100) {
            alert()->toast('Total bobot kriteria melebihi 100', 'error');
            return redirect()->back();
        }

        $kriteria->update($request->all());
        alert()->toast('Data berhasil diperbaharui', 'success');
        return redirect()->back();
    }

    function delete(MKriteria $kriteria)
    {
        $kriteria->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
