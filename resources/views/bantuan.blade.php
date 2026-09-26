<x-app-layout>
    <div class="py-8 w-full max-w-5xl mx-auto space-y-12">

        {{-- ============================================================ --}}
        {{-- HERO SECTION                                                --}}
        {{-- ============================================================ --}}
        <div class="text-center max-w-2xl mx-auto" data-aos="fade-up">
            <h1 class="text-3xl font-bold text-slate-900 tracking-tight mb-3">Pusat Bantuan</h1>
            <p class="text-base text-slate-500 leading-relaxed">
                Pelajari alur kerja sistem rekomendasi perlombaan SIREMA dan temukan jawaban atas pertanyaan umum.
            </p>
        </div>

        {{-- ============================================================ --}}
        {{-- CARA KERJA SIREMA  —  Interactive Stepper (Clean Design)    --}}
        {{-- ============================================================ --}}
        <div data-aos="fade-up" data-aos-delay="100">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">Cara Kerja SIREMA</h2>
                <p class="text-sm text-slate-500">Alur proses dari awal pendaftaran hingga validasi akhir.</p>
            </div>

            <div x-data="{ activeStep: 0 }" class="bg-white rounded-xl p-8 shadow-sm border border-slate-200">
                
                {{-- Step Indicator --}}
                <div class="flex items-center justify-between mb-10 relative">
                    {{-- Background Line --}}
                    <div class="absolute top-1/2 -translate-y-1/2 left-0 right-0 h-px bg-slate-200 z-0"></div>
                    
                    {{-- Progress Line --}}
                    <div class="absolute top-1/2 -translate-y-1/2 left-0 h-px bg-blue-600 z-0 transition-all duration-500 ease-out"
                         :style="'width: ' + (activeStep / 4 * 100) + '%'"></div>

                    @php
                        $steps = [
                            ['label' => 'Registrasi'],
                            ['label' => 'Asesmen'],
                            ['label' => 'Prediksi AI'],
                            ['label' => 'Rekomendasi'],
                            ['label' => 'Validasi']
                        ];
                    @endphp

                    @foreach($steps as $i => $step)
                    <button @click="activeStep = {{ $i }}" 
                            class="relative z-10 flex flex-col items-center group focus:outline-none bg-white px-2">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-semibold transition-colors duration-300 border-2"
                             :class="activeStep >= {{ $i }} 
                                 ? 'bg-blue-600 border-blue-600 text-white' 
                                 : 'bg-white border-slate-300 text-slate-400 group-hover:border-blue-400 group-hover:text-blue-500'">
                            {{ $i + 1 }}
                        </div>
                        <span class="text-xs font-medium mt-3 transition-colors duration-300 absolute top-full w-24 text-center -ml-8 hidden sm:block"
                              :class="activeStep >= {{ $i }} ? 'text-slate-900' : 'text-slate-400'">
                            {{ $step['label'] }}
                        </span>
                    </button>
                    @endforeach
                </div>

                {{-- Step Content --}}
                <div class="relative overflow-hidden min-h-[160px] sm:mt-12">
                    
                    {{-- Step 0 --}}
                    <div x-show="activeStep === 0" x-transition.opacity.duration.300ms>
                        <h3 class="text-lg font-bold text-slate-900 mb-2">1. Registrasi & Profil</h3>
                        <p class="text-slate-600 leading-relaxed text-sm max-w-3xl">
                            Mahasiswa mendaftar menggunakan NIM sebagai username, sedangkan Dosen/Staf menggunakan NIP. Setelah login, lengkapi data profil seperti semester aktif dan IPK agar sistem dapat mulai memproses data Anda.
                        </p>
                    </div>

                    {{-- Step 1 --}}
                    <div x-show="activeStep === 1" x-transition.opacity.duration.300ms style="display:none">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">2. Pengisian Asesmen Awal</h3>
                        <p class="text-slate-600 leading-relaxed text-sm max-w-3xl">
                            Saat pertama kali masuk, mahasiswa wajib mengisi form nilai mata kuliah (sesuai semester) dan form minat & bakat. Form ini mencakup pengalaman lomba, skor Bahasa Inggris, dan link sertifikat pendukung.
                        </p>
                    </div>

                    {{-- Step 2 --}}
                    <div x-show="activeStep === 2" x-transition.opacity.duration.300ms style="display:none">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">3. Perhitungan Prediksi (AI)</h3>
                        <p class="text-slate-600 leading-relaxed text-sm max-w-3xl mb-3">
                            Sistem secara otomatis menghitung persentase kecocokan mahasiswa terhadap setiap lomba yang ada.
                        </p>
                        <div class="bg-slate-50 border border-slate-200 rounded px-3 py-2 text-sm font-mono text-slate-700 inline-block">
                            Total = (Skor Minat Bakat × 60%) + (Rata-rata Matkul Terkait × 40%)
                        </div>
                    </div>

                    {{-- Step 3 --}}
                    <div x-show="activeStep === 3" x-transition.opacity.duration.300ms style="display:none">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">4. Rekomendasi Koordinator</h3>
                        <p class="text-slate-600 leading-relaxed text-sm max-w-3xl">
                            Berdasarkan hasil prediksi, Koordinator meninjau daftar mahasiswa di masing-masing lomba. Koordinator dapat memberikan status: <strong>Direkomendasikan</strong>, <strong>Pending</strong>, atau <strong>Ditolak</strong>.
                        </p>
                    </div>

                    {{-- Step 4 --}}
                    <div x-show="activeStep === 4" x-transition.opacity.duration.300ms style="display:none">
                        <h3 class="text-lg font-bold text-slate-900 mb-2">5. Validasi Kaprodi</h3>
                        <p class="text-slate-600 leading-relaxed text-sm max-w-3xl">
                            Kaprodi meninjau mahasiswa yang telah direkomendasikan oleh koordinator. Jika Kaprodi menekan tombol setuju (validasi), maka mahasiswa tersebut resmi menjadi peserta lomba.
                        </p>
                    </div>

                </div>

                {{-- Nav Buttons --}}
                <div class="flex items-center justify-between mt-8 pt-6 border-t border-slate-100">
                    <button @click="activeStep = Math.max(0, activeStep - 1)" :disabled="activeStep === 0"
                            class="text-sm font-medium text-slate-600 hover:text-slate-900 disabled:opacity-30 disabled:cursor-not-allowed transition-colors">
                        ← Sebelumnya
                    </button>
                    <button @click="activeStep = Math.min(4, activeStep + 1)" :disabled="activeStep === 4"
                            class="text-sm font-medium text-blue-600 hover:text-blue-800 disabled:opacity-30 disabled:cursor-not-allowed transition-colors">
                        Selanjutnya →
                    </button>
                </div>
            </div>
        </div>



        {{-- ============================================================ --}}
        {{-- FAQ (Clean Accordion)                                        --}}
        {{-- ============================================================ --}}
        <div data-aos="fade-up" data-aos-delay="300">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-900 tracking-tight">Pertanyaan Umum (FAQ)</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-3" x-data="{ openFaq: null }">
                @php
                    $faqs = [
                        ['Apa itu SIREMA?', 'SIREMA (Sistem Rekomendasi Mahasiswa) adalah platform yang memfasilitasi proses seleksi mahasiswa untuk perlombaan menggunakan metrik penilaian akademik dan non-akademik.'],
                        ['Bagaimana cara update nilai (ganti semester)?', 'Anda dapat memperbarui semester aktif di halaman <strong>Profil</strong>. Setelah itu, buka menu <strong>Update Nilai</strong> di navigasi atas untuk mengisi nilai matkul terbaru.'],
                        ['Apa arti persentase rekomendasi?', 'Persentase tersebut adalah prediksi kecocokan profil Anda dengan lomba. Dihitung berdasarkan 60% skor minat & bakat dan 40% nilai mata kuliah yang berkaitan dengan lomba tersebut.'],
                        ['Mengapa matkul yang dihitung berbeda tiap lomba?', 'Karena setiap lomba membutuhkan skill yang berbeda. Lomba IT hanya akan mempertimbangkan nilai matkul IT Anda, bukan nilai rata-rata keseluruhan semester.'],
                        ['Cara mengunggah sertifikat?', 'Cukup masukkan link Google Drive yang berisi sertifikat Anda ke dalam kolom yang tersedia pada form asesmen. Pastikan setting akses file adalah "Anyone with the link".'],
                        ['Bisa ikut lebih dari satu lomba?', 'Sistem mendaftarkan Anda secara otomatis ke semua lomba. Koordinator akan meninjau kecocokan Anda di masing-masing lomba dan menempatkan Anda di posisi yang paling tepat.'],
                    ];
                @endphp

                @foreach($faqs as $i => $faq)
                <div class="bg-white border border-slate-200 rounded-xl overflow-hidden transition-colors hover:border-slate-300">
                    <button @click="openFaq = openFaq === {{ $i }} ? null : {{ $i }}" 
                            class="w-full flex items-center justify-between p-4 text-left focus:outline-none">
                        <span class="font-medium text-slate-800 text-sm">{{ $faq[0] }}</span>
                        <svg class="w-4 h-4 text-slate-400 transition-transform duration-200 flex-shrink-0" 
                             :class="openFaq === {{ $i }} ? 'rotate-180' : ''" 
                             fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="openFaq === {{ $i }}" 
                         x-transition.opacity.duration.200ms
                         style="display: none;">
                        <div class="px-4 pb-4 pt-1 text-slate-600 text-sm leading-relaxed border-t border-slate-100 mt-2">
                            {!! $faq[1] !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- CONTACT                                                      --}}
        {{-- ============================================================ --}}
        <div class="bg-white rounded-xl border border-slate-200 p-6 flex flex-col sm:flex-row items-center justify-between gap-4" data-aos="fade-up" data-aos-delay="400">
            <div>
                <h3 class="font-bold text-slate-900">Masih Butuh Bantuan?</h3>
                <p class="text-sm text-slate-500 mt-1">Tim admin kami siap membantu pertanyaan Anda secara langsung.</p>
            </div>
            
            <div class="flex items-center gap-3 shrink-0">
                @php
                    $waNumber = config('whatsapp.admin_number');
                @endphp
                <a href="https://wa.me/{{ $waNumber }}" target="_blank"
                   class="inline-flex items-center gap-2 bg-[#25D366] text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-[#1da851] transition-colors">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    WhatsApp
                </a>
                
                @if(config('whatsapp.group_link'))
                <a href="{{ config('whatsapp.group_link') }}" target="_blank"
                   class="inline-flex items-center gap-2 bg-white text-slate-700 border border-slate-300 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-50 transition-colors">
                    Gabung Grup
                </a>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>
