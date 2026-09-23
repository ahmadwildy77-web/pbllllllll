<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 tracking-tight">Profil Mahasiswa</h2>
                <p class="text-sm text-gray-500">Lihat dan perbarui informasi akademik serta portofolio kompetisi Anda</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-[#0066cc] bg-blue-50 hover:bg-blue-100 px-4 py-2 rounded-lg font-medium text-sm transition">
                Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Main Profile Card -->
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-r from-blue-50 to-[#eaf0fc] z-0"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-center md:items-start gap-8 mt-12">
                    <!-- Photo -->
                    <div class="w-40 h-40 rounded-full border-4 border-white shadow-lg overflow-hidden bg-white flex-shrink-0">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0066cc&color=fff&size=300" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    </div>
                    
                    <!-- Info -->
                    <div class="flex-1 text-center md:text-left mt-2">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                                <p class="text-gray-500 font-medium mt-1 uppercase">{{ $user->role }}</p>
                            </div>
                            @if(Auth::user()->role === 'mahasiswa')
                            <button class="mt-4 md:mt-0 bg-[#0066cc] text-white px-5 py-2.5 rounded-xl font-medium text-sm hover:bg-[#0055aa] transition flex items-center justify-center shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Unduh Profil
                            </button>
                            @endif
                        </div>
                        
                        <div class="flex justify-center md:justify-start space-x-12 mt-8">
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-1">{{ Auth::user()->role === 'mahasiswa' ? 'NIM' : 'NIP / ID' }}</p>
                                <p class="text-lg font-bold text-gray-900">{{ $user->nim_nip ?? '-' }}</p>
                            </div>
                            @if(Auth::user()->role === 'mahasiswa')
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-1">GPA</p>
                                <p class="text-lg font-bold text-green-600">{{ $user->gpa ? number_format($user->gpa, 2) . ' / 4.00' : 'Belum diisi' }}</p>
                            </div>
                            @else
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-1">Email</p>
                                <p class="text-lg font-bold text-blue-600">{{ $user->email }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if(Auth::user()->role === 'mahasiswa')
            <!-- 4 Info Cards Row -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                <!-- PBL -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">PBL</h3>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">Pengembangan Berbasis Laboratorium</p>
                    <div class="mt-auto space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-400">Status</span>
                            <span class="font-bold text-green-600">{{ $user->pbl_status ?? 'Aktif' }}</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-400">Dosen Pembimbing</span>
                            <span class="font-bold text-gray-900">Dr. A. Rahman</span>
                        </div>
                    </div>
                </div>

                <!-- Prestasi -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Prestasi</h3>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">Penghargaan dan Capaian Akademik</p>
                    <div class="mt-auto space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-400">Juara 1</span>
                            <span class="font-bold text-gray-900 text-right">Hackathon 2023</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-400">Sertifikat</span>
                            <span class="font-bold text-gray-900 text-right">TOEFL IBT 95</span>
                        </div>
                    </div>
                </div>

                <!-- Media Sosial -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Media Sosial</h3>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">Koneksi Profesional & Akademik</p>
                    <div class="mt-auto space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-400">LinkedIn</span>
                            <span class="font-bold text-[#0066cc] text-right truncate max-w-[120px]">{{ $user->linkedin ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-400">GitHub</span>
                            <span class="font-bold text-[#0066cc] text-right truncate max-w-[120px]">{{ $user->github ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Skill/Magang -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900 text-lg">Skill/Magang</h3>
                    </div>
                    <p class="text-xs text-gray-500 mb-4">Kompetensi dan Minat</p>
                    <div class="mt-auto space-y-2">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-400">Bahasa</span>
                            <span class="font-bold text-gray-900 text-right truncate max-w-[120px]">{{ $user->skills ?? 'Belum diisi' }}</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-400">Tools</span>
                            <span class="font-bold text-gray-900 text-right truncate max-w-[120px]">Figma, VSCode</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kompetisi Lomba Section -->
            <div class="pt-8 pb-4">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Kompetisi (LOMBA)</h2>
                    <a href="{{ route('lomba.index') }}" class="text-[#0066cc] text-sm font-semibold hover:underline">Lihat Semua</a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Mock Lomba Cards based on Figma design -->
                    @foreach(['Hackathon Nasional 2024', 'Olimpiade Matematika', 'Debat Bahasa Inggris', 'Kompetisi Desain UI/UX'] as $index => $nama)
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition flex flex-col h-full group">
                        <div class="h-32 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&q=80&w=600" alt="Cover" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="font-bold text-gray-900 leading-tight mb-1">{{ $nama }}</h3>
                            <p class="text-[11px] text-gray-500 mb-4 flex-1">Kategori Lomba</p>
                            
                            <div class="flex items-center text-[10px] text-gray-400 mt-auto">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                12 - 15 Mar 2024
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Laravel Settings (Accordion) -->
            <div class="mt-12 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ open: false }">
                <button @click="open = !open" class="w-full px-8 py-6 flex justify-between items-center bg-gray-50 hover:bg-gray-100 transition">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-900">Pengaturan Akun Lanjutan</h3>
                    </div>
                    <svg class="w-5 h-5 text-gray-400 transform transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                <div x-show="open" class="p-8 space-y-8 border-t border-gray-100" style="display: none;">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                    <hr class="border-gray-100">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                    <hr class="border-gray-100">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>