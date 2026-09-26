<x-app-layout>
    <div class="w-full space-y-6">
        
        <div class="mb-6">
            <h2 class="font-bold text-2xl text-gray-900 tracking-tight">Daftar Lomba</h2>
            <p class="text-sm text-gray-500">Pilih dan daftarkan diri pada kompetisi yang sesuai dengan keahlian Anda</p>
        </div>
        
        <div>
            <h3 class="text-xl font-medium text-gray-900 mb-4 px-2">Kompetisi Tersedia</h3>
            <p class="mt-1 text-gray-500 px-2 mb-6 text-sm">Pilih dan daftarkan diri pada kompetisi yang sesuai dengan keahlian Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($lombas as $index => $lomba)
                <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition duration-300 transform hover:-translate-y-1 flex flex-col h-full">
                    
                    <div class="flex justify-between items-start mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-[#0066cc]/10 text-[#0066cc]">
                            Lomba Terbuka
                        </span>
                    </div>

                    <h4 class="text-lg font-semibold text-gray-900 mb-2">{{ $lomba->nama_lomba }}</h4>
                    <p class="text-gray-500 text-sm mb-6 flex-grow line-clamp-3">{{ $lomba->deskripsi }}</p>
                    
                    <div class="mt-auto pt-4 border-t border-gray-50">
                        <a href="{{ route('lomba.show', $lomba->id) }}" class="inline-block w-full text-center bg-gray-50 text-gray-700 font-medium px-4 py-2.5 rounded-full hover:bg-gray-100 transition duration-300 text-sm">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if(count($lombas) == 0)
            <div class="text-center py-20 bg-white/70 backdrop-blur-md rounded-3xl border border-white/40 shadow-sm mt-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 mb-4 text-gray-400">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-xl font-medium text-gray-900">Belum ada lomba tersedia</h3>
                <p class="mt-2 text-gray-500">Silakan periksa kembali nanti untuk melihat daftar kompetisi baru.</p>
            </div>
        @endif
    </div>
</x-app-layout>
