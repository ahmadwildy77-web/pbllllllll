<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InitialAssessmentController extends Controller
{
    public function create()
    {
        // Jika sudah asesmen, kembalikan ke dashboard
        if (Auth::user()->is_assessed) {
            return redirect()->route('dashboard');
        }
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

        return redirect()->route('dashboard')->with('success', 'Asesmen awal berhasil diselesaikan!');
    }
}
