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
        $user = Auth::user();

        if ($user && $user->role !== 'mahasiswa') {
            return view('admin.lomba.index', compact('lombas'));
        }

        return view('lomba.index', compact('lombas'));
    }

    public function show(Lomba $lomba)
    {
        $user = Auth::user();

        if ($user->role === 'mahasiswa') {
            $asesmen = AsesmenStatistik::where('lomba_id', $lomba->id)
                                        ->where('user_id', $user->id)
                                        ->first();
            
            // Hitung nilai matkul spesifik
            $related_matkul = json_decode($lomba->related_matkul, true) ?? [];
            $skor_matkul_spesifik = 0;
            
            if (count($related_matkul) > 0) {
                $nilai_akademik = \Illuminate\Support\Facades\DB::table('nilai_akademik')
                    ->where('nim', $user->nim_nip)
                    ->first();
                    
                if ($nilai_akademik) {
                    $total = 0;
                    foreach ($related_matkul as $matkul) {
                        $total += $nilai_akademik->$matkul ?? 0;
                    }
                    $skor_matkul_spesifik = round($total / count($related_matkul));
                }
            } else {
                $skor_matkul_spesifik = $user->skor_matkul;
            }

            return view('lomba.show_mahasiswa', compact('lomba', 'asesmen', 'skor_matkul_spesifik'));
        } 
        else {
            $asesmens = AsesmenStatistik::where('lomba_id', $lomba->id)->with('user')->get();
            return view('lomba.show_admin', compact('lomba', 'asesmens', 'user'));
        }
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->role !== 'koordinator') {
            return redirect()->route('lomba.index')->with('error', 'Akses ditolak.');
        }

        return view('lomba.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'koordinator') {
            return redirect()->route('lomba.index')->with('error', 'Akses ditolak.');
        }

        $validated = $request->validate([
            'nama_lomba' => 'required|string|max:255',
            'tingkat' => 'nullable|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'deadline' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'url' => 'nullable|url|max:255',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('lombas', 'public');
            $validated['cover_image'] = $path;
        }

        Lomba::create($validated);

        return redirect()->route('lomba.index')->with('success', 'Lomba berhasil ditambahkan.');
    }
    public function destroy(Lomba $lomba)
    {
        $user = Auth::user();
        if ($user->role !== 'koordinator') {
            return redirect()->route('lomba.index')->with('error', 'Akses ditolak.');
        }

        // Jika ada cover image, mungkin mau dihapus file-nya juga:
        if ($lomba->cover_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($lomba->cover_image);
        }

        $lomba->delete();

        return redirect()->route('lomba.index')->with('success', 'Lomba berhasil dihapus.');
    }
}
