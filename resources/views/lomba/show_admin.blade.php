<x-app-layout>
    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- Tombol Kembali -->
        <a href="{{ route('lomba.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold mb-6 transition" data-aos="fade-right">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Dashboard Monitor
        </a>

        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100" data-aos="fade-up">
            <div class="bg-gradient-to-r from-gray-800 to-gray-700 p-8 text-white flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-extrabold">Data Pendaftar</h2>
                    <p class="mt-2 text-gray-300 text-lg">Lomba: <span class="font-bold text-white">{{ $lomba->nama_lomba }}</span></p>
                </div>
                <div class="hidden md:block">
                    <span class="px-4 py-2 bg-gray-600 rounded-full text-sm font-bold shadow-inner">Total: {{ count($asesmens) }} Peserta</span>
                </div>
            </div>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm" role="alert" data-aos="fade-up">
                <p class="font-bold">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        <!-- Tabel Data -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden" data-aos="fade-up" data-aos-delay="100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 uppercase text-xs tracking-wider">
                            <th class="p-4 font-semibold">NIM</th>
                            <th class="p-4 font-semibold">Nama Mahasiswa</th>
                            <th class="p-4 font-semibold text-center">Nilai Portofolio</th>
                            <th class="p-4 font-semibold text-center">Rekomendasi AI (%)</th>
                            <th class="p-4 font-semibold text-center">Status</th>
                            @if($user->role === 'koordinator')
                                <th class="p-4 font-semibold text-center">Aksi (Koor)</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($asesmens as $a)
                        @php
                            $persenAI = ($a->user->skor_minat_bakat * 0.6) + ($a->user->skor_matkul * 0.4);
                        @endphp
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="p-4 text-gray-800">{{ $a->user->nim_nip }}</td>
                            <td class="p-4 font-bold text-blue-600">{{ $a->user->name }}</td>
                            <td class="p-4 text-center font-bold text-gray-800">{{ $a->nilai }}</td>
                            <td class="p-4 text-center">
                                <span class="inline-block px-2 py-1 {{ $persenAI >= 80 ? 'bg-green-100 text-green-800' : ($persenAI >= 60 ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }} rounded text-sm font-bold">
                                    {{ $persenAI }}%
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                @if($a->status_keputusan == 'pending')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full font-bold uppercase text-xs">Pending</span>
                                @elseif($a->status_keputusan == 'terpilih')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full font-bold uppercase text-xs">Menunggu Validasi</span>
                                @elseif($a->status_keputusan == 'divalidasi')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full font-bold uppercase text-xs">Divalidasi</span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full font-bold uppercase text-xs">Ditolak</span>
                                @endif
                            </td>
                            
                            @if($user->role === 'koordinator')
                            <td class="p-4 flex gap-2 justify-center items-center">
                                @if($a->status_keputusan === 'divalidasi')
                                    <span class="text-sm font-bold text-green-600">Disetujui Kaprodi</span>
                                @else
                                <form action="{{ route('asesmen.update_status', $a->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <select name="status_keputusan" class="border border-gray-300 p-2 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm" onchange="this.form.submit()">
                                        <option value="pending" {{ $a->status_keputusan == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                        <option value="terpilih" {{ $a->status_keputusan == 'terpilih' ? 'selected' : '' }}>✅ Rekomendasikan</option>
                                        <option value="ditolak" {{ $a->status_keputusan == 'ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                                    </select>
                                </form>
                                @endif
                                
                                <form action="{{ route('asesmen.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus data pendaftar ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 px-3 py-2 rounded shadow-sm transition border border-red-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 italic">Belum ada mahasiswa yang mendaftar di lomba ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
