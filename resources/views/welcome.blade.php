<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIREMA - Sistem Rekomendasi Mahasiswa</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />

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
                            blue: '#4f46e5',
                            indigo: '#4338ca',
                            light: '#f8fafc',
                            card: 'rgba(255, 255, 255, 0.7)',
                            text: '#0f172a',
                            gray: '#64748b',
                            accent: '#38bdf8'
                        }
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.65);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px -10px rgba(79, 70, 229, 0.15);
        }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-image: linear-gradient(to right, #4f46e5, #38bdf8);
        }
    </style>
</head>
<body class="font-sans antialiased text-brand-text bg-slate-50 relative overflow-x-hidden min-h-screen selection:bg-brand-blue selection:text-white">

    <!-- Animated Background Blobs -->
    <div class="fixed inset-0 w-full h-full z-[-1] overflow-hidden">
        <div class="absolute top-0 -left-4 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-4 w-96 h-96 bg-brand-accent rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob" style="animation-delay: 2s;"></div>
        <div class="absolute -bottom-8 left-20 w-96 h-96 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob" style="animation-delay: 4s;"></div>
    </div>
    
    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-all duration-300 glass border-b-0 shadow-sm top-0">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 h-20 flex items-center justify-between">
            <!-- Logo area -->
            <div class="flex items-center space-x-4 cursor-pointer hover:opacity-80 transition-opacity">
                <div class="w-12 h-12 bg-gradient-to-br from-brand-blue to-brand-accent rounded-xl flex items-center justify-center text-white font-bold text-2xl shadow-lg shadow-brand-blue/30">S</div>
                <div class="flex flex-col">
                    <span class="font-extrabold text-2xl text-brand-text leading-none mb-1 tracking-tight">SIREMA</span>
                    <span class="text-xs text-brand-gray font-semibold leading-none tracking-wider uppercase">Sistem Rekomendasi</span>
                </div>
            </div>

            <!-- Action -->
            <div>
                <a href="{{ route('login') }}" class="px-8 py-3 bg-white border border-gray-200 rounded-full text-sm font-semibold text-brand-text hover:text-brand-blue hover:border-brand-blue hover:shadow-md transition-all duration-300 flex items-center gap-2">
                    Masuk
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="max-w-7xl mx-auto px-6 sm:px-8 pt-36 pb-24">
        
        <div class="text-center max-w-4xl mx-auto mb-24 opacity-0 animate-fade-in-up">
            
            <h1 class="text-5xl md:text-7xl leading-tight font-extrabold text-brand-text mb-8 tracking-tight">
                Temukan <span class="text-gradient">Potensi</span> & Raih Prestasi
            </h1>
            
            <p class="text-lg md:text-xl text-brand-gray max-w-2xl mx-auto font-medium leading-relaxed mb-10">
                SIREMA memandu Anda menemukan peluang kompetisi terbaik berdasarkan minat, kemampuan, dan bakat di bidang akademik maupun non-akademik.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('login') }}" class="px-8 py-4 bg-brand-blue text-white rounded-full font-bold text-lg hover:bg-brand-indigo hover:shadow-lg hover:shadow-brand-blue/30 transition-all duration-300 transform hover:-translate-y-1 w-full sm:w-auto">
                    Mulai Sekarang
                </a>
                <a href="#lomba" class="px-8 py-4 bg-white text-brand-text border border-gray-200 rounded-full font-bold text-lg hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 w-full sm:w-auto flex items-center justify-center gap-2">
                    Eksplor Lomba
                </a>
            </div>
        </div>

        <!-- Prestasi Terbaru -->
        <div class="glass rounded-3xl p-1 md:p-2 mb-32 opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="bg-white/50 rounded-[1.75rem] p-8 md:p-12 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-64 h-64 bg-brand-accent/10 rounded-full blur-3xl"></div>
                <div class="relative z-10 flex flex-col lg:flex-row gap-10 items-center">
                    
                    <div class="lg:w-1/3 text-left">
                        <h2 class="text-3xl font-extrabold text-brand-text mb-4">Prestasi Inspiratif</h2>
                        <p class="text-brand-gray font-medium leading-relaxed mb-6">Jelajahi dan temukan peluang luar biasa. Kompetisi bukan sekadar ajang unjuk gigi, melainkan langkah nyata menuju kesuksesan di masa depan.</p>
                        <a href="#lomba" class="inline-flex items-center px-5 py-2.5 bg-white border border-gray-200 text-brand-blue rounded-xl text-sm font-bold hover:shadow-md transition-shadow">
                            Jelajahi Kategori Lomba
                        </a>
                    </div>
                    
                    <!-- Modified to not be a giant blue block, using a cleaner glass style -->
                    <div class="lg:w-2/3 w-full">
                        <div class="bg-white/80 backdrop-blur-md rounded-2xl p-8 border border-white/60 shadow-lg shadow-brand-blue/5 hover:-translate-y-1 transition-transform duration-300">
                            <span class="inline-block px-4 py-1.5 bg-blue-50 text-brand-blue text-xs font-extrabold rounded-full mb-4">
                                LOMBA AKADEMIK
                            </span>
                            <h3 class="text-2xl font-bold text-brand-text mb-3">Kompetisi Riset Mahasiswa Nasional</h3>
                            <p class="text-brand-gray mb-6 leading-relaxed">Menampilkan inovasi gemilang dari mahasiswa seluruh Indonesia, mendorong kolaborasi riset antar perguruan tinggi untuk menciptakan solusi nyata bagi masa depan yang lebih baik.</p>
                            <a href="#" class="inline-flex items-center text-sm font-bold text-brand-blue hover:text-brand-indigo transition-colors group">
                                Baca selengkapnya 
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lomba Terkini -->
        <div id="lomba" class="opacity-0 animate-fade-in-up" style="animation-delay: 0.4s;">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-extrabold text-brand-text mb-4">Kategori Lomba</h2>
                <p class="text-brand-gray font-medium max-w-2xl mx-auto">Eksplorasi berbagai bidang kompetisi yang sesuai dengan minat dan kemampuan Anda.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="glass rounded-3xl overflow-hidden card-hover group flex flex-col h-full">
                    <div class="p-6 h-40 bg-gradient-to-br from-blue-50 to-indigo-50 flex flex-col justify-between border-b border-white/50">
                        <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-brand-blue mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-brand-text">Riset Mahasiswa</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col bg-white/40">
                        <p class="text-brand-gray text-sm mb-6 flex-1 line-clamp-3">Pameran inovasi, presentasi, dan kolaborasi riset antar perguruan tinggi.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full py-3 bg-white text-brand-text border border-gray-100 font-semibold text-sm rounded-xl group-hover:bg-brand-blue group-hover:text-white group-hover:border-transparent transition-all duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="glass rounded-3xl overflow-hidden card-hover group flex flex-col h-full">
                    <div class="p-6 h-40 bg-gradient-to-br from-blue-50 to-indigo-50 flex flex-col justify-between border-b border-white/50">
                        <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-brand-blue mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-brand-text">Debat & Diplomasi</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col bg-white/40">
                        <p class="text-brand-gray text-sm mb-6 flex-1 line-clamp-3">Kompetisi wacana, negosiasi, dan strategi diplomasi mahasiswa.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full py-3 bg-white text-brand-text border border-gray-100 font-semibold text-sm rounded-xl group-hover:bg-brand-blue group-hover:text-white group-hover:border-transparent transition-all duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="glass rounded-3xl overflow-hidden card-hover group flex flex-col h-full">
                    <div class="p-6 h-40 bg-gradient-to-br from-blue-50 to-indigo-50 flex flex-col justify-between border-b border-white/50">
                        <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-brand-blue mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-brand-text">Hackathon Teknologi</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col bg-white/40">
                        <p class="text-brand-gray text-sm mb-6 flex-1 line-clamp-3">Kompetisi pengembangan solusi digital dan inovasi teknologi.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full py-3 bg-white text-brand-text border border-gray-100 font-semibold text-sm rounded-xl group-hover:bg-brand-blue group-hover:text-white group-hover:border-transparent transition-all duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="glass rounded-3xl overflow-hidden card-hover group flex flex-col h-full">
                    <div class="p-6 h-40 bg-gradient-to-br from-blue-50 to-indigo-50 flex flex-col justify-between border-b border-white/50">
                        <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-brand-blue mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-brand-text">Seni & Kreatif</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col bg-white/40">
                        <p class="text-brand-gray text-sm mb-6 flex-1 line-clamp-3">Pameran karya, instalasi, dan ekspresi kreatif mahasiswa.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full py-3 bg-white text-brand-text border border-gray-100 font-semibold text-sm rounded-xl group-hover:bg-brand-blue group-hover:text-white group-hover:border-transparent transition-all duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="glass rounded-3xl overflow-hidden card-hover group flex flex-col h-full">
                    <div class="p-6 h-40 bg-gradient-to-br from-blue-50 to-indigo-50 flex flex-col justify-between border-b border-white/50">
                        <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-brand-blue mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-brand-text">Bisnis & Wirausaha</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col bg-white/40">
                        <p class="text-brand-gray text-sm mb-6 flex-1 line-clamp-3">Kompetisi ide bisnis, pitching, dan strategi entrepreneurship.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full py-3 bg-white text-brand-text border border-gray-100 font-semibold text-sm rounded-xl group-hover:bg-brand-blue group-hover:text-white group-hover:border-transparent transition-all duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="glass rounded-3xl overflow-hidden card-hover group flex flex-col h-full">
                    <div class="p-6 h-40 bg-gradient-to-br from-blue-50 to-indigo-50 flex flex-col justify-between border-b border-white/50">
                        <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-brand-blue mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-brand-text">Desain & Inovasi</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col bg-white/40">
                        <p class="text-brand-gray text-sm mb-6 flex-1 line-clamp-3">Kompetisi konsep, prototipe, dan solusi desain berbasis kebutuhan.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full py-3 bg-white text-brand-text border border-gray-100 font-semibold text-sm rounded-xl group-hover:bg-brand-blue group-hover:text-white group-hover:border-transparent transition-all duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="glass rounded-3xl overflow-hidden card-hover group flex flex-col h-full">
                    <div class="p-6 h-40 bg-gradient-to-br from-blue-50 to-indigo-50 flex flex-col justify-between border-b border-white/50">
                        <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-brand-blue mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-brand-text">Pendidikan & Sosial</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col bg-white/40">
                        <p class="text-brand-gray text-sm mb-6 flex-1 line-clamp-3">Kompetisi program edukasi, literasi, dan dampak sosial mahasiswa.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full py-3 bg-white text-brand-text border border-gray-100 font-semibold text-sm rounded-xl group-hover:bg-brand-blue group-hover:text-white group-hover:border-transparent transition-all duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <!-- Card 8 -->
                <div class="glass rounded-3xl overflow-hidden card-hover group flex flex-col h-full">
                    <div class="p-6 h-40 bg-gradient-to-br from-blue-50 to-indigo-50 flex flex-col justify-between border-b border-white/50">
                        <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center text-brand-blue mb-4 group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-brand-text">Olahraga & Prestasi</h3>
                    </div>
                    <div class="p-6 flex-1 flex flex-col bg-white/40">
                        <p class="text-brand-gray text-sm mb-6 flex-1 line-clamp-3">Kompetisi cabang olahraga, kebugaran, dan prestasi mahasiswa.</p>
                        <a href="#" class="inline-flex items-center justify-center w-full py-3 bg-white text-brand-text border border-gray-100 font-semibold text-sm rounded-xl group-hover:bg-brand-blue group-hover:text-white group-hover:border-transparent transition-all duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- Footer -->
        <div class="mt-24 border-t border-gray-200/50 pt-8 text-center text-sm text-brand-gray opacity-0 animate-fade-in-up" style="animation-delay: 0.6s;">
            &copy; {{ date('Y') }} SIREMA - Sistem Rekomendasi Mahasiswa. All rights reserved.
        </div>

    </main>

    <!-- Script for scroll animations -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-fade-in-up');
                        entry.target.style.opacity = 1;
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            const elements = document.querySelectorAll('.opacity-0');
            elements.forEach(el => observer.observe(el));
            
            // Navbar blur effect on scroll
            const navbar = document.querySelector('nav');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 10) {
                    navbar.classList.add('shadow-md');
                    navbar.classList.replace('bg-white/50', 'bg-white/70');
                } else {
                    navbar.classList.remove('shadow-md');
                    navbar.classList.replace('bg-white/70', 'bg-white/50');
                }
            });
        });
    </script>
</body>
</html>
