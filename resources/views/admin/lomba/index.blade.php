<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 tracking-tight">Manajemen Lomba</h2>
                <p class="text-sm text-gray-500">Kelola lomba, rekomendasi, dan partisipasi mahasiswa</p>
            </div>
        </div>
    </x-slot>

    <!-- Container full width untuk menyelaraskan dengan layout app -->
    <div class="w-full space-y-6">
        
        <div class="flex justify-between items-end mb-6">
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-1">Daftar Lomba</h3>
                <p class="text-sm text-gray-500">Tambahkan lomba baru atau kelola lomba yang sudah aktif</p>
            </div>
            @if(Auth::user()->role === 'koordinator')
            <div>
                <a href="{{ route('lomba.create') }}" class="bg-[#0066cc] text-white px-5 py-2.5 rounded-lg font-medium text-sm hover:bg-[#0055aa] transition flex items-center shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add Lomba
                </a>
            </div>
            @endif
        </div>

        @if($lombas->isEmpty())
            <div class="bg-white rounded-3xl p-16 shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
                <div class="w-32 h-32 rounded-full bg-blue-50/50 flex items-center justify-center mb-8 border-[12px] border-white shadow-sm">
                    <div class="w-20 h-20 rounded-full bg-blue-50 flex items-center justify-center">
                        <svg class="w-10 h-10 text-[#0066cc]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    </div>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Belum ada lomba</h2>
                <p class="text-gray-500 max-w-md mb-8">Tambahkan lomba pertama Anda untuk memulai rekomendasi, pengelolaan pendaftaran, dan pelacakan partisipasi mahasiswa.</p>
                @if(Auth::user()->role === 'koordinator')
                <a href="{{ route('lomba.create') }}" class="bg-[#0066cc] text-white px-6 py-3 rounded-xl font-semibold hover:bg-[#0055aa] transition flex items-center shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Lomba
                </a>
                @endif
                <p class="text-xs text-gray-400 mt-4">Setelah ditambahkan, lomba akan muncul di daftar ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @if(Auth::user()->role === 'koordinator')
                <!-- Tambah Lomba Baru Tile -->
                <a href="{{ route('lomba.create') }}" class="bg-blue-50/30 rounded-3xl p-6 border-2 border-dashed border-blue-100 flex flex-col items-start justify-center hover:bg-blue-50/50 hover:border-blue-200 transition cursor-pointer group h-full">
                    <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center mb-6 shadow-sm group-hover:scale-105 transition-transform">
                        <svg class="w-6 h-6 text-[#0066cc]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-900 text-lg mb-2">Tambah Lomba Baru</h3>
                    <p class="text-xs text-gray-500 mb-6 flex-1">Buat lomba baru untuk meningkatkan rekomendasi dan partisipasi mahasiswa.</p>
                    <div class="text-[#0066cc] bg-white border border-[#0066cc]/20 px-4 py-2 rounded-full font-semibold text-xs hover:bg-[#0066cc]/5 transition flex items-center shadow-sm w-max">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat lomba
                    </div>
                </a>
                @endif

                @foreach($lombas as $lomba)
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex flex-col hover:shadow-md transition h-full">
                    <div class="flex justify-between items-start mb-6">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-[#0066cc] flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 leading-tight mb-1">{{ $lomba->nama_lomba }}</h3>
                                <p class="text-[11px] text-gray-500">{{ $lomba->kategori ?? 'Nasional • Terbuka' }}</p>
                            </div>
                        </div>
                        <span class="px-2.5 py-1 bg-blue-50 text-[#0066cc] text-[10px] font-bold rounded-full">Aktif</span>
                    </div>

                    <div class="space-y-3 mb-6 flex-1">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-500">Tenggat</span>
                            <span class="font-semibold text-gray-900">12 Apr 2026</span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-500">Peserta</span>
                            <span class="font-semibold text-gray-900">186</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center border-t border-gray-50 pt-4 mt-auto">
                        <span class="text-xs text-gray-500">Rekomendasi: 42</span>
                        <div class="flex items-center space-x-2">
                            @if(Auth::user()->role === 'koordinator')
                            <form action="{{ route('lomba.destroy', $lomba->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus lomba ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-full transition" title="Hapus Lomba">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                            @endif
                            <a href="{{ route('lomba.show', $lomba->id) }}" class="px-4 py-1.5 bg-gray-50 text-gray-700 hover:bg-gray-100 hover:text-gray-900 text-xs font-semibold rounded-full transition">Lihat detail</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        @endif
    </div>
</x-app-layout>
