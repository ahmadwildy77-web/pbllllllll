<x-app-layout>
    @php
        $semester = Auth::user()->semester_aktif ?? 1;
        $max_semester = min(max(0, $semester - 1), 4); // Matkul hanya sampai (semester - 1), maks 4
        
        $steps = [];
        $steps[] = ['title' => 'Selamat Datang'];
        
        if ($max_semester >= 1) {
            $steps[] = [
                'title' => 'Mata Kuliah Semester 1',
                'fields' => ['alpro' => 'Algoritma & Pemrograman', 'sim' => 'Sistem Inf Manajemen', 'smbd' => 'Manajemen Basis Data', 'desain_uiux' => 'Desain UI/UX', 'desain_grafis' => 'Desain Grafis', 'binggris' => 'Bahasa Inggris']
            ];
        }
        if ($max_semester >= 2) {
            $steps[] = [
                'title' => 'Mata Kuliah Semester 2',
                'fields' => ['ppl' => 'Pengemb Perangkat Lunak', 'arsikom' => 'Arsitektur Komputer', 'pemweb' => 'Pemrograman Web', 'struktur_data' => 'Struktur Data']
            ];
        }
        if ($max_semester >= 3) {
            $steps[] = [
                'title' => 'Mata Kuliah Semester 3',
                'fields' => ['pemweb_lanjut' => 'Pemrograman Web Lanjut', 'elektronika_dasar_dan_sensoring' => 'Elektronika & Sensor', 'insis' => 'Infrastruktur Sistem', 'komdatjar' => 'Komunikasi Data']
            ];
        }
        if ($max_semester >= 4) {
            $steps[] = [
                'title' => 'Mata Kuliah Semester 4',
                'fields' => ['aplikasi_mobile' => 'Aplikasi Mobile', 'manajemen_proyek' => 'Manajemen Proyek', 'teknologi_dan_keamanan_platform' => 'Tekn & Kmnn Platform', 'iot' => 'Internet of Things', 'data_mining' => 'Data Mining', 'kriptografi' => 'Kriptografi', 'sistem_terdistribusi' => 'Sistem Terdistribusi', 'kecerdasan_buatan' => 'Kecerdasan Buatan']
            ];
        }
        $steps[] = ['title' => 'Minat & Bakat Non-Akademik'];
        
        $total_steps = count($steps);
    @endphp

    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4" x-data="{ step: 1, maxStep: {{ $total_steps }} }">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden" data-aos="fade-up" data-aos-duration="800">
            
            <!-- Progress Bar -->
            <div class="bg-gray-100 h-2 w-full relative">
                <div class="absolute top-0 left-0 h-full bg-blue-600 transition-all duration-500 ease-in-out"
                    :style="'width: ' + ((step / maxStep) * 100) + '%'"></div>
            </div>

            <div class="p-8 md:p-12">
                <div class="text-center mb-10">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">
                        {{ Auth::user()->is_assessed ? 'Update Nilai Asesmen' : 'Asesmen Awal Profil' }}
                    </h2>
                    <p class="text-gray-500">
                        Langkah <span x-text="step" class="font-bold text-blue-600"></span> dari <span x-text="maxStep"></span>
                    </p>
                </div>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('asesmen_awal.store') }}" method="POST" id="asesmenForm">
                    @csrf
                    
                    @foreach($steps as $index => $step_data)
                        @php $current_step = $index + 1; @endphp
                        
                        @if($index === 0)
                            <!-- STEP 1: Pengantar -->
                            <div x-show="step === {{ $current_step }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="text-center py-8" style="display: none;">
                                <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $step_data['title'] }}</h3>
                                <p class="text-gray-600 mb-8 max-w-lg mx-auto">
                                    Berdasarkan profil Anda (Semester {{ Auth::user()->semester_aktif ?? '?' }}), kami akan menyesuaikan form pengisian nilai mata kuliah yang pernah Anda ambil.
                                </p>
                                <button type="button" @click="step++" class="px-8 py-3 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                    Mulai Sekarang
                                </button>
                            </div>
                        @elseif($index === $total_steps - 1)
                            <!-- LAST STEP: Minat & Bakat -->
                            <div x-show="step === {{ $current_step }}" x-transition:enter="transition ease-out duration-300 delay-100" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
                                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                                    <span class="bg-rose-100 text-rose-600 w-8 h-8 rounded-full flex items-center justify-center text-sm">{{ $current_step - 1 }}</span>
                                    {{ $step_data['title'] }}
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Punya Bakat Porseni?</label>
                                        <select name="bakat_porseni" required class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-rose-500 focus:border-rose-500">
                                            <option value="">-- Pilih --</option>
                                            <option value="1" {{ (string)old('bakat_porseni', $asesmen_non_akademik->bakat_porseni ?? '') === '1' ? 'selected' : '' }}>Ya</option>
                                            <option value="0" {{ (string)old('bakat_porseni', $asesmen_non_akademik->bakat_porseni ?? '') === '0' ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Skala Bahasa Inggris IPEC (1-5)</label>
                                        <input type="number" name="skala_binggris_ipec" min="1" max="5" required placeholder="Contoh: 3"
                                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-rose-500 focus:border-rose-500"
                                            value="{{ old('skala_binggris_ipec', $asesmen_non_akademik->skala_binggris_ipec ?? '') }}">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Pengalaman Lomba Sejenis?</label>
                                        <select name="pengalaman_lomba" required class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-rose-500 focus:border-rose-500">
                                            <option value="">-- Pilih --</option>
                                            <option value="1" {{ (string)old('pengalaman_lomba', $asesmen_non_akademik->pengalaman_lomba ?? '') === '1' ? 'selected' : '' }}>Ya</option>
                                            <option value="0" {{ (string)old('pengalaman_lomba', $asesmen_non_akademik->pengalaman_lomba ?? '') === '0' ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Minat Tinggi Mempelajari Hal Baru?</label>
                                        <select name="minat_mempelajari" required class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-rose-500 focus:border-rose-500">
                                            <option value="">-- Pilih --</option>
                                            <option value="1" {{ (string)old('minat_mempelajari', $asesmen_non_akademik->minat_mempelajari ?? '') === '1' ? 'selected' : '' }}>Ya</option>
                                            <option value="0" {{ (string)old('minat_mempelajari', $asesmen_non_akademik->minat_mempelajari ?? '') === '0' ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Link Foto Sertifikat (Google Drive)</label>
                                        <input type="url" name="link_sertifikat" placeholder="https://drive.google.com/..."
                                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:ring-rose-500 focus:border-rose-500"
                                            value="{{ old('link_sertifikat', $asesmen_non_akademik->link_sertifikat ?? '') }}">
                                        <p class="mt-1 text-xs text-gray-500">Pastikan akses link Google Drive diatur ke "Siapa saja yang memiliki link" (Opsional).</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- MIDDLE STEPS: Akademik -->
                            <div x-show="step === {{ $current_step }}" x-transition:enter="transition ease-out duration-300 delay-100" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" style="display: none;">
                                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                                    <span class="bg-blue-100 text-blue-600 w-8 h-8 rounded-full flex items-center justify-center text-sm">{{ $current_step - 1 }}</span>
                                    {{ $step_data['title'] }}
                                </h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
                                    @foreach($step_data['fields'] as $key => $label)
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">{{ $label }}</label>
                                            <input type="number" name="{{ $key }}" min="0" max="100" required placeholder="0-100"
                                                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 transition"
                                                value="{{ old($key, $nilai_akademik->$key ?? '') }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach

                    <!-- Navigation Buttons -->
                    <div class="mt-10 flex justify-between border-t pt-6" x-show="step > 1" style="display: none;">
                        <button type="button" @click="step--" class="px-6 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition">
                            Kembali
                        </button>
                        
                        <button type="button" x-show="step < maxStep" @click="step++" class="px-8 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow">
                            Selanjutnya
                        </button>
                        
                        <button type="submit" x-show="step === maxStep" class="px-8 py-2 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition shadow flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            {{ Auth::user()->is_assessed ? 'Simpan Perubahan' : 'Selesai & Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
