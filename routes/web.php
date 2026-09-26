<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\AsesmenController;
use App\Http\Controllers\InitialAssessmentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Lomba;

// Route Halaman Utama / Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Route Resource Product
Route::resource('product', ProductController::class);

Route::middleware(['auth'])->group(function () {
    
    // Route untuk asesmen awal
    Route::get('/asesmen-awal', [InitialAssessmentController::class, 'create'])->name('asesmen_awal.create');
    Route::post('/asesmen-awal', [InitialAssessmentController::class, 'store'])->name('asesmen_awal.store');

    Route::middleware('ensure_assessed')->group(function () {
        Route::get('/dashboard', function () {
            $role = auth()->user()->role;
            if ($role === 'mahasiswa') {
                $rekomendasi_divalidasi = \App\Models\AsesmenStatistik::with('lomba')
                    ->where('user_id', auth()->id())
                    ->where('status_keputusan', 'divalidasi')
                    ->get();
                return view('mahasiswa.dashboard', compact('rekomendasi_divalidasi'));
            }
            
            // Query for admin dashboard
            $total_mahasiswa = \App\Models\User::where('role', 'mahasiswa')->count();
            $lomba_aktif = \App\Models\Lomba::count();
            $rekomendasi_hari_ini = \App\Models\AsesmenStatistik::whereDate('created_at', today())->count();
            
            // Dummy or related to other statuses:
            $prestasi_terbaru = \App\Models\AsesmenStatistik::whereIn('status_keputusan', ['terpilih', 'divalidasi'])->count();

            // Chart data
            $lomba_nasional = \App\Models\Lomba::where('kategori', 'Nasional')->count() ?: 18; // Defaulting to old value if none
            $lomba_internasional = \App\Models\Lomba::where('kategori', 'Internasional')->count() ?: 9;
            $lomba_internal = \App\Models\Lomba::where('kategori', 'Internal')->count() ?: 15;

            // Stats data
            $total_rekomendasi = \App\Models\AsesmenStatistik::count();
            $rekomendasi_diterima = $total_rekomendasi > 0 ? round((\App\Models\AsesmenStatistik::whereIn('status_keputusan', ['terpilih', 'divalidasi'])->count() / $total_rekomendasi) * 100) : 0;
            $rekomendasi_pending = $total_rekomendasi > 0 ? round((\App\Models\AsesmenStatistik::where('status_keputusan', 'pending')->count() / $total_rekomendasi) * 100) : 0;
            $rekomendasi_diabaikan = $total_rekomendasi > 0 ? round((\App\Models\AsesmenStatistik::where('status_keputusan', 'diabaikan')->count() / $total_rekomendasi) * 100) : 0;

            return view('admin.dashboard', compact(
                'total_mahasiswa', 'lomba_aktif', 'rekomendasi_hari_ini', 'prestasi_terbaru',
                'lomba_nasional', 'lomba_internasional', 'lomba_internal',
                'total_rekomendasi', 'rekomendasi_diterima', 'rekomendasi_pending', 'rekomendasi_diabaikan'
            ));
        })->name('dashboard');

        Route::get('/lomba', [LombaController::class, 'index'])->name('lomba.index');
        Route::get('/lomba/create', [LombaController::class, 'create'])->name('lomba.create');
        Route::post('/lomba', [LombaController::class, 'store'])->name('lomba.store');
        Route::get('/lomba/{lomba}', [LombaController::class, 'show'])->name('lomba.show');
        Route::delete('/lomba/{lomba}', [LombaController::class, 'destroy'])->name('lomba.destroy');

        Route::get('/bantuan', function () {
            return view('bantuan');
        })->name('bantuan');
        Route::post('/lomba/{lomba_id}/asesmen', [AsesmenController::class, 'storeOrUpdate'])
            ->middleware('role:mahasiswa')
            ->name('asesmen.store');
    });

    Route::middleware('role:koordinator,staf,kaprodi')->group(function () {
        Route::get('/mahasiswa', [\App\Http\Controllers\MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::get('/mahasiswa/{id}', [\App\Http\Controllers\MahasiswaController::class, 'show'])->name('mahasiswa.show');
    });

    Route::middleware('role:koordinator')->group(function () {
        Route::patch('/asesmen/{id}/status', [AsesmenController::class, 'updateStatus'])->name('asesmen.update_status');
        Route::delete('/asesmen/{id}', [AsesmenController::class, 'destroy'])->name('asesmen.destroy');
    });

    Route::middleware('role:kaprodi')->group(function () {
        Route::get('/validasi', [\App\Http\Controllers\KaprodiController::class, 'index'])->name('kaprodi.validasi');
        Route::patch('/validasi/{id}', [\App\Http\Controllers\KaprodiController::class, 'validateRekomendasi'])->name('kaprodi.validasi.update');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/notifications/read', function () {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.readAll');
});

require __DIR__.'/auth.php';