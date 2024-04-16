<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\KriteriaDirektur;
use App\Models\KriteriaRekanKerja;
use App\Models\MHr;
use App\Models\MKriteria;
use App\Models\MSubKriteria;
use App\Models\SubKriteriaDirektur;
use App\Models\SubKriteriaRekanKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $subkriteriadirektur = SubKriteriaDirektur::all();
        $subkriteriarekankerja = SubKriteriaRekanKerja::all();
        $uniquekriteriadirektur = $subkriteriadirektur->unique('kriteria_direktur.nama_kriteria');
        $uniquekriteriarekankerja = $subkriteriarekankerja->unique('kriteria_rekan_kerja.nama_kriteria');
        $kridirektur = KriteriaDirektur::all();
        $krirekankerja = KriteriaRekanKerja::all();
        $data = [
            'role' => $role,
            'hr' => $hr,
            'subkriteriadirektur' => $subkriteriadirektur,
            'subkriteriarekankerja' => $subkriteriarekankerja,
            'uniquekriteriadirektur' => $uniquekriteriadirektur,
            'uniquekriteriarekankerja' => $uniquekriteriarekankerja,
            'kridirektur' => $kridirektur,
            'krirekankerja' => $krirekankerja,
        ];
        return view('hr.hr-sub-kriteria', $data);
    }

    public function save_sub_direktur(Request $request)
    {
        $kriteria = KriteriaDirektur::find($request->input('kriteria_id'));
        $bobot_kriteria = $kriteria->bobot_kriteria;
        $bobot_subkriteria = $request->input('bobot_sub');

        if ($bobot_subkriteria > $bobot_kriteria) {
            alert()->toast('Total bobot subkriteria tidak boleh melebihi bobot kriteria.', 'error');
            return redirect()->back()->withInput();
        }
        SubKriteriaDirektur::create([
            'kriteria_id' => $request->input('kriteria_id'),
            'nama_subkriteria' => $request->input('nama_sub'),
            'pertanyaan' => $request->input('pertanyaan'),
            'bobot_sub' => $bobot_subkriteria,
        ]);
        alert()->toast('Data berhasil ditambahkan', 'success');
        return redirect()->back();
    }

    public function update_sub_direktur(Request $request, $id_subkriteria)
    {
        $kriteriaid = $request->input('kriteria_id');
        $kriteria = KriteriaDirektur::find($kriteriaid);
        $bobot_kriteria = $kriteria->bobot_kriteria;
        $bobot_sub = $request->input('bobot_sub');
        if ($bobot_sub > $bobot_kriteria) {
            alert()->toast('Total bobot subkriteria tidak boleh melebihi bobot kriteria.', 'error');
            return redirect()->back()->withInput();
        }
        $sub = SubKriteriaDirektur::find($id_subkriteria);
        if (!$sub) {
            alert()->toast('Sub kriteria tidak ditemukan', 'error');
            return redirect()->back();
        }
        $sub->update([
            'nama_subkriteria' => $request->input('nama_sub'),
            'pertanyaan' => $request->input('pertanyaan'),
            'kriteria_id' => $kriteriaid,
            'bobot_sub' => $bobot_sub,
        ]);
        alert()->toast('Data berhasil diperbaharui', 'success');
        return redirect()->back();
    }


    public function delete_sub_direktur(SubKriteriaDirektur $subKriteria)
    {
        $subKriteria->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }




    public function save_sub_rekan_kerja(Request $request)
    {
        $kriteriaid = $request->input('kriteria_id');
        $kriteria = KriteriaRekanKerja::find($kriteriaid);
        $bobot_kriteria = $kriteria->bobot_kriteria;
        $bobot_sub = $request->input('bobot_sub');
        if ($bobot_sub > $bobot_kriteria) {
            alert()->toast('Total bobot subkriteria tidak boleh melebihi bobot kriteria.', 'error');
            return redirect()->back();
        }
        SubKriteriaRekanKerja::create([
            'kriteria_id' => $kriteriaid,
            'nama_subkriteria' => $request->input('nama_sub'),
            'pertanyaan' => $request->input('pertanyaan'),
            'bobot_sub'=> $bobot_sub,
        ]);
        alert()->toast('Data berhasil ditambahkan', 'success');
        return redirect()->back();
    }


    public function update_sub_rekan_kerja(Request $request, $id_subkriteria)
    {
        $kriteriaid = $request->input('kriteria_id');
        $kriteria = KriteriaRekanKerja::find($kriteriaid);
        $bobot_kriteria = $kriteria->bobot_kriteria;
        $bobot_sub = $request->input('bobot_sub');
        if ($bobot_sub > $bobot_kriteria) {
            alert()->toast('Total bobot subkriteria tidak boleh melebihi bobot kriteria.', 'error');
            return redirect()->back();
        }
        $sub = SubKriteriaRekanKerja::find($id_subkriteria);
        if (!$sub) {
            alert()->toast('Sub kriteria tidak ditemukan', 'error');
            return redirect()->back();
        }
        $sub->update([
            'nama_subkriteria' => $request->input('nama_sub'),
            'pertanyaan' => $request->input('pertanyaan'),
            'kriteria_id' => $kriteriaid,
            'bobot_sub' => $bobot_sub,
        ]);
        alert()->toast('Data berhasil diperbaharui', 'success');
        return redirect()->back();
    }


    public function delete_sub_rekan_kerja(SubKriteriaRekanKerja $subKriteria)
    {
        $subKriteria->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
