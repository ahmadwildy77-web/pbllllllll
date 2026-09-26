<x-app-layout>
    <div class="py-12 w-full">
        
        <!-- Header Halaman Lokal dengan Tombol Kembali Bulat -->
        <div class="flex items-center gap-4 mb-6" data-aos="fade-right">
            <a href="{{ route('lomba.index') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-white border border-gray-200 text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-all shadow-sm group" title="Kembali ke Dashboard">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            </a>
            <div>
                <h2 class="font-bold text-2xl text-slate-800 tracking-tight">Detail Lomba</h2>
                <p class="text-sm text-slate-500 mt-1">Kembali ke Dashboard Monitor</p>
            </div>
        </div>

        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100" data-aos="fade-up">
            <div class="bg-gradient-to-r from-gray-800 to-gray-700 p-8 text-white flex justify-between items-center">
                <div>
                    <h2 class="text-3xl font-extrabold">Data Mahasiswa Terkait</h2>
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
                            $related_matkul = json_decode($lomba->related_matkul, true) ?? [];
                            $skor_matkul_spesifik = 0;
                            
                            if (count($related_matkul) > 0) {
                                $nilai_akademik = \Illuminate\Support\Facades\DB::table('nilai_akademik')
                                    ->where('nim', $a->user->nim_nip)
                                    ->first();
                                    
                                if ($nilai_akademik) {
                                    $total = 0;
                                    foreach ($related_matkul as $matkul) {
                                        $total += $nilai_akademik->$matkul ?? 0;
                                    }
                                    $skor_matkul_spesifik = round($total / count($related_matkul));
                                }
                            } else {
                                $skor_matkul_spesifik = $a->user->skor_matkul;
                            }
                            
                            $skor_matkul_spesifik = $skor_matkul_spesifik ?? $a->user->skor_matkul ?? 0;
                            $persenAI = ($a->user->skor_minat_bakat * 0.6) + ($skor_matkul_spesifik * 0.4);
                        @endphp
                        <tr class="hover:bg-gray-50 transition duration-150" x-data="{
                            status: '{{ $a->status_keputusan }}',
                            saving: false,
                            updateStatus() {
                                this.saving = true;
                                fetch('{{ route('asesmen.update_status', $a->id) }}', {
                                    method: 'PATCH',
                                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
                                    body: JSON.stringify({ status_keputusan: this.status })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    this.saving = false;
                                    if(data.success) {
                                        window.dispatchEvent(new CustomEvent('notify', { detail: data.message }));
                                    }
                                }).catch(() => this.saving = false);
                            }
                        }">
                            <td class="p-4 text-gray-800">{{ $a->user->nim_nip }}</td>
                            <td class="p-4 font-bold text-blue-600">{{ $a->user->name }}</td>
                            <td class="p-4 text-center font-bold text-gray-800">{{ $a->nilai }}</td>
                            <td class="p-4 text-center">
                                <span class="inline-block px-2 py-1 {{ $persenAI >= 80 ? 'bg-green-100 text-green-800' : ($persenAI >= 60 ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }} rounded text-sm font-bold">
                                    {{ $persenAI }}%
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <span x-show="status === 'pending'" {!! $a->status_keputusan !== 'pending' ? 'style="display: none;"' : '' !!} x-transition class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full font-bold uppercase text-xs inline-block">Pending</span>
                                <span x-show="status === 'terpilih'" {!! $a->status_keputusan !== 'terpilih' ? 'style="display: none;"' : '' !!} x-transition class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full font-bold uppercase text-xs inline-block">Menunggu Validasi</span>
                                <span x-show="status === 'divalidasi'" {!! $a->status_keputusan !== 'divalidasi' ? 'style="display: none;"' : '' !!} x-transition class="px-3 py-1 bg-green-100 text-green-800 rounded-full font-bold uppercase text-xs inline-block">Resmi Mengikuti</span>
                                <span x-show="status === 'ditolak'" {!! $a->status_keputusan !== 'ditolak' ? 'style="display: none;"' : '' !!} x-transition class="px-3 py-1 bg-red-100 text-red-800 rounded-full font-bold uppercase text-xs inline-block">Ditolak</span>
                            </td>
                            
                            @if($user->role === 'koordinator')
                            <td class="p-4 flex gap-2 justify-center items-center">
                                @if($a->status_keputusan === 'divalidasi')
                                    <span class="text-sm font-bold text-green-600">Disetujui Kaprodi</span>
                                @else
                                    <select x-model="status" @change="updateStatus" :disabled="saving" class="border border-gray-300 p-2 rounded shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm transition cursor-pointer" :class="{ 'opacity-50 cursor-wait': saving }">
                                        <option value="pending">⏳ Pending</option>
                                        <option value="terpilih">✅ Rekomendasikan</option>
                                        <option value="ditolak">❌ Ditolak</option>
                                    </select>
                                @endif
                                
                                <form action="{{ route('asesmen.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus data pendaftar ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-600 hover:bg-red-100 hover:text-red-700 px-3 py-2 rounded shadow-sm transition border border-red-200" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 italic">Belum ada mahasiswa yang terkait dengan lomba ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Toast Notification (AlpineJS) -->
    <div x-data="{ show: false, message: '' }" 
         @notify.window="message = $event.detail; show = true; setTimeout(() => show = false, 3000)"
         class="fixed bottom-4 right-4 z-[9999]"
         x-show="show" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 translate-y-4" 
         x-transition:enter-end="opacity-100 translate-y-0" 
         x-transition:leave="transition ease-in duration-200" 
         x-transition:leave-start="opacity-100 translate-y-0" 
         x-transition:leave-end="opacity-0 translate-y-4"
         style="display: none;">
        <div class="bg-gray-800/95 backdrop-blur-md text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3 border border-gray-700">
            <div class="bg-green-500/20 p-1.5 rounded-full">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <span x-text="message" class="font-medium"></span>
        </div>
    </div>
</x-app-layout>
