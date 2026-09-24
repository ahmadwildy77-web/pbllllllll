<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('mahasiswa.index') }}" class="text-gray-500 hover:text-gray-900 bg-gray-50 hover:bg-gray-100 p-2 rounded-lg transition" title="Kembali">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-gray-900 tracking-tight">Profil Mahasiswa</h2>
                <p class="text-sm text-gray-500">Detail data dan portofolio mahasiswa</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">
        <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
            <div class="flex flex-col md:flex-row gap-8 items-start">
                <div class="w-32 h-32 rounded-full border-4 border-gray-50 shadow-sm overflow-hidden bg-white shrink-0">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->name) }}&background=0066cc&color=fff&size=200" alt="{{ $mahasiswa->name }}" class="w-full h-full object-cover">
                </div>
                
                <div class="flex-1 w-full">
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $mahasiswa->name }}</h3>
                    <p class="text-sm text-gray-500 mb-4">{{ $mahasiswa->nim_nip ?? 'Belum ada NIM' }} &bull; Angkatan {{ $mahasiswa->angkatan ?? 'N/A' }}</p>
                    
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 bg-blue-50 text-[#0066cc] text-xs font-bold rounded-md">
                            Semester {{ $mahasiswa->semester_aktif ?? '?' }}
                        </span>
                        <span class="px-3 py-1 bg-green-50 text-green-600 text-xs font-bold rounded-md">
                            {{ $mahasiswa->status_akun ?? 'Aktif' }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div>
                            <p class="text-xs text-gray-400 font-semibold mb-1 uppercase tracking-wide">IPK</p>
                            <p class="text-gray-900 font-medium">{{ $mahasiswa->gpa ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-semibold mb-1 uppercase tracking-wide">Status PBL</p>
                            <p class="text-gray-900 font-medium">{{ $mahasiswa->pbl_status ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-semibold mb-1 uppercase tracking-wide">Skills</p>
                            <p class="text-gray-900 font-medium">{{ $mahasiswa->skills ?? 'Belum diisi' }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-semibold mb-1 uppercase tracking-wide">Email</p>
                            <p class="text-gray-900 font-medium">{{ $mahasiswa->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-semibold mb-1 uppercase tracking-wide">LinkedIn</p>
                            @if($mahasiswa->linkedin)
                            <a href="{{ $mahasiswa->linkedin }}" target="_blank" class="text-[#0066cc] hover:underline font-medium">Buka Profil</a>
                            @else
                            <p class="text-gray-900 font-medium">Belum diisi</p>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-semibold mb-1 uppercase tracking-wide">GitHub</p>
                            @if($mahasiswa->github)
                            <a href="{{ $mahasiswa->github }}" target="_blank" class="text-[#0066cc] hover:underline font-medium">Buka Profil</a>
                            @else
                            <p class="text-gray-900 font-medium">Belum diisi</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
