<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InitialAssessmentController extends Controller
{
    public function create()
    {
        return view('asesmen_awal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'skor_matkul' => 'required|numeric|min:0|max:100',
            'skor_minat_bakat' => 'required|numeric|min:0|max:100',
        ]);

        $user = Auth::user();
        $user->skor_matkul = $request->skor_matkul;
        $user->skor_minat_bakat = $request->skor_minat_bakat;
        $user->is_assessed = true;
        $user->save();

        // Otomatis masukkan mahasiswa ke semua lomba sebagai 'pending' agar Koor bisa memilah
        $lombas = \App\Models\Lomba::all();
        foreach ($lombas as $lomba) {
            \App\Models\AsesmenStatistik::firstOrCreate([
                'user_id' => $user->id,
                'lomba_id' => $lomba->id,
            ], [
                'status_keputusan' => 'pending'
            ]);
        }

        return redirect()->route('lomba.index')->with('success', 'Nilai asesmen berhasil diperbarui!');
    }
}
