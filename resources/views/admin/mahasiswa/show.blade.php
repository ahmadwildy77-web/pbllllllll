<x-app-layout>
    <!-- Container utama dibentangkan penuh untuk menyesuaikan dengan layout baru -->
    <div class="w-full space-y-8 pb-10">
        
        <!-- Header Halaman Lokal (Kini berada di dalam main content) -->
        <div class="flex items-center gap-4 mb-8">
            @php
                $backRoute = route('mahasiswa.index');
                if ((Auth::user()->role ?? '') === 'kaprodi') {
                    $backRoute = route('kaprodi.validasi');
                }
            @endphp
            <a href="{{ $backRoute }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-white border border-gray-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-all shadow-sm group" title="Kembali">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-slate-800 tracking-tight">Profil Mahasiswa</h2>
                <p class="text-sm text-slate-500 mt-1">Detail informasi dan portofolio mahasiswa</p>
            </div>
        </div>

        <!-- Kartu Profil Utama -->
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-200">
            <div class="flex flex-col md:flex-row gap-8 items-start">
                
                <!-- Avatar -->
                <div class="w-32 h-32 rounded-2xl border-4 border-slate-50 shadow-sm overflow-hidden bg-white shrink-0 group-hover:scale-105 transition-transform">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->name) }}&background=0066cc&color=fff&size=200" alt="{{ $mahasiswa->name }}" class="w-full h-full object-cover">
                </div>
                
                <!-- Detail Info -->
                <div class="flex-1 w-full mt-2">
                    <h3 class="text-3xl font-bold text-slate-800 mb-2">{{ $mahasiswa->name }}</h3>
                    <p class="text-sm font-medium text-slate-500 mb-5">{{ $mahasiswa->nim_nip ?? 'Belum ada NIM' }} &bull; Angkatan {{ $mahasiswa->angkatan ?? 'N/A' }}</p>
                    
                    <div class="flex flex-wrap gap-3 mb-8">
                        <span class="px-4 py-1.5 bg-blue-50 text-blue-700 text-xs font-bold rounded-lg border border-blue-100">
                            Semester {{ $mahasiswa->semester_aktif ?? '?' }}
                        </span>
                        <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-xs font-bold rounded-lg border border-emerald-100">
                            {{ $mahasiswa->status_akun ?? 'Aktif' }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-y-8 gap-x-6">
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold mb-1.5 uppercase tracking-wider">IPK</p>
                            <p class="text-slate-800 font-semibold text-lg">{{ $mahasiswa->gpa ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold mb-1.5 uppercase tracking-wider">Status PBL</p>
                            <p class="text-slate-800 font-semibold text-lg">{{ $mahasiswa->pbl_status ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold mb-1.5 uppercase tracking-wider">Skills</p>
                            <p class="text-slate-800 font-medium">{{ $mahasiswa->skills ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold mb-1.5 uppercase tracking-wider">Email</p>
                            <p class="text-slate-800 font-medium">{{ $mahasiswa->email }}</p>
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold mb-1.5 uppercase tracking-wider">LinkedIn</p>
                            @if($mahasiswa->linkedin)
                            <a href="{{ $mahasiswa->linkedin }}" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline font-semibold flex items-center gap-1">
                                Buka Profil
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                            @else
                            <p class="text-slate-500 font-medium">Belum diisi</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-[11px] text-slate-400 font-bold mb-1.5 uppercase tracking-wider">GitHub</p>
                            @if($mahasiswa->github)
                            <a href="{{ $mahasiswa->github }}" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline font-semibold flex items-center gap-1">
                                Buka Profil
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                            @else
                            <p class="text-slate-500 font-medium">Belum diisi</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
