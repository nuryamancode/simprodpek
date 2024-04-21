<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\MKaryawan;
use App\Models\MNotifikasi;
use App\Models\MTim;
use App\Models\Penilaian\HasilPenilaianDirektur;
use App\Models\Penilaian\HasilPenilaianRekanKerja;
use App\Models\Penilaian\HasilPenilaianSemua;
use App\Models\Penilaian\JenisPenilaian;
use App\Models\Penilaian\KriteriaRekanKerja;
use App\Models\Penilaian\Penilai;
use App\Models\Penilaian\PenilaianDua;
use App\Models\Penilaian\PenilaianRekanKerja;
use App\Models\Penilaian\SubKriteriaRekanKerja;
use App\Models\Penilaian\TotalAkhir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenilaianRekanKerjaController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $penilai = Penilai::where('jenis_dinilai', 'Karyawan To Rekan Kerja')->get();
        $tim = [];
        if ($karyawan) {
            $karyawan_id = $karyawan->id;
            $tim = MTim::whereHas('karyawan', function ($query) use ($karyawan_id) {
                $query->where('m_karyawan_id', $karyawan_id);
            })->with(['karyawan' => function ($query) use ($karyawan_id) {
                $query->where('m_karyawan_id', '!=', $karyawan_id);
            }])->get();
        }
        $data = [
            'role' => $role,
            'karyawan' => $karyawan,
            'penilai' => $penilai,
            'tim' => $tim,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('karyawans.karyawan-penilaian-rekankerja', $data);
    }
    public function save_penilaianrekan(Request $request)
    {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $karyawan_id = $request->input('karyawan_id');
        $penilai = $request->input('periode_id');
        $periode = Penilai::find($penilai);
        $periode_id = $periode->periode_id;
        $data = PenilaianRekanKerja::create([
            'karyawan_id' => $karyawan_id,
            'karyawan_menilai_id' => $karyawan->id,
            'periode_id' => $periode_id
        ]);
        $penilaian_id = $data->id;
        $data->save();
        return redirect()->route('karyawan.penilaian', $penilaian_id);
    }
    public function penilaian($penilaian_id)
    {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $sub = SubKriteriaRekanKerja::all();
        $subkriteria = SubKriteriaRekanKerja::where('nama_subkriteria')->get();
        $data = [

            'role' => $role,
            'karyawan' => $karyawan,
            'sub' => $sub,
            'subkriteria' => $subkriteria,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah,
            'penilaian_id' => $penilaian_id
        ];
        return view('karyawans.karyawan-penilaian', $data);
    }

    public function hasil_penilaian(Request $request)
    {
        $request->validate([
            'nilai.*' => 'required|numeric|between:1,5',
        ]);

        $nilai = $request->input('nilai');
        $penilaian_id = $request->input('penilaian_id');
        $penilaiansatuId = PenilaianRekanKerja::find($penilaian_id);
        $karyawan = $penilaiansatuId->karyawan_id;
        $totalkriteria = [];

        if (!empty($nilai)) {
            foreach ($nilai as $idSubKriteria => $nilaiSubKriteria) {
                $subKriteria = SubKriteriaRekanKerja::findOrFail($idSubKriteria);
                if (!isset($totalkriteria[$subKriteria->kriteria_id])) {
                    $totalkriteria[$subKriteria->kriteria_id] = 0;
                }
                $totalkriteria[$subKriteria->kriteria_id] += $nilaiSubKriteria;

                PenilaianDua::create([
                    'penilaianrekan_id' => $penilaian_id,
                    'rating' => $nilaiSubKriteria,
                ]);
            }
            $jumlahpertanyaan = [];
            foreach ($totalkriteria as $kriteriaId => $totalNilai) {
                $jumlahpertanyaan[$kriteriaId] = SubKriteriaRekanKerja::where('kriteria_id', $kriteriaId)->count();
            }

            $jumlahKriteria = KriteriaRekanKerja::count();
            $totalNilaiAkhir = 0;
            foreach ($totalkriteria as $kriteriaId => $totalNilai) {
                $kriteria = KriteriaRekanKerja::findOrFail($kriteriaId);
                $jenispenilai = JenisPenilaian::where('nama_penilai', 'Rekan Kerja')->first();
                $jumlahSubKriteria = $jumlahpertanyaan[$kriteriaId];
                $nilaiRataRata = $totalNilai / $jumlahSubKriteria; // hitung per kriteria
                $totalkali = $nilaiRataRata * $kriteria->bobot_kriteria / 100; // total hasil dibagi dikalikan
                $total = $totalNilaiAkhir += $totalkali; // hitung jumlah total nilai semua kriteria
                // $totalakhir = $total * $jenispenilai->nilai_bobot / 100; // total akhir penilaian direktur
            }
            HasilPenilaianRekanKerja::create([
                'penilaian_id' => $penilaian_id,
                'karyawan_id' => $karyawan,
                'total_akhir' => $total,
            ]);
            $penilaianrekan = PenilaianRekanKerja::find($penilaian_id);
            $penilaianrekan->status_penilaian = 'Sudah Dinilai';
            $penilaianrekan->save();
            $this->updateTotalAkhir($penilaian_id);
            alert()->toast('Berhasil dinilai', 'success');
            return redirect()->route('karyawan.penilaian.rekankerja');
        } else {
            alert()->toast('Rating tidak boleh kosong', 'error');
            return redirect()->back();
        }
    }


    private function updateTotalAkhir($penilaian_id)
    {

        $penilaianSatu = PenilaianRekanKerja::findOrFail($penilaian_id);
        $periodeId = $penilaianSatu->periode_id;
        $karyawan = $penilaianSatu->karyawan_id;

        $jumlahKaryawanBelumDinilai = PenilaianRekanKerja::where('status_penilaian', 'Belum Dinilai')
            ->where('periode_id', $periodeId)
            ->count();
        $jenispenilai = JenisPenilaian::where('nama_penilai', 'Rekan Kerja')->first();

        if ($jumlahKaryawanBelumDinilai === 0) {
            $jumlahkaryawan = PenilaianRekanKerja::where('status_penilaian', 'Sudah Dinilai')
                ->where('periode_id', $periodeId)
                ->count();
            $totalNilaiAkhir = HasilPenilaianRekanKerja::where('karyawan_id', $karyawan)->sum('total_akhir');
            $totalsemua = $totalNilaiAkhir / $jumlahkaryawan;
            $totaldiambil = $totalsemua * $jenispenilai->nilai_bobot / 100;
            $totalNilaiAkhirSemua = HasilPenilaianSemua::where('karyawan_id', $karyawan)->where('periode_id', $periodeId)->first();
            if ($totalNilaiAkhirSemua) {
                $totalNilaiAkhirSemua->update(['total_akhir_semua' => $totaldiambil]);
                $this->Setnilaiakhir($penilaian_id);
            } else {
                $data = HasilPenilaianSemua::create([
                    'periode_id' => $periodeId,
                    'karyawan_id' => $karyawan,
                    'total_akhir_semua' => $totaldiambil,
                ]);
                $data->save();
                $this->Setnilaiakhir($penilaian_id);
            }
        }
    }

    private function Setnilaiakhir($penilaian_id)
    {
        $penilaian = PenilaianRekanKerja::find($penilaian_id);
        $karyawanId = $penilaian->karyawan_id;
        $periodeId = $penilaian->periode_id;
        $hasilrekan = HasilPenilaianSemua::where('karyawan_id', $karyawanId)->where('periode_id', $periodeId)->first();
        $hasildirektur = HasilPenilaianDirektur::where('karyawan_id', $karyawanId)->where('periode_id', $periodeId)->first();
        $hasildirekturnull = TotalAkhir::whereNotNull('hasildirektur_id')->where('karyawan_id', $karyawanId)->where('periode_id', $periodeId)->first();
        $hasilrekannull = TotalAkhir::whereNotNull('hasilrekankerja_id')->where('karyawan_id', $karyawanId)->where('periode_id', $periodeId)->first();

        if ($hasildirekturnull || $hasilrekannull) {
            $totalAkhir = TotalAkhir::where('karyawan_id', $karyawanId)->where('periode_id', $periodeId)->first();
            if ($totalAkhir->hasildirektur_id == null) {
                $totalAkhir->update([
                    'total_akhir' => $hasilrekan->total_akhir_semua,
                ]);
            } else {
                $totalnilairekan = $hasilrekan->total_akhir_semua;
                $totalnilaidirektur = $hasildirektur->total_akhir;
                $hasilTotal = $totalnilairekan + $totalnilaidirektur;
                $totalAkhir->update([
                    'total_akhir' => $hasilTotal,
                    'hasilrekankerja_id' => $hasilrekan->id,
                ]);
            }
        } else {
            TotalAkhir::create([
                'karyawan_id' => $karyawanId,
                'hasilrekankerja_id' => $hasilrekan->id,
                'periode_id' => $hasilrekan->periode_id,
                'total_akhir' => $hasilrekan->total_akhir_semua,
            ]);
        }
    }

    public function laporan()
    {
        $user_id = auth()->id();
        $karyawan = MKaryawan::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $notifikasi = MNotifikasi::where('user_id', $user_id)->latest()->take(5)->get();
        $jumlahnotif = MNotifikasi::where('user_id', $user_id)->where('dibaca', false)->get();
        $jumlah = $jumlahnotif->count();
        $totalakhir = TotalAkhir::whereNotNull('hasildirektur_id')
            ->whereNotNull('hasilrekankerja_id')->where('karyawan_id', $karyawan->id)
            ->get();
        $data = [
            'role' => $role,
            'karyawan' => $karyawan,
            'totalakhir' => $totalakhir,
            'notifikasi' => $notifikasi,
            'jumlah' => $jumlah
        ];
        return view('karyawans.karyawan-laporan-nilai', $data);
    }
}
