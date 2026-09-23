<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 tracking-tight leading-tight">
            {{ __('Dashboard Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Banner -->
            <div class="bg-white/70 backdrop-blur-md overflow-hidden shadow-sm sm:rounded-3xl border border-white/40">
                <div class="p-8">
                    <h3 class="text-3xl font-semibold text-gray-900 mb-2">Selamat datang, {{ Auth::user()->name ?? 'Mahasiswa' }}! 👋</h3>
                    <p class="text-[#0066cc] font-medium text-lg mb-2">Angkatan {{ Auth::user()->angkatan ?? '-' }} • Semester {{ Auth::user()->semester_aktif ?? '-' }}</p>
                    <p class="text-gray-500 text-base">Berikut adalah rekomendasi lomba yang telah disesuaikan dengan profil dan prestasimu.</p>
                </div>
            </div>

            <!-- Rekomendasi Lomba Section -->
            <div>
                <h4 class="text-xl font-medium text-gray-900 mb-4 px-2">Rekomendasi Terkini</h4>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Dummy Card 1 -->
                    <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition duration-300 transform hover:-translate-y-1">
                        <div class="flex justify-between items-start mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-600">
                                Teknologi
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-600 border border-green-100">
                                Validated
                            </span>
                        </div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">Gemastik 2026</h5>
                        <p class="text-gray-500 text-sm mb-6 line-clamp-2">Lomba tingkat nasional di bidang Teknologi Informasi dan Komunikasi (TIK) untuk mahasiswa.</p>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <div class="text-sm text-gray-500">Batas: <span class="font-medium text-gray-700">12 Okt 2026</span></div>
                            <button class="bg-[#0066cc] text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-700 transition">Lihat Detail</button>
                        </div>
                    </div>

                    <!-- Dummy Card 2 -->
                    <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition duration-300 transform hover:-translate-y-1">
                        <div class="flex justify-between items-start mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-50 text-purple-600">
                                Bisnis & Startup
                            </span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-600 border border-yellow-100">
                                Pending
                            </span>
                        </div>
                        <h5 class="text-xl font-semibold text-gray-900 mb-2">Business Plan Competition</h5>
                        <p class="text-gray-500 text-sm mb-6 line-clamp-2">Tuangkan ide bisnis inovatifmu dan menangkan pendanaan untuk startup impianmu.</p>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <div class="text-sm text-gray-500">Batas: <span class="font-medium text-gray-700">25 Nov 2026</span></div>
                            <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-full text-sm font-medium hover:bg-gray-200 transition">Lihat Detail</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
