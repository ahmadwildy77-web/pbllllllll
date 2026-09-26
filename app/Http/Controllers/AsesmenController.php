<?php

namespace App\Http\Controllers;

use App\Models\AsesmenStatistik;
use App\Notifications\StatusChangedNotification;
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
        $oldStatus = $asesmen->status_keputusan;
        $asesmen->update(['status_keputusan' => $request->status_keputusan]);

        // Kirim email notifikasi ke mahasiswa jika status berubah
        if ($oldStatus !== $request->status_keputusan && $asesmen->user && $asesmen->user->email) {
            try {
                $lombaName = $asesmen->lomba->nama_lomba ?? 'Lomba';
                $asesmen->user->notify(new StatusChangedNotification($lombaName, $request->status_keputusan));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::warning('Gagal kirim notifikasi email: ' . $e->getMessage());
            }
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Status peserta berhasil diubah.']);
        }

        return back()->with('success', 'Status peserta berhasil diubah.');
    }

    public function destroy($id)
    {
        $asesmen = AsesmenStatistik::findOrFail($id);
        $asesmen->delete();

        return back()->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
