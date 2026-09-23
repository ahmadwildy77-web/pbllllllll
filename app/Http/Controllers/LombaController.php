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
            return view('lomba.show_mahasiswa', compact('lomba', 'asesmen'));
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
}
