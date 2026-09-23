<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 tracking-tight">Dashboard SIREMA</h2>
                <p class="text-sm text-gray-500">Sistem rekomendasi lomba mahasiswa</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6 max-w-7xl mx-auto">
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <!-- Total Mahasiswa -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-sm font-semibold text-gray-500">Total Mahasiswa</span>
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-3xl font-extrabold text-gray-900 mb-1">1.284</h3>
                <p class="text-xs text-gray-400 mt-auto">Mahasiswa aktif di sistem</p>
            </div>

            <!-- Lomba Aktif -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-sm font-semibold text-gray-500">Lomba Aktif</span>
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                </div>
                <h3 class="text-3xl font-extrabold text-gray-900 mb-1">42</h3>
                <p class="text-xs text-gray-400 mt-auto">Rekomendasi lomba tersedia</p>
            </div>

            <!-- Rekomendasi Hari Ini -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-sm font-semibold text-gray-500">Rekomendasi Hari Ini</span>
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                </div>
                <h3 class="text-3xl font-extrabold text-gray-900 mb-1">186</h3>
                <p class="text-xs text-gray-400 mt-auto">Rekomendasi diterbitkan</p>
            </div>

            <!-- Prestasi Terbaru -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-sm font-semibold text-gray-500">Prestasi Terbaru</span>
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                    </div>
                </div>
                <h3 class="text-3xl font-extrabold text-gray-900 mb-1">12</h3>
                <p class="text-xs text-gray-400 mt-auto">Prestasi mahasiswa tercatat</p>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Grafik Lomba -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-bold text-gray-900">GRAFIK LOMBA</h3>
                        <p class="text-xs text-gray-400">Distribusi lomba berdasarkan kategori</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                </div>
                
                <div class="flex space-x-4 mb-8">
                    <div class="bg-gray-50 rounded-xl p-3 flex-1">
                        <p class="text-[10px] text-gray-500 uppercase tracking-wide">Nasional</p>
                        <p class="text-xl font-bold text-gray-900">18</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 flex-1">
                        <p class="text-[10px] text-gray-500 uppercase tracking-wide">Internasional</p>
                        <p class="text-xl font-bold text-gray-900">9</p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-3 flex-1">
                        <p class="text-[10px] text-gray-500 uppercase tracking-wide">Internal</p>
                        <p class="text-xl font-bold text-gray-900">15</p>
                    </div>
                </div>

                <!-- Mock Bar Chart -->
                <div class="h-48 border border-gray-100 rounded-xl p-4 flex items-end justify-around relative">
                    <!-- Horizontal lines -->
                    <div class="absolute inset-0 flex flex-col justify-between p-4 pointer-events-none">
                        <div class="border-b border-gray-100 w-full h-0"></div>
                        <div class="border-b border-gray-100 w-full h-0"></div>
                        <div class="border-b border-gray-100 w-full h-0"></div>
                        <div class="border-b border-gray-100 w-full h-0"></div>
                    </div>
                    
                    <div class="w-12 bg-[#0066cc] rounded-t-md h-32 relative z-10"></div>
                    <div class="w-12 bg-[#5ac8fa] rounded-t-md h-16 relative z-10"></div>
                    <div class="w-12 bg-[#82c9ff] rounded-t-md h-24 relative z-10"></div>
                    <div class="w-12 bg-[#bde0fe] rounded-t-md h-10 relative z-10"></div>
                </div>
                <div class="flex justify-around mt-2">
                    <span class="text-[10px] text-gray-400">Nasional</span>
                    <span class="text-[10px] text-gray-400">Internasional</span>
                    <span class="text-[10px] text-gray-400">Internal</span>
                    <span class="text-[10px] text-gray-400">Hybrid</span>
                </div>
            </div>

            <!-- Diagram ke aktifan -->
            <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-bold text-gray-900">Diagram ke aktifan</h3>
                        <p class="text-xs text-gray-400">Konversi mahasiswa ke aktifan lomba</p>
                    </div>
                    <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    </div>
                </div>
                
                <!-- Mock Step Chart -->
                <div class="h-64 border border-gray-100 rounded-xl p-4 flex items-end justify-around relative mt-[88px]">
                    <div class="w-14 bg-[#0066cc] rounded-t-md h-20 relative z-10"></div>
                    <div class="w-14 bg-[#5ac8fa] rounded-t-md h-32 relative z-10"></div>
                    <div class="w-14 bg-[#82c9ff] rounded-t-md h-40 relative z-10"></div>
                    <div class="w-14 bg-[#bde0fe] rounded-t-md h-48 relative z-10"></div>
                </div>
                <div class="flex justify-around mt-2">
                    <span class="text-[10px] text-gray-400">Profil</span>
                    <span class="text-[10px] text-gray-400">Rekomendasi</span>
                    <span class="text-[10px] text-gray-400">Pendaftaran</span>
                    <span class="text-[10px] text-gray-400">Aktif</span>
                </div>
            </div>
        </div>

        <!-- Statistika Bottom -->
        <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row">
            <div class="md:w-1/3 mb-6 md:mb-0">
                <h3 class="font-bold text-gray-900">statistika</h3>
                <p class="text-xs text-gray-400 mb-6">Ringkasan performa sistem rekomendasi</p>
                
                <!-- Mock Pie Chart / Donut -->
                <div class="relative w-48 h-48 mx-auto">
                    <!-- Fake donut using borders -->
                    <div class="w-full h-full rounded-full border-[32px] border-[#0066cc] border-t-[#82c9ff] border-r-[#5ac8fa]"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-[10px] text-gray-400">Total rekomendasi</span>
                        <span class="text-2xl font-extrabold text-gray-900">1.284</span>
                    </div>
                </div>
            </div>
            
            <div class="md:w-2/3 md:pl-10 flex flex-col justify-center">
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-sm font-medium text-gray-600">
                            <span class="w-3 h-3 rounded bg-[#0066cc] mr-3"></span>
                            Rekomendasi diterima
                        </div>
                        <span class="font-bold text-gray-900">72%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-sm font-medium text-gray-600">
                            <span class="w-3 h-3 rounded bg-[#5ac8fa] mr-3"></span>
                            Rekomendasi dibuka
                        </div>
                        <span class="font-bold text-gray-900">18%</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center text-sm font-medium text-gray-600">
                            <span class="w-3 h-3 rounded bg-[#bde0fe] mr-3"></span>
                            Rekomendasi diabaikan
                        </div>
                        <span class="font-bold text-gray-900">10%</span>
                    </div>
                </div>
                
                <div class="bg-blue-50/50 rounded-2xl p-4">
                    <h4 class="text-sm font-bold text-[#0066cc] mb-1">Insight hari ini</h4>
                    <p class="text-xs text-gray-600 leading-relaxed">Rekomendasi lomba nasional memiliki konversi tertinggi ke aktifan mahasiswa. Fokus pada kategori ini dapat meningkatkan partisipasi keseluruhan.</p>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
