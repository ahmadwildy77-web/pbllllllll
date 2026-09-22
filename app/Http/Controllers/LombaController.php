<?php

namespace App\Http\Controllers;

use App\Models\Lomba;
use App\Models\AsesmenStatistik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LombaController extends Controller
{
    public function index()
    {
        $lombas = Lomba::all();
        return view('lomba.index', compact('lombas'));
    }

    public function show(Lomba $lomba)
    {
        $user = Auth::user();

        if ($user->role === 'mahasiswa') {
            $asesmen = AsesmenStatistik::where('lomba_id', $lomba->id)
                                        ->where('user_id', $user->id)
                                        ->first();
            return view('lomba.show_mahasiswa', compact('lomba', 'asesmen'));
        } 
        else {
            $asesmens = AsesmenStatistik::where('lomba_id', $lomba->id)->with('user')->get();
            return view('lomba.show_admin', compact('lomba', 'asesmens', 'user'));
        }
    }
}
