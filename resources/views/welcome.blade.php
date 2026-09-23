<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIREMA - Sistem Rekomendasi Mahasiswa</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            blue: '#2c59d6', // Assuming the primary blue color
                            light: '#f1f5fb', // Very light blue background
                            card: '#e8effd',  // Light blue card top half
                            text: '#1a1a2e',  // Dark text
                            gray: '#6b7280'   // Subtitle text
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-brand-light text-brand-text">
    
    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-[1400px] mx-auto px-6 sm:px-8 h-20 flex items-center justify-between">
            <!-- Logo area -->
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-brand-blue rounded-md flex items-center justify-center text-white font-bold text-xl">S</div>
                <div class="flex flex-col">
                    <span class="font-bold text-xl text-brand-blue leading-none mb-1">SIREMA</span>
                    <span class="text-[10px] text-gray-500 font-medium leading-none tracking-wide">Sistem Rekomendasi Mahasiswa</span>
                </div>
            </div>

            <!-- Action -->
            <div>
                <a href="{{ route('login') }}" class="px-6 py-2.5 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                    Masuk
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="max-w-[1400px] mx-auto px-6 sm:px-8 pt-16 pb-24">
        
        <div class="text-center max-w-4xl mx-auto mb-20">
            <span class="inline-block px-4 py-1.5 bg-blue-50 text-brand-blue text-xs font-bold rounded-full mb-8">
                Sistem Rekomendasi Mahasiswa
            </span>
            
            <h1 class="text-[2.75rem] leading-[1.2] font-extrabold text-brand-text mb-6">
                <span class="text-brand-blue">SIREMA</span> - <span class="text-brand-blue">Si</span>stem <span class="text-brand-blue">Re</span>komendasi <span class="text-brand-blue">Ma</span>hasiswa pada Bidang Lomba Akademik dan Non-Akademik
            </h1>
            
            <p class="text-lg text-brand-gray max-w-2xl mx-auto font-medium">
                Temukan peluang kompetisi terbaik berdasarkan minat, kemampuan, dan bidang akademik maupun non-akademik.
            </p>
        </div>

        <!-- Prestasi Terbaru -->
        <div class="bg-[#f8fafc] rounded-[2rem] p-10 mb-20">
            <h2 class="text-2xl font-bold mb-2">Prestasi Terbaru</h2>
            <p class="text-brand-gray text-sm mb-8">Visualisasi kompetisi mahasiswa dengan tampilan modern dan interaktif.</p>
            
            <!-- Inner Card -->
            <div class="bg-[#eaf0fc] rounded-[1.5rem] p-8 min-h-[200px]">
                <span class="inline-block px-3 py-1 bg-white text-brand-blue text-[10px] font-bold rounded-full mb-4">
                    Lomba Akademik
                </span>
                <h3 class="text-xl font-bold text-brand-text mb-2">Kompetisi Riset Mahasiswa</h3>
                <p class="text-brand-gray text-sm">Pameran inovasi, presentasi, dan kolaborasi riset antar perguruan tinggi.</p>
            </div>
        </div>

        <!-- Lomba Terkini -->
        <div>
            <h2 class="text-2xl font-bold mb-2">Lomba Terkini</h2>
            <p class="text-brand-gray text-sm mb-8">Eksplorasi peluang kompetisi akademik dan non-akademik yang sesuai dengan minat dan kemampuan mahasiswa.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full">
                    <div class="bg-brand-card p-6 min-h-[160px] flex flex-col justify-start">
                        <span class="inline-block px-3 py-1 bg-white text-brand-blue text-[10px] font-bold rounded-full w-max mb-4">Lomba</span>
                        <h3 class="text-lg font-bold text-brand-text leading-snug">Kompetisi Riset Mahasiswa</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <p class="text-brand-gray text-xs mb-6 flex-1">Pameran inovasi, presentasi, dan kolaborasi riset antar perguruan tinggi.</p>
                        <a href="#" class="block w-full text-center py-2.5 bg-blue-50 text-brand-blue font-semibold text-xs rounded-xl hover:bg-blue-100 transition">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full">
                    <div class="bg-brand-card p-6 min-h-[160px] flex flex-col justify-start">
                        <span class="inline-block px-3 py-1 bg-white text-brand-blue text-[10px] font-bold rounded-full w-max mb-4">Lomba</span>
                        <h3 class="text-lg font-bold text-brand-text leading-snug">Debat & Diplomasi</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <p class="text-brand-gray text-xs mb-6 flex-1">Kompetisi wacana, negosiasi, dan strategi diplomasi mahasiswa.</p>
                        <a href="#" class="block w-full text-center py-2.5 bg-blue-50 text-brand-blue font-semibold text-xs rounded-xl hover:bg-blue-100 transition">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full">
                    <div class="bg-brand-card p-6 min-h-[160px] flex flex-col justify-start">
                        <span class="inline-block px-3 py-1 bg-white text-brand-blue text-[10px] font-bold rounded-full w-max mb-4">Lomba</span>
                        <h3 class="text-lg font-bold text-brand-text leading-snug">Hackathon Teknologi</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <p class="text-brand-gray text-xs mb-6 flex-1">Kompetisi pengembangan solusi digital dan inovasi teknologi.</p>
                        <a href="#" class="block w-full text-center py-2.5 bg-blue-50 text-brand-blue font-semibold text-xs rounded-xl hover:bg-blue-100 transition">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full">
                    <div class="bg-brand-card p-6 min-h-[160px] flex flex-col justify-start">
                        <span class="inline-block px-3 py-1 bg-white text-brand-blue text-[10px] font-bold rounded-full w-max mb-4">Lomba</span>
                        <h3 class="text-lg font-bold text-brand-text leading-snug">Kompetisi Seni & Kreatif</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <p class="text-brand-gray text-xs mb-6 flex-1">Pameran karya, instalasi, dan ekspresi kreatif mahasiswa.</p>
                        <a href="#" class="block w-full text-center py-2.5 bg-blue-50 text-brand-blue font-semibold text-xs rounded-xl hover:bg-blue-100 transition">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full">
                    <div class="bg-brand-card p-6 min-h-[160px] flex flex-col justify-start">
                        <span class="inline-block px-3 py-1 bg-white text-brand-blue text-[10px] font-bold rounded-full w-max mb-4">Lomba</span>
                        <h3 class="text-lg font-bold text-brand-text leading-snug">Kompetisi Bisnis & Kewirausahaan</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <p class="text-brand-gray text-xs mb-6 flex-1">Kompetisi ide bisnis, pitching, dan strategi entrepreneurship.</p>
                        <a href="#" class="block w-full text-center py-2.5 bg-blue-50 text-brand-blue font-semibold text-xs rounded-xl hover:bg-blue-100 transition">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full">
                    <div class="bg-brand-card p-6 min-h-[160px] flex flex-col justify-start">
                        <span class="inline-block px-3 py-1 bg-white text-brand-blue text-[10px] font-bold rounded-full w-max mb-4">Lomba</span>
                        <h3 class="text-lg font-bold text-brand-text leading-snug">Kompetisi Desain & Inovasi</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <p class="text-brand-gray text-xs mb-6 flex-1">Kompetisi konsep, prototipe, dan solusi desain berbasis kebutuhan.</p>
                        <a href="#" class="block w-full text-center py-2.5 bg-blue-50 text-brand-blue font-semibold text-xs rounded-xl hover:bg-blue-100 transition">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full">
                    <div class="bg-brand-card p-6 min-h-[160px] flex flex-col justify-start">
                        <span class="inline-block px-3 py-1 bg-white text-brand-blue text-[10px] font-bold rounded-full w-max mb-4">Lomba</span>
                        <h3 class="text-lg font-bold text-brand-text leading-snug">Kompetisi Pendidikan & Sosial</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <p class="text-brand-gray text-xs mb-6 flex-1">Kompetisi program edukasi, literasi, dan dampak sosial mahasiswa.</p>
                        <a href="#" class="block w-full text-center py-2.5 bg-blue-50 text-brand-blue font-semibold text-xs rounded-xl hover:bg-blue-100 transition">Lihat Detail</a>
                    </div>
                </div>

                <!-- Card 8 -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100 flex flex-col h-full">
                    <div class="bg-brand-card p-6 min-h-[160px] flex flex-col justify-start">
                        <span class="inline-block px-3 py-1 bg-white text-brand-blue text-[10px] font-bold rounded-full w-max mb-4">Lomba</span>
                        <h3 class="text-lg font-bold text-brand-text leading-snug">Kompetisi Olahraga & Prestasi</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <p class="text-brand-gray text-xs mb-6 flex-1">Kompetisi cabang olahraga, kebugaran, dan prestasi mahasiswa.</p>
                        <a href="#" class="block w-full text-center py-2.5 bg-blue-50 text-brand-blue font-semibold text-xs rounded-xl hover:bg-blue-100 transition">Lihat Detail</a>
                    </div>
                </div>

            </div>
        </div>

    </main>

</body>
</html>
