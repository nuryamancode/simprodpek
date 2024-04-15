<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\MHr;
use App\Models\MKaryawan;
use App\Models\MPeriode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanKinerjaController extends Controller
{
    public function index(){
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $periode = MPeriode::where('status_periode', 'Sudah Dinilai')->get();
        $data = [
            'role' => $role,
            'hr' => $hr,
            'periode' => $periode,
        ];
        return view('hr.hr-laporan-kinerja', $data);
    }
}
