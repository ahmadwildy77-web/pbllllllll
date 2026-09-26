<x-app-layout>
    <!-- Wrapper utama dibuat full-width untuk menyatu dengan navbar -->
    <div class="w-full space-y-8 pb-10">
        
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Dashboard Kaprodi</h2>
                <p class="text-sm text-slate-500 mt-1">Sistem Rekomendasi Lomba Mahasiswa (SIREMA)</p>
            </div>
        </div>
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <!-- Total Mahasiswa -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Mahasiswa</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ number_format($total_mahasiswa, 0, ',', '.') }}</h3>
                </div>
            </div>

            <!-- Lomba Aktif -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Lomba Aktif</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ number_format($lomba_aktif, 0, ',', '.') }}</h3>
                </div>
            </div>

            <!-- Rekomendasi Hari Ini -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Rekomendasi Baru</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ number_format($rekomendasi_hari_ini, 0, ',', '.') }}</h3>
                </div>
            </div>

            <!-- Prestasi Terbaru -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center gap-5">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 shrink-0">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Prestasi Terbaru</p>
                    <h3 class="text-3xl font-bold text-slate-800">{{ number_format($prestasi_terbaru, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Grafik Lomba -->
            <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm flex flex-col">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Distribusi Lomba</h3>
                        <p class="text-sm text-slate-500 mt-1">Berdasarkan kategori skala penyelenggaraan</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                </div>
                
                <div class="flex gap-4 mb-8">
                    <div class="bg-slate-50 rounded-xl p-4 flex-1 border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Nasional</p>
                        <p class="text-2xl font-bold text-slate-800">{{ number_format($lomba_nasional, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 flex-1 border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Internasional</p>
                        <p class="text-2xl font-bold text-slate-800">{{ number_format($lomba_internasional, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 flex-1 border border-slate-100">
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-1">Internal</p>
                        <p class="text-2xl font-bold text-slate-800">{{ number_format($lomba_internal, 0, ',', '.') }}</p>
                    </div>
                </div>

                <!-- Mock Bar Chart (Refined) -->
                <div class="flex-1 min-h-[200px] border border-gray-100 rounded-xl p-6 flex items-end justify-around relative">
                    <!-- Horizontal lines -->
                    <div class="absolute inset-0 flex flex-col justify-between p-6 pointer-events-none">
                        <div class="border-b border-gray-100 w-full h-0"></div>
                        <div class="border-b border-gray-100 w-full h-0"></div>
                        <div class="border-b border-gray-100 w-full h-0"></div>
                        <div class="border-b border-gray-100 w-full h-0"></div>
                    </div>
                    
                    <div class="w-14 bg-blue-600 rounded-t-lg h-32 relative z-10 hover:bg-blue-700 transition"></div>
                    <div class="w-14 bg-blue-400 rounded-t-lg h-16 relative z-10 hover:bg-blue-500 transition"></div>
                    <div class="w-14 bg-blue-300 rounded-t-lg h-24 relative z-10 hover:bg-blue-400 transition"></div>
                    <div class="w-14 bg-blue-200 rounded-t-lg h-10 relative z-10 hover:bg-blue-300 transition"></div>
                </div>
                <div class="flex justify-around mt-3">
                    <span class="text-[11px] font-medium text-slate-500">Nasional</span>
                    <span class="text-[11px] font-medium text-slate-500">Internasional</span>
                    <span class="text-[11px] font-medium text-slate-500">Internal</span>
                    <span class="text-[11px] font-medium text-slate-500">Hybrid</span>
                </div>
            </div>

            <!-- Diagram keaktifan -->
            <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm flex flex-col">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">Diagram Keaktifan</h3>
                        <p class="text-sm text-slate-500 mt-1">Konversi mahasiswa dalam keaktifan lomba</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    </div>
                </div>
                
                <!-- Mock Step Chart (Refined) -->
                <div class="flex-1 mt-10 min-h-[220px] border border-gray-100 rounded-xl p-6 flex items-end justify-around relative bg-slate-50/50">
                    <div class="w-16 bg-blue-600 rounded-t-lg h-20 relative z-10 hover:bg-blue-700 transition"></div>
                    <div class="w-16 bg-blue-400 rounded-t-lg h-32 relative z-10 hover:bg-blue-500 transition"></div>
                    <div class="w-16 bg-blue-300 rounded-t-lg h-40 relative z-10 hover:bg-blue-400 transition"></div>
                    <div class="w-16 bg-emerald-400 rounded-t-lg h-48 relative z-10 hover:bg-emerald-500 transition"></div>
                </div>
                <div class="flex justify-around mt-3">
                    <span class="text-[11px] font-medium text-slate-500">Profil</span>
                    <span class="text-[11px] font-medium text-slate-500">Rekomendasi</span>
                    <span class="text-[11px] font-medium text-slate-500">Pendaftaran</span>
                    <span class="text-[11px] font-bold text-emerald-600">Aktif</span>
                </div>
            </div>
        </div>

        <!-- Statistika & Insight Bottom -->
        <div class="bg-white rounded-2xl p-8 border border-gray-200 shadow-sm">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Pie Chart Area -->
                <div class="md:w-1/3 flex flex-col">
                    <h3 class="text-lg font-bold text-slate-800">Statistika</h3>
                    <p class="text-sm text-slate-500 mt-1 mb-8">Ringkasan performa sistem rekomendasi</p>
                    
                    <div class="relative w-52 h-52 mx-auto mt-auto mb-auto">
                        <!-- Mock donut using borders -->
                        <div class="w-full h-full rounded-full border-[36px] border-blue-600 border-t-emerald-400 border-r-blue-400"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-xs font-semibold text-slate-400">Total</span>
                            <span class="text-3xl font-extrabold text-slate-800 mt-1">{{ number_format($total_rekomendasi, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Details Area -->
                <div class="md:w-2/3 md:pl-8 flex flex-col justify-center">
                    <div class="space-y-5 mb-8">
                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                                <span class="text-sm font-medium text-slate-600">Rekomendasi Diterima</span>
                            </div>
                            <span class="text-lg font-bold text-slate-800">{{ $rekomendasi_diterima }}%</span>
                        </div>
                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-blue-400"></div>
                                <span class="text-sm font-medium text-slate-600">Rekomendasi Pending</span>
                            </div>
                            <span class="text-lg font-bold text-slate-800">{{ $rekomendasi_pending }}%</span>
                        </div>
                        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full bg-rose-400"></div>
                                <span class="text-sm font-medium text-slate-600">Rekomendasi Diabaikan</span>
                            </div>
                            <span class="text-lg font-bold text-slate-800">{{ $rekomendasi_diabaikan }}%</span>
                        </div>
                    </div>
                    
                    <div class="mt-2 bg-blue-50 border border-blue-100 rounded-xl p-5 flex gap-4">
                        <svg class="w-6 h-6 text-blue-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <h4 class="text-sm font-bold text-blue-900 mb-1">Insight Hari Ini</h4>
                            <p class="text-sm text-blue-700 leading-relaxed">Rekomendasi lomba nasional memiliki konversi tertinggi ke keaktifan mahasiswa. Disarankan memfokuskan kurasi pada kategori ini untuk meningkatkan partisipasi keseluruhan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
