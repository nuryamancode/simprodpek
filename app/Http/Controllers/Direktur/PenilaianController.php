<?php

namespace App\Http\Controllers\Direktur;

use App\Http\Controllers\Controller;
use App\Models\MDirektur;
use App\Models\MKaryawan;
use App\Models\MNotifikasi;
use App\Models\Penilaian\HasilPenilaianDirektur;
use App\Models\Penilaian\HasilPenilaianSemua;
use App\Models\Penilaian\JenisPenilaian;
use App\Models\Penilaian\KriteriaDirektur;
use App\Models\Penilaian\Penilai;
use App\Models\Penilaian\PenilaianDua;
use App\Models\Penilaian\Penilaiankaryawan;
use App\Models\Penilaian\SubKriteriaDirektur;
use App\Models\Penilaian\TotalAkhir;
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
        $penilaian = Penilai::where('jenis_dinilai', 'Direktur To Karyawan')->get();
        $karyawan = MKaryawan::all();

        $data = [
            'role' => $role,
            'direktur' => $direktur,
            'karyawan' => $karyawan,
            'penilaian' => $penilaian,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('direkturs.direktur-kelola-penilaian', $data);
    }

    public function save_penilaiankaryawan(Request $request)
    {
        $karyawan_id = $request->input('karyawan_id');
        $penilai = $request->input('periode_id');
        $periode = Penilai::find($penilai);
        $periode_id = $periode->periode_id;
        $data = Penilaiankaryawan::create([
            'karyawan_id' => $karyawan_id,
            'periode_id' => $periode_id
        ]);
        $penilaian_id = $data->id;
        $data->save();
        return redirect()->route('direktur.penilaian', $penilaian_id);
    }


    public function penilaian($penilaian_id)
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
            'penilaian_id' => $penilaian_id
        ];
        return view('direkturs.direktur-penilaian', $data);
    }

    public function hasil_penilaian(Request $request)
    {
        $request->validate([
            'nilai.*' => 'required|numeric|between:1,5',
        ]);

        $nilai = $request->input('nilai');
        $penilaian_id = $request->input('penilaian_id');
        $penilaianSatu = Penilaiankaryawan::findOrFail($penilaian_id);
        $periodeId = $penilaianSatu->periode_id;
        $karyawan = $penilaianSatu->karyawan_id;

        $totalkriteria = [];

        if (!empty($nilai)) {
            foreach ($nilai as $idSubKriteria => $nilaiSubKriteria) {
                $subKriteria = SubKriteriaDirektur::findOrFail($idSubKriteria);
                if (!isset($totalkriteria[$subKriteria->kriteria_id])) {
                    $totalkriteria[$subKriteria->kriteria_id] = 0;
                }
                $totalkriteria[$subKriteria->kriteria_id] += $nilaiSubKriteria;

                PenilaianDua::create([
                    'penilaiankaryawan_id' => $penilaian_id,
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
                $jenispenilai = JenisPenilaian::where('nama_penilai', 'Direktur')->first();
                $jumlahSubKriteria = $jumlahpertanyaan[$kriteriaId];
                $nilaiRataRata = $totalNilai / $jumlahSubKriteria; // hitung per kriteria
                $totalkali = $nilaiRataRata * $kriteria->bobot_kriteria / 100; // total hasil dibagi dikalikan
                $total = $totalNilaiAkhir += $totalkali; // hitung jumlah total nilai semua kriteria
                $totalakhir = $total * $jenispenilai->nilai_bobot / 100; // total akhir penilaian direktur
            }
            $nilaiTotal = HasilPenilaianDirektur::where('karyawan_id', $karyawan)->where('periode_id',$periodeId)->first();
            if ($nilaiTotal) {
                $nilaiTotal->update([
                    'total_akhir'=> $totalakhir,
                ]);
            }else{
                HasilPenilaianDirektur::create([
                    'penilaian_id' => $penilaian_id,
                    'periode_id' => $periodeId,
                    'total_akhir' => $totalakhir,
                    'karyawan_id' => $karyawan,
                ]);
            }
            $penilaiankaryawan = Penilaiankaryawan::find($penilaian_id);
            $penilaiankaryawan->status_penilaian = 'Sudah Dinilai';
            $penilaiankaryawan->save();
            $this->Setnilaiakhir($penilaian_id);
            alert()->toast('Berhasil dinilai', 'success');
            return redirect()->route('direktur.kelola.penilaian');
        } else {
            alert()->toast('Rating tidak boleh kosong', 'error');
            return redirect()->back();
        }
    }

    private function Setnilaiakhir($penilaian_id)
    {
        $penilaian = Penilaiankaryawan::find($penilaian_id);
        $karyawanId = $penilaian->karyawan_id;
        $periodeId = $penilaian->periode_id;
        $hasilrekan = HasilPenilaianSemua::where('karyawan_id', $karyawanId)->where('periode_id', $periodeId)->first();
        $hasildirektur = HasilPenilaianDirektur::where('karyawan_id', $karyawanId)->where('periode_id', $periodeId)->first();
        $hasildirekturnull = TotalAkhir::whereNotNull('hasildirektur_id')->where('karyawan_id', $karyawanId)->where('periode_id', $periodeId)->first();
        $hasilrekannull = TotalAkhir::whereNotNull('hasilrekankerja_id')->where('karyawan_id', $karyawanId)->where('periode_id', $periodeId)->first();

        if ($hasilrekannull) {
            $totalnilairekan = $hasilrekan->total_akhir_semua;
            $totalnilaidirektur = $hasildirektur->total_akhir;
            $hasilTotal = $totalnilairekan + $totalnilaidirektur;

            $totalAkhir = TotalAkhir::where('karyawan_id', $karyawanId)->where('periode_id', $periodeId)->first();
            if ($totalAkhir) {
                $totalAkhir->update([
                    'hasildirektur_id' => $hasildirektur->id,
                    'total_akhir' => $hasilTotal,
                ]);
            }
        } else {
            TotalAkhir::create([
                'karyawan_id' => $karyawanId,
                'hasildirektur_id' => $hasildirektur->id,
                'periode_id' => $hasildirektur->periode_id,
                'total_akhir' => $hasildirektur->total_akhir,
            ]);
        }
    }

    public function laporan(Request $request)
    {
        $user_id = auth()->id();
        $direktur = MDirektur::where('user_id', $user_id)->first();
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $role = auth()->user()->role;
        $periode_pilih = $request->input('filter');
        if ($periode_pilih) {
            $totalakhir = TotalAkhir::whereNotNull('hasildirektur_id')
                ->whereNotNull('hasilrekankerja_id')
                ->whereHas('periode', function ($query) use ($periode_pilih) {
                    $query->where('periode', $periode_pilih);
                })
                ->get();
        } else {
            $totalakhir = TotalAkhir::whereNotNull('hasildirektur_id')
                ->whereNotNull('hasilrekankerja_id')
                ->get();
        }
        $data = [
            'direktur' => $direktur,
            'role' => $role,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah,
            'totalakhir' => $totalakhir,
            'periode_pilih' => $periode_pilih,
        ];
        return view('direkturs.direktur-laporan-hasil', $data);
    }
}
