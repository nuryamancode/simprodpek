<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\MDirektur;
use App\Models\MHasilPenilaian;
use App\Models\MHasilPenilaianKriteria;
use App\Models\MKaryawan;
use App\Models\MKriteria;
use App\Models\MNotifikasi;
use App\Models\MPenilaian;
use App\Models\MPeriode;
use App\Models\MSubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    


    public function penilaian($periode_id)
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $sub = MSubKriteria::all();
        $subkriteria = MSubKriteria::where('nama_subkriteria')->get();
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'sub' => $sub,
            'subkriteria' => $subkriteria,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah,
            'periode_id' => $periode_id
        ];
        return view('direkturs.direktur-penilaian', $data);
    }

    public function hasil_penilaian(Request $request)
    {
        $request->validate([
            'nilai.*' => 'required|numeric|between:1,5',
        ]);

        $nilai = $request->input('nilai');
        $periode_id = $request->input('periode_id');
        $totalkriteria = [];

        if (!empty($nilai)) {
            foreach ($nilai as $idSubKriteria => $nilaiSubKriteria) {
                $subKriteria = MSubKriteria::findOrFail($idSubKriteria);
                if (!isset($totalkriteria[$subKriteria->kriteria_id])) {
                    $totalkriteria[$subKriteria->kriteria_id] = 0;
                }
                $totalkriteria[$subKriteria->kriteria_id] += $nilaiSubKriteria;

                MPenilaian::create([
                    'periode_id' => $periode_id,
                    'subkriteria_id' => $idSubKriteria,
                    'kriteria_id' => $subKriteria->kriteria_id,
                    'rating' => $nilaiSubKriteria,
                ]);
            }
            $jumlahpertanyaan = [];
            foreach ($totalkriteria as $kriteriaId => $totalNilai) {
                $jumlahpertanyaan[$kriteriaId] = MSubKriteria::where('kriteria_id', $kriteriaId)->count();
            }

            $jumlahKriteria = MKriteria::count();
            $totalNilaiAkhir = 0;
            foreach ($totalkriteria as $kriteriaId => $totalNilai) {
                $jumlahSubKriteria = $jumlahpertanyaan[$kriteriaId];
                $nilaiRataRata = $totalNilai / $jumlahSubKriteria; // hitung per kriteria
                $total = $totalNilaiAkhir += $nilaiRataRata; // hitung jumlah per kriteria
                $totalakhir = $total / $jumlahKriteria; // total kriteria
                MHasilPenilaianKriteria::create([
                    'periode_id' => $periode_id,
                    'kriteria_id' => $kriteriaId,
                    'total_nilai_perkriteria' => $nilaiRataRata,
                ]);
            }
            MHasilPenilaian::create([
                'periode_id' => $periode_id,
                'total_nilai_akhir' => $totalakhir,
            ]);
            $periode = MPeriode::find($periode_id);
            $periode->status_periode = 'Sudah Dinilai';
            $periode->save();
            alert()->toast('Berhasil dinilai', 'success');
            return redirect()->route('direktur.kelola.penilaian');
        } else {
            alert()->toast('Rating tidak boleh kosong', 'error');
            return redirect()->back();
        }
    }
}
