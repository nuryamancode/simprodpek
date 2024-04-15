<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\MHr;
use App\Models\MKriteria;
use App\Models\MSubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubKriteriaController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $sub = MSubKriteria::all();
        $uniqueKriterias = $sub->unique('kriteria.nama_kriteria');
        $kri = MKriteria::all();
        $data = [
            'role' => $role,
            'hr' => $hr,
            'sub' => $sub,
            'uniqueKriterias' => $uniqueKriterias,
            'kri' => $kri,
        ];
        return view('hr.hr-sub-kriteria', $data);
    }

    public function save(Request $request)
    {
        $kriteriaid = $request->input('kriteria_id');
        MSubKriteria::create([
            'kriteria_id' => $kriteriaid,
            'nama_subkriteria' => $request->input('nama_sub'),
            'pertanyaan' => $request->input('pertanyaan'),
        ]);
        alert()->toast('Data berhasil ditambahkan', 'success');
        return redirect()->back();
    }


    public function update(Request $request, $id_subkriteria)
    {
        $kriteriaid = $request->input('kriteria_id');
        $sub = MSubKriteria::find($id_subkriteria);
        if (!$sub) {
            alert()->toast('Sub kriteria tidak ditemukan', 'error');
            return redirect()->back();
        }
        $sub->update([
            'nama_subkriteria' => $request->input('nama_sub'),
            'pertanyaan' => $request->input('pertanyaan'),
            'kriteria_id' => $kriteriaid,
        ]);
        alert()->toast('Data berhasil diperbaharui', 'success');
        return redirect()->back();
    }


    public function delete(MSubKriteria $subKriteria)
    {
        $subKriteria->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
