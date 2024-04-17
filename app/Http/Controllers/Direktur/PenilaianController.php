<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\MDirektur;
use App\Models\MKaryawan;
use App\Models\MNotifikasi;
use App\Models\MSubKriteria;
use App\Models\Penilaian\HasilPenilaianDirektur;
use App\Models\Penilaian\JenisPenilaian;
use App\Models\Penilaian\KriteriaDirektur;
use App\Models\Penilaian\Penilai;
use App\Models\Penilaian\PenilaianDua;
use App\Models\Penilaian\PenilaianSatu;
use App\Models\Penilaian\SubKriteriaDirektur;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class PenilaianController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $pilihperiode = $request->input('pilihperiode');
        $periode = Penilai::whereNotNull('periode')->get();
        if ($pilihperiode) {
            $penilaian = Penilai::where('status_penilaian', 'Belum Dinilai')->where('periode', $pilihperiode)->get();
            $karyawan = MKaryawan::all();
        }else {
            $penilaian = null;
            $karyawan = null;
        }

        $data = [
            'role' => $role,
            'periode' => $periode,
            'direktur' => $direktur,
            'karyawan' => $karyawan,
            'penilaian' => $penilaian,
            'notifikasi' => $notifikasi,
            'pilihperiode' => $pilihperiode,
            'jumlah' => $jumlah
        ];
        return view('direkturs.direktur-kelola-penilaian', $data);
    }

    public function save_penilaian_tahap_satu(Request $request){
        $karyawan_id = $request->input('karyawan_id');
        $penilai_id = $request->input('penilai_id');
        $data = PenilaianSatu::create([
            'karyawan_id'=> $karyawan_id,
            'penilai_id'=> $penilai_id
        ]);
        $penilaiansatu_id = $data->id;
        $data->save();
        return redirect()->route('direktur.penilaian', $penilaiansatu_id);
    }


    public function penilaian($penilaiansatu_id)
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $sub = SubKriteriaDirektur::all();
        $subkriteria = SubKriteriaDirektur::where('nama_subkriteria')->get();
        $data = [

            'role' => $role,
            'direktur' => $direktur,
            'sub' => $sub,
            'subkriteria' => $subkriteria,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah,
            'penilaiansatu_id' => $penilaiansatu_id
        ];
        return view('direkturs.direktur-penilaian', $data);
    }

    public function hasil_penilaian(Request $request)
    {
        $request->validate([
            'nilai.*' => 'required|numeric|between:1,5',
        ]);

        $nilai = $request->input('nilai');
        $tahap_satu_id = $request->input('tahap_satu_id');
        $totalkriteria = [];

        if (!empty($nilai)) {
            foreach ($nilai as $idSubKriteria => $nilaiSubKriteria) {
                $subKriteria = SubKriteriaDirektur::findOrFail($idSubKriteria);
                if (!isset($totalkriteria[$subKriteria->kriteria_id])) {
                    $totalkriteria[$subKriteria->kriteria_id] = 0;
                }
                $totalkriteria[$subKriteria->kriteria_id] += $nilaiSubKriteria;

                PenilaianDua::create([
                    'tahap_satu_id' => $tahap_satu_id,
                    // 'subkriteria_id' => $idSubKriteria,
                    // 'kriteria_id' => $subKriteria->kriteria_id,
                    'rating' => $nilaiSubKriteria,
                ]);
            }
            $jumlahpertanyaan = [];
            foreach ($totalkriteria as $kriteriaId => $totalNilai) {
                $jumlahpertanyaan[$kriteriaId] = SubKriteriaDirektur::where('kriteria_id', $kriteriaId)->count();
            }

            $jumlahKriteria = KriteriaDirektur::count();
            $totalNilaiAkhir = 0;
            foreach ($totalkriteria as $kriteriaId => $totalNilai) {
                $kriteria = KriteriaDirektur::findOrFail($kriteriaId);
                $jenispenilai = JenisPenilaian::where('nama_penilai' , 'Direktur')->first();
                $jumlahSubKriteria = $jumlahpertanyaan[$kriteriaId];
                $nilaiRataRata = $totalNilai / $jumlahSubKriteria; // hitung per kriteria
                $totalkali = $nilaiRataRata * $kriteria->bobot_kriteria / 100; // total hasil dibagi dikalikan
                $total = $totalNilaiAkhir += $totalkali;// hitung jumlah total nilai semua kriteria
                $totalakhir = $total * $jenispenilai->nilai_bobot / 100; // total akhir penilaian direktur
            }
            HasilPenilaianDirektur::create([
                'tahap_satu_id' => $tahap_satu_id,
                'total_akhir' => $totalakhir,
            ]);
            $penilaiansatu = PenilaianSatu::find($tahap_satu_id);
            $penilaiansatu->status_penilaian = 'Sudah Dinilai';
            $penilaiansatu->save();
            alert()->toast('Berhasil dinilai', 'success');
            return redirect()->route('direktur.kelola.penilaian');
        } else {
            alert()->toast('Rating tidak boleh kosong', 'error');
            return redirect()->back();
        }
    }
}
