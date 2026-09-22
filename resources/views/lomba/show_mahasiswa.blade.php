<x-app-layout>
    @php
        $user = Auth::user();
        $skorMinat = $user->skor_minat_bakat ?? 0;
        $skorMatkul = $user->skor_matkul ?? 0;
        $persentase = ($skorMinat * 0.6) + ($skorMatkul * 0.4);
        
        if ($persentase >= 80) {
            $rekomendasi = "Sangat Direkomendasikan";
            $warna = "text-green-700";
        } elseif ($persentase >= 60) {
            $rekomendasi = "Cukup Direkomendasikan";
            $warna = "text-blue-700";
        } else {
            $rekomendasi = "Kurang Direkomendasikan";
            $warna = "text-yellow-700";
        }
    @endphp

    <div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Tombol Kembali -->
        <div class="mb-4">
            <a href="{{ route('lomba.index') }}" class="text-blue-600 hover:underline text-sm font-medium">
                &larr; Kembali ke Daftar Lomba
            </a>
        </div>

        <!-- Header Lomba -->
        <div class="bg-white border border-gray-300 p-5 mb-6">
            <h2 class="text-xl font-bold text-gray-900 border-b pb-2 mb-3">{{ $lomba->nama_lomba }}</h2>
            <p class="text-gray-700 text-sm text-justify">{{ $lomba->deskripsi }}</p>
        </div>

        <div class="flex flex-col gap-6">
            
            <!-- Hasil Asesmen Profil -->
            <div class="bg-white border border-gray-300 p-5">
                <h3 class="text-lg font-bold text-gray-800 mb-3 border-b border-gray-300 pb-2">Data Kecocokan Anda</h3>
                
                <table class="w-full text-sm text-left border-collapse mt-3 mb-4">
                    <tbody>
                        <tr class="border-b">
                            <th class="py-2 text-gray-600 font-normal">Skor Minat Bakat (60%)</th>
                            <td class="py-2 text-right font-semibold">{{ $skorMinat }}</td>
                        </tr>
                        <tr class="border-b">
                            <th class="py-2 text-gray-600 font-normal">Rata-rata Nilai Matkul (40%)</th>
                            <td class="py-2 text-right font-semibold">{{ $skorMatkul }}</td>
                        </tr>
                        <tr class="bg-gray-50 border-b">
                            <th class="py-3 px-2 text-gray-800 font-bold">Total Nilai Prediksi</th>
                            <td class="py-3 px-2 text-right font-bold text-lg {{ $warna }}">{{ $persentase }}%</td>
                        </tr>
                        <tr>
                            <th class="py-3 px-2 text-gray-800 font-bold">Status Rekomendasi</th>
                            <td class="py-3 px-2 text-right font-bold {{ $warna }}">{{ $rekomendasi }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Form Pendaftaran Lomba -->
            <div class="bg-white border border-gray-300 p-5">
                <h3 class="text-lg font-bold text-gray-800 mb-3 border-b border-gray-300 pb-2">Formulir Pendaftaran Lomba</h3>
                
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 border border-green-300 px-3 py-2 mb-4 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('asesmen.store', $lomba->id) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-800 text-sm font-bold mb-1">Nilai Uji Portofolio (0-100)</label>
                        <p class="text-xs text-gray-600 mb-2">Nilai syarat tambahan untuk mendaftar.</p>
                        <input type="number" name="nilai" step="0.01" value="{{ $asesmen->nilai ?? '' }}" required
                            class="w-full px-3 py-2 border border-gray-400 focus:outline-none focus:border-blue-500 text-sm" 
                            {{ ($asesmen->status_keputusan ?? 'pending') != 'pending' ? 'readonly' : '' }}>
                    </div>
                    
                    <div class="mb-5">
                        <span class="text-sm font-bold text-gray-800">Status Pendaftaran:</span>
                        @if(($asesmen->status_keputusan ?? 'Belum Mendaftar') == 'pending')
                            <span class="ml-2 px-2 py-1 bg-yellow-200 text-yellow-900 border border-yellow-400 text-xs font-bold uppercase">Menunggu Keputusan</span>
                        @elseif(($asesmen->status_keputusan ?? '') == 'terpilih')
                            <span class="ml-2 px-2 py-1 bg-green-200 text-green-900 border border-green-400 text-xs font-bold uppercase">Terpilih</span>
                        @elseif(($asesmen->status_keputusan ?? '') == 'ditolak')
                            <span class="ml-2 px-2 py-1 bg-red-200 text-red-900 border border-red-400 text-xs font-bold uppercase">Ditolak</span>
                        @else
                            <span class="ml-2 px-2 py-1 bg-gray-200 text-gray-700 border border-gray-300 text-xs font-bold uppercase">Belum Mendaftar</span>
                        @endif
                    </div>

                    @if(($asesmen->status_keputusan ?? 'pending') == 'pending')
                        <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold py-2 px-4 border border-blue-800 shadow-sm">
                            {{ isset($asesmen) ? 'Perbarui Portofolio' : 'Kirim Pendaftaran' }}
                        </button>
                    @else
                        <button type="button" disabled class="w-full bg-gray-300 text-gray-600 border border-gray-400 text-sm font-bold py-2 px-4 cursor-not-allowed">
                            Pendaftaran Sudah Diproses
                        </button>
                    @endif
                </form>
            </div>
            
        </div>
    </div>
</x-app-layout>
