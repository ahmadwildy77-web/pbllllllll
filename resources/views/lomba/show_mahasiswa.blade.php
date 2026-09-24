<x-app-layout>
    @php
        $user = Auth::user();
        $skorMinat = $user->skor_minat_bakat ?? 0;
        $skorMatkul = $user->skor_matkul ?? 0;
        $persentase = ($skorMinat * 0.6) + ($skorMatkul * 0.4);
        
        if ($persentase >= 80) {
            $rekomendasi = "Sangat Direkomendasikan";
            $warna = "text-emerald-600";
            $bgWarna = "bg-emerald-50 border-emerald-200";
        } elseif ($persentase >= 60) {
            $rekomendasi = "Cukup Direkomendasikan";
            $warna = "text-[#0066cc]";
            $bgWarna = "bg-blue-50 border-blue-200";
        } else {
            $rekomendasi = "Kurang Direkomendasikan";
            $warna = "text-amber-600";
            $bgWarna = "bg-amber-50 border-amber-200";
        }
    @endphp

    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('lomba.index') }}" class="text-gray-500 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-lg transition" title="Kembali">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-gray-900 tracking-tight">Detail Lomba</h2>
                <p class="text-sm text-gray-500">Informasi lomba dan kecocokan profil Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto space-y-6">

        <!-- Header Lomba -->
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <div class="flex flex-col md:flex-row gap-8">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-blue-50 text-[#0066cc] text-xs font-bold rounded-md uppercase tracking-wide">{{ $lomba->kategori ?? 'Lomba' }}</span>
                        <span class="px-3 py-1 bg-gray-50 text-gray-600 text-xs font-bold rounded-md uppercase tracking-wide">{{ $lomba->tingkat ?? 'Nasional' }}</span>
                    </div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-4 leading-tight">{{ $lomba->nama_lomba }}</h2>
                    <p class="text-gray-600 leading-relaxed">{{ $lomba->deskripsi }}</p>
                    
                    @if(isset($lomba->url))
                    <div class="mt-6">
                        <a href="{{ $lomba->url }}" target="_blank" class="inline-flex items-center bg-[#0066cc] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[#0055aa] transition shadow-sm">
                            Kunjungi Situs Lomba
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            <!-- Hasil Asesmen Profil -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 flex flex-col">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Data Kecocokan Anda</h3>
                        <p class="text-sm text-gray-500">Analisis profil terhadap persyaratan lomba</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                </div>
                
                <div class="space-y-6 mb-8">
                    <div>
                        <div class="flex justify-between text-sm font-medium mb-2">
                            <span class="text-gray-600">Skor Minat Bakat (60%)</span>
                            <span class="text-gray-900">{{ $skorMinat }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5">
                            <div class="bg-[#5ac8fa] h-2.5 rounded-full" style="width: {{ min(100, $skorMinat) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm font-medium mb-2">
                            <span class="text-gray-600">Rata-rata Nilai Matkul (40%)</span>
                            <span class="text-gray-900">{{ $skorMatkul }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5">
                            <div class="bg-[#82c9ff] h-2.5 rounded-full" style="width: {{ min(100, $skorMatkul) }}%"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-auto rounded-2xl p-6 border {{ $bgWarna }}">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-bold text-gray-700">Total Nilai Prediksi</span>
                        <span class="text-2xl font-extrabold {{ $warna }}">{{ $persentase }}%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Status Rekomendasi</span>
                        <span class="text-sm font-bold {{ $warna }}">{{ $rekomendasi }}</span>
                    </div>
                </div>
            </div>

            @if(isset($asesmen))
            <!-- Status Rekomendasi -->
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Status Pengajuan</h3>
                        <p class="text-sm text-gray-500">Progres rekomendasi dari Koordinator</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                
                <div class="flex flex-col items-center justify-center py-6">
                    @if($asesmen->status_keputusan == 'pending')
                        <div class="w-20 h-20 bg-amber-100 text-amber-500 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Menunggu Keputusan</h4>
                        <p class="text-center text-sm text-gray-500 max-w-xs">Pengajuan rekomendasi Anda sedang ditinjau oleh Koordinator.</p>
                    @elseif($asesmen->status_keputusan == 'terpilih')
                        <div class="w-20 h-20 bg-blue-100 text-blue-500 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Direkomendasikan (Menunggu Validasi)</h4>
                        <p class="text-center text-sm text-gray-500 max-w-xs">Anda telah direkomendasikan oleh koordinator, menunggu validasi akhir dari Dosen/Kaprodi.</p>
                    @elseif($asesmen->status_keputusan == 'divalidasi')
                        <div class="w-20 h-20 bg-emerald-100 text-emerald-500 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Resmi Mengikuti Lomba</h4>
                        <p class="text-center text-sm text-gray-500 max-w-xs">Selamat! Rekomendasi telah divalidasi dan Anda resmi menjadi peserta lomba ini.</p>
                    @elseif($asesmen->status_keputusan == 'ditolak')
                        <div class="w-20 h-20 bg-red-100 text-red-500 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Tidak Direkomendasikan</h4>
                        <p class="text-center text-sm text-gray-500 max-w-xs">Mohon maaf, Anda belum direkomendasikan untuk mengikuti perlombaan ini.</p>
                    @endif
                </div>
            </div>
            @endif
            
        </div>
    </div>
</x-app-layout>
