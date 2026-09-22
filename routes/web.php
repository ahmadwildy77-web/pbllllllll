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
    // Jika file welcome.blade.php belum ada, langsung alihkan ke halaman login atau lomba
    return redirect()->route('login');
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
            if ($role === 'mahasiswa') return redirect()->route('lomba.index');
            if ($role === 'staf') return redirect()->route('lomba.index')->with('message', 'Dashboard Monitor');
            if ($role === 'koor_kaprodi') return redirect()->route('lomba.index')->with('message', 'Dashboard Admin');
        })->name('dashboard');

        Route::get('/lomba', [LombaController::class, 'index'])->name('lomba.index');
        Route::get('/lomba/{lomba}', [LombaController::class, 'show'])->name('lomba.show');

        Route::post('/lomba/{lomba_id}/asesmen', [AsesmenController::class, 'storeOrUpdate'])
            ->middleware('role:mahasiswa')
            ->name('asesmen.store');
    });

    Route::middleware('role:koor_kaprodi')->group(function () {
        Route::patch('/asesmen/{id}/status', [AsesmenController::class, 'updateStatus'])->name('asesmen.update_status');
        Route::delete('/asesmen/{id}', [AsesmenController::class, 'destroy'])->name('asesmen.destroy');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';