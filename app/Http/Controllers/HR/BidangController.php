<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\MBidang;
use App\Models\MHr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidangController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $hr = MHr::where('user_id', $user_id)->first();
        $role = Auth::user()->role;
        $bidang = MBidang::all();
        $data = [

            'role' => $role,
            'hr' => $hr,
            'bidang' => $bidang,
        ];
        return view('hr.hr-bidang', $data);
    }

    public function save(Request $request)
    {
        $request->validate([
            'nama_bidang'=>'required'
        ],[
            'nama_bidang.required'=>'Nama tidak boleh kosong'
        ]);

        $bidang = $request->input('nama_bidang');
        $data = MBidang::create([
            'nama_bidang'=>$bidang
        ]);
        $data->save();
        alert()->toast('Data berhasil ditambahkan', 'success');
        return redirect()->back();
    }
    public function update(Request $request, $id_bidang)
    {
        $request->validate([
            'nama_bidang'=>'required'
        ],[
            'nama_bidang.required'=>'Nama tidak boleh kosong'
        ]);

        $bidang = MBidang::find($id_bidang);
        $bidang->update(['nama_bidang'=> $request->input('nama_bidang')]);
        alert()->toast('Data berhasil diperbaharui', 'success');
        return redirect()->back();
    }

    public function delete(MBidang $bidang)
    {
        $bidang->delete();
        alert()->toast('Data berhasil dihapus', 'success');
        return redirect()->back();
    }
}
