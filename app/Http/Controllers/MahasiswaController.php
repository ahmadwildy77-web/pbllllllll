<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\User::where('role', 'mahasiswa');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nim_nip', 'like', "%{$search}%");
            });
        }

        if ($request->filled('semester') && $request->semester !== 'all') {
            $query->where('semester_aktif', $request->semester);
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status_akun', $request->status);
        }

        $mahasiswas = $query->paginate(12)->withQueryString();
        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }
}
