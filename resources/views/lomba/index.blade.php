<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-8" data-aos="fade-down">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900">Daftar Kompetisi (Lomba)</h2>
                <p class="mt-2 text-gray-500">Pilih kompetisi yang sesuai dengan minat dan bakat Anda.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($lombas as $index => $lomba)
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-2 flex flex-col" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    
                    <div class="h-32 bg-gradient-to-r from-blue-500 to-indigo-600 relative">
                        <!-- Decorative circle -->
                        <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-white opacity-20 rounded-full"></div>
                        <div class="absolute -top-6 -left-6 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                        <div class="absolute bottom-4 left-6">
                            <span class="px-3 py-1 bg-white/20 text-white rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-sm border border-white/30">Terbuka</span>
                        </div>
                    </div>

                    <div class="p-6 flex-grow flex flex-col">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $lomba->nama_lomba }}</h3>
                        <p class="text-gray-500 text-sm mb-6 flex-grow">{{ Str::limit($lomba->deskripsi, 120) }}</p>
                        
                        <a href="{{ route('lomba.show', $lomba->id) }}" class="inline-flex justify-center items-center w-full bg-blue-50 text-blue-600 font-bold px-4 py-3 rounded-xl hover:bg-blue-600 hover:text-white transition duration-300">
                            Lihat Detail & Daftar
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if(count($lombas) == 0)
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100" data-aos="fade-up">
                <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                <h3 class="text-xl font-medium text-gray-900">Belum ada lomba tersedia</h3>
                <p class="mt-1 text-gray-500">Silakan kembali lagi nanti.</p>
            </div>
        @endif
    </div>
</x-app-layout>
