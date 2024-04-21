<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\MHr;
use App\Models\Penilaian\TotalAkhir;
use Illuminate\Http\Request;

class KelolaHasilController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
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
            'hr' => $hr,
            'role' => $role,
            'totalakhir' => $totalakhir,
            'periode_pilih' => $periode_pilih,
        ];
        return view('hr.hr-kelola-hasil', $data);
    }
}
