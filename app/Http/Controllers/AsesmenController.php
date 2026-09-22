<?php

namespace App\Http\Controllers;

use App\Models\AsesmenStatistik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsesmenController extends Controller
{
    public function storeOrUpdate(Request $request, $lomba_id)
    {
        $request->validate(['nilai' => 'required|numeric|min:0|max:100']);

        $asesmen = AsesmenStatistik::updateOrCreate(
            ['user_id' => Auth::id(), 'lomba_id' => $lomba_id],
            ['nilai' => $request->nilai, 'status_keputusan' => 'pending']
        );

        return back()->with('success', 'Data asesmen berhasil disimpan.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status_keputusan' => 'required|in:pending,terpilih,ditolak']);
        
        $asesmen = AsesmenStatistik::findOrFail($id);
        $asesmen->update(['status_keputusan' => $request->status_keputusan]);

        return back()->with('success', 'Status peserta berhasil diubah.');
    }

    public function destroy($id)
    {
        $asesmen = AsesmenStatistik::findOrFail($id);
        $asesmen->delete();

        return back()->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
