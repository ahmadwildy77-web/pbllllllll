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
            
            // Koor and Staf see the admin dashboard
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('/lomba', [LombaController::class, 'index'])->name('lomba.index');
        Route::get('/lomba/create', [LombaController::class, 'create'])->name('lomba.create');
        Route::post('/lomba', [LombaController::class, 'store'])->name('lomba.store');
        Route::get('/lomba/{lomba}', [LombaController::class, 'show'])->name('lomba.show');

        Route::post('/lomba/{lomba_id}/asesmen', [AsesmenController::class, 'storeOrUpdate'])
            ->middleware('role:mahasiswa')
            ->name('asesmen.store');
    });

    Route::middleware('role:koordinator,staf')->group(function () {
        Route::get('/mahasiswa', [\App\Http\Controllers\MahasiswaController::class, 'index'])->name('mahasiswa.index');
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
});

require __DIR__.'/auth.php';