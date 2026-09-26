<x-app-layout>
    <div class="w-full space-y-6">
        
        <div class="flex justify-between items-center w-full mb-6">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 tracking-tight">Daftar Mahasiswa</h2>
                <p class="text-sm text-gray-500">Kelola profil, rekomendasi, dan aktivitas mahasiswa</p>
            </div>
        </div>
        
        <!-- Filters -->
        <form method="GET" action="{{ route('mahasiswa.index') }}" class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="relative w-full sm:w-96 flex">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-200 rounded-xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[#0066cc] focus:border-[#0066cc] sm:text-sm transition" placeholder="Cari nama atau NIM">
            </div>
            <div class="flex items-center space-x-3 w-full sm:w-auto">
                <select name="semester" class="border border-gray-200 bg-white rounded-xl text-sm font-medium text-gray-700 py-2 pl-4 pr-8 hover:bg-gray-50 transition focus:ring-[#0066cc]">
                    <option value="all">Semua Semester</option>
                    @for($i=1; $i<=8; $i++)
                        <option value="{{ $i }}" {{ request('semester') == $i ? 'selected' : '' }}>Semester {{ $i }}</option>
                    @endfor
                </select>
                <select name="status" class="border border-gray-200 bg-white rounded-xl text-sm font-medium text-gray-700 py-2 pl-4 pr-8 hover:bg-gray-50 transition focus:ring-[#0066cc]">
                    <option value="all">Semua Status</option>
                    <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Non-Aktif" {{ request('status') == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
                <button type="submit" class="flex items-center px-4 py-2 border border-[#0066cc] bg-[#0066cc] rounded-xl text-sm font-medium text-white hover:bg-[#0055aa] transition">
                    Terapkan
                </button>
                @if(request()->hasAny(['search', 'semester', 'status']))
                <a href="{{ route('mahasiswa.index') }}" class="flex items-center px-4 py-2 border border-gray-200 bg-white rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-50 transition">
                    Reset
                </a>
                @endif
            </div>
        </form>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($mahasiswas as $mhs)
            <a href="{{ route('mahasiswa.show', $mhs->id) }}" class="block">
            <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="relative h-24 bg-gradient-to-r from-blue-50 to-[#eaf0fc] flex items-end justify-center pb-0">
                    <!-- Photo -->
                    <div class="w-16 h-16 rounded-full border-4 border-white shadow-sm overflow-hidden bg-white translate-y-1/2">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($mhs->name) }}&background=0066cc&color=fff&size=150" alt="{{ $mhs->name }}" class="w-full h-full object-cover">
                    </div>
                    <!-- Status Badge -->
                    <div class="absolute top-3 right-3 w-6 h-6 bg-white rounded-full flex items-center justify-center shadow">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </div>
                <div class="p-5 pt-10 text-center">
                    <h3 class="font-bold text-gray-900 text-lg leading-tight">{{ $mhs->name }}</h3>
                    <p class="text-xs text-gray-500 mb-3">NIM {{ $mhs->nim_nip ?? 'Belum ada NIM' }}</p>
                    
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-2 py-1 bg-blue-50 text-[#0066cc] text-[10px] font-bold rounded-md">
                            Semester {{ $mhs->semester_aktif ?? '?' }}
                        </span>
                        <span class="px-2 py-1 bg-gray-50 text-gray-600 text-[10px] font-bold rounded-md">
                            {{ $mhs->status_akun ?? 'Aktif' }}
                        </span>
                    </div>
                </div>
            </div>
            </a>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $mahasiswas->links() }}
        </div>

    </div>
</x-app-layout>
