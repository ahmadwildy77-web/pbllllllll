<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AsesmenStatistik;
use Illuminate\Support\Facades\Auth;

class KaprodiController extends Controller
{
    public function index()
    {
        $asesmens = AsesmenStatistik::with(['user', 'lomba'])
                            ->where('status_keputusan', 'terpilih')
                            ->orderBy('updated_at', 'desc')
                            ->get();

        return view('kaprodi.validasi', compact('asesmens'));
    }

    public function validateRekomendasi(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:approve,reject'
        ]);

        $asesmen = AsesmenStatistik::findOrFail($id);
        
        if ($request->action === 'approve') {
            $asesmen->status_keputusan = 'divalidasi';
        } else {
            $asesmen->status_keputusan = 'ditolak';
        }
        
        $asesmen->save();

        return back()->with('success', 'Rekomendasi berhasil divalidasi!');
    }
}
