<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 tracking-tight">Dashboard Mahasiswa</h2>
                <p class="text-sm text-gray-500">Lihat rekomendasi lomba yang telah disetujui untuk Anda</p>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6 max-w-7xl mx-auto">
        
        <div>
            <h3 class="text-xl font-bold text-gray-900 mb-4 px-2">Rekomendasi Lomba Saya</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($rekomendasi_divalidasi as $rek)
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Divalidasi Kaprodi
                            </span>
                            <div class="w-8 h-8 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $rek->lomba->nama_lomba }}</h4>
                        <p class="text-sm text-gray-500 mb-6 flex-grow line-clamp-2">{{ $rek->lomba->deskripsi }}</p>
                        
                        <div class="mt-auto pt-4 border-t border-gray-50">
                            <a href="{{ route('lomba.show', $rek->lomba_id) }}" class="inline-flex items-center justify-center w-full bg-[#0066cc] hover:bg-[#0055aa] text-white font-semibold px-4 py-2.5 rounded-xl transition text-sm">
                                Lihat Detail Lomba
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-16 bg-white rounded-3xl border border-gray-100 shadow-sm">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4 text-gray-400">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Belum Ada Rekomendasi</h3>
                            <p class="mt-2 text-gray-500">Saat ini belum ada lomba yang divalidasi dan direkomendasikan untuk Anda.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-app-layout>
