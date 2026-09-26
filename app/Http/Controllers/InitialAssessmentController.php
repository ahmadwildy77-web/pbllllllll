<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InitialAssessmentController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $nilai_akademik = \Illuminate\Support\Facades\DB::table('nilai_akademik')->where('nim', $user->nim_nip)->first();
        $asesmen_non_akademik = \Illuminate\Support\Facades\DB::table('asesmen_non_akademik')->where('nim', $user->nim_nip)->first();
        return view('asesmen_awal.create', compact('nilai_akademik', 'asesmen_non_akademik'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $semester = $user->semester_aktif ?? 1;

        $matkul_semesters = [
            1 => ['alpro', 'sim', 'smbd', 'desain_uiux', 'desain_grafis', 'binggris'],
            2 => ['ppl', 'arsikom', 'pemweb', 'struktur_data'],
            3 => ['pemweb_lanjut', 'elektronika_dasar_dan_sensoring', 'insis', 'komdatjar'],
            4 => ['aplikasi_mobile', 'manajemen_proyek', 'teknologi_dan_keamanan_platform', 'iot', 'data_mining', 'kriptografi', 'sistem_terdistribusi', 'kecerdasan_buatan']
        ];

        $matkul_fields = [];
        $max_semester = min(max(0, $semester - 1), 4);
        for ($i = 1; $i <= $max_semester; $i++) {
            $matkul_fields = array_merge($matkul_fields, $matkul_semesters[$i]);
        }
        
        $non_akademik_fields = [
            'bakat_porseni', 'skala_binggris_ipec', 'pengalaman_lomba', 'minat_mempelajari', 'link_sertifikat'
        ];

        $rules = [];
        foreach ($matkul_fields as $field) {
            $rules[$field] = 'required|numeric|min:0|max:100';
        }
        $rules['bakat_porseni'] = 'required|numeric|min:0|max:1';
        $rules['skala_binggris_ipec'] = 'required|numeric|min:1|max:5';
        $rules['pengalaman_lomba'] = 'required|numeric|min:0|max:1';
        $rules['minat_mempelajari'] = 'required|numeric|min:0|max:1';
        $rules['link_sertifikat'] = 'nullable|url|max:255';

        $request->validate($rules);

        $nim = $user->nim_nip;

        $matkul_data = ['nim' => $nim];
        $total_matkul = 0;
        foreach ($matkul_fields as $field) {
            $val = $request->input($field);
            $matkul_data[$field] = $val;
            $total_matkul += $val;
        }
        \Illuminate\Support\Facades\DB::table('nilai_akademik')->updateOrInsert(['nim' => $nim], $matkul_data);
        
        $non_akademik_data = ['nim' => $nim];
        foreach ($non_akademik_fields as $field) {
            $non_akademik_data[$field] = $request->input($field);
        }
        \Illuminate\Support\Facades\DB::table('asesmen_non_akademik')->updateOrInsert(['nim' => $nim], $non_akademik_data);

        $skor_matkul = count($matkul_fields) > 0 ? round($total_matkul / count($matkul_fields)) : 0;
        
        $skor_minat_bakat = round(
            ($request->bakat_porseni * 25) +
            (($request->skala_binggris_ipec / 5) * 25) +
            ($request->pengalaman_lomba * 25) +
            ($request->minat_mempelajari * 25)
        );

        $user->skor_matkul = $skor_matkul;
        $user->skor_minat_bakat = $skor_minat_bakat;
        $user->is_assessed = true;
        $user->save();

        $lombas = \App\Models\Lomba::all();
        foreach ($lombas as $lomba) {
            \App\Models\AsesmenStatistik::firstOrCreate([
                'user_id' => $user->id,
                'lomba_id' => $lomba->id,
            ], [
                'status_keputusan' => 'pending'
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Nilai asesmen berhasil diperbarui!');
    }
}
