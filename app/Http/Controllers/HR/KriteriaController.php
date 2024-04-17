<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Penilaian\KriteriaDirektur;
use App\Models\Penilaian\KriteriaRekanKerja;
use App\Models\MHr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KriteriaController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $kriteriaDirektur = KriteriaDirektur::all();
        $kriteriaRekanKerja = KriteriaRekanKerja::all();
        $data = [
            'role' => $role,
            'hr' => $hr,
            'kriteriaDirektur' => $kriteriaDirektur,
            'kriteriaRekanKerja' => $kriteriaRekanKerja,
        ];
        return view('hr.hr-kriteria', $data);
    }

    public function save_kriteria_direktur(Request $request)
    {
        $nama_kriteria = $request->input('nama_kriteria');
        $bobot_kriteria = $request->input('bobot');
        $existingKriteria = KriteriaDirektur::where('nama_kriteria', $nama_kriteria)->first();
        if ($existingKriteria) {
            alert()->toast('Nama kriteria sudah ada', 'error');
            return redirect()->back();
        }
        $total_bobot = KriteriaDirektur::sum('bobot_kriteria') + $bobot_kriteria;
        if ($total_bobot > 100) {
            alert()->toast('Total bobot kriteria melebihi 100', 'error');
            return redirect()->back();
        }
        $data = new KriteriaDirektur([
            'nama_kriteria' => $nama_kriteria,
            'bobot_kriteria' => $bobot_kriteria,
        ]);
        if ($data->save()) {
            alert()->toast('Data berhasil ditambahkan', 'success');
            return redirect()->back();
        }
    }

    public function update_kriteria_direktur(Request $request, $id_kriteria)
    {
        $kriteria = KriteriaDirektur::find($id_kriteria);
        $nama_kriteria = $request->input('nama_kriteria');
        $existingKriteria = KriteriaDirektur::where('nama_kriteria', $nama_kriteria)
            ->where('id', '<>', $id_kriteria)
            ->first();
        if ($existingKriteria) {
            alert()->toast('Nama kriteria sudah ada', 'error');
            return redirect()->back();
        }

        $total_bobot = KriteriaDirektur::where('id', '<>', $id_kriteria)->sum('bobot_kriteria') + $request->input('bobot');

        if ($total_bobot > 100) {
            alert()->toast('Total bobot kriteria melebihi 100', 'error');
            return redirect()->back();
        }

        $kriteria->update($request->all());
        alert()->toast('Data berhasil diperbaharui', 'success');
        return redirect()->back();
    }

    public function delete_kriteria_direktur(KriteriaDirektur $kriteria)
    {
        $kriteria->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }



    // rekankerja
    public function save_kriteria_rekan_kerja(Request $request)
    {
        $nama_kriteria = $request->input('nama_kriteria');
        $bobot_kriteria = $request->input('bobot');
        $existingKriteria = KriteriaRekanKerja::where('nama_kriteria', $nama_kriteria)->first();
        if ($existingKriteria) {
            alert()->toast('Nama kriteria sudah ada', 'error');
            return redirect()->back();
        }
        $total_bobot = KriteriaRekanKerja::sum('bobot_kriteria') + $bobot_kriteria;
        if ($total_bobot > 100) {
            alert()->toast('Total bobot kriteria melebihi 100', 'error');
            return redirect()->back();
        }
        $data = new KriteriaRekanKerja([
            'nama_kriteria' => $nama_kriteria,
            'bobot_kriteria' => $bobot_kriteria,
        ]);
        if ($data->save()) {
            alert()->toast('Data berhasil ditambahkan', 'success');
            return redirect()->back();
        }
    }

    public function update_kriteria_rekan_kerja(Request $request, $id_kriteria)
    {
        $kriteria = KriteriaRekanKerja::find($id_kriteria);
        $nama_kriteria = $request->input('nama_kriteria');
        $existingKriteria = KriteriaRekanKerja::where('nama_kriteria', $nama_kriteria)
            ->where('id', '<>', $id_kriteria)
            ->first();
        if ($existingKriteria) {
            alert()->toast('Nama kriteria sudah ada', 'error');
            return redirect()->back();
        }

        $total_bobot = KriteriaRekanKerja::where('id', '<>', $id_kriteria)->sum('bobot_kriteria') + $request->input('bobot');

        if ($total_bobot > 100) {
            alert()->toast('Total bobot kriteria melebihi 100', 'error');
            return redirect()->back();
        }

        $kriteria->update($request->all());
        alert()->toast('Data berhasil diperbaharui', 'success');
        return redirect()->back();
    }

    public function delete_kriteria_rekan_kerja(KriteriaRekanKerja $kriteria)
    {
        $kriteria->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
