<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        colors: {
                            apple: {
                                gray: '#f5f5f7',
                                blue: '#0066cc',
                                dark: '#1d1d1f'
                            }
                        }
                    }
                }
            }
        </script>
        
        <!-- AOS CSS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-[#1d1d1f] bg-gray-50">
        <!-- Top Navbar -->
        <header class="flex justify-between items-center w-full px-6 py-4 bg-white border-b border-gray-100 sticky top-0 z-40">
            
            <!-- Kiri: Logo SIREMA -->
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-tr from-[#0066cc] to-[#5ac8fa] text-white flex items-center justify-center rounded-lg font-bold shadow-sm">S</div>
                <div class="flex flex-col leading-tight">
                    <span class="font-bold text-lg tracking-tight">SIREMA</span>
                    <span class="text-xs text-gray-500 font-medium">Universitas</span>
                </div>
            </div>

            <!-- Kanan: Profil Mahasiswa & Tombol Logout -->
            <div class="flex items-center gap-4">
                
                <!-- Info Profil -->
                <div class="flex flex-col text-right">
                    <span class="font-bold text-sm text-gray-800">{{ Auth::user()->name ?? 'Dewi Lestari' }}</span>
                    <span class="text-[10px] text-gray-500 font-medium uppercase tracking-wider">{{ Auth::user()->role === 'koordinator' ? 'Koordinator' : (Auth::user()->role === 'staf' ? 'Staf' : (Auth::user()->role === 'kaprodi' ? 'Kaprodi' : 'Mahasiswa')) }}</span>
                </div>
                
                <!-- Avatar Inisial -->
                <div class="w-10 h-10 bg-blue-50 text-[#0066cc] flex items-center justify-center rounded-full font-bold border border-blue-100">
                    {{ substr(Auth::user()->name ?? 'D', 0, 1) }}
                </div>

                <!-- Garis Pemisah (Opsional) -->
                <div class="h-8 w-px bg-gray-200 mx-2"></div>

                <!-- Tombol Logout -->
                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm flex items-center gap-2 transition-colors">
                        Keluar
                    </button>
                </form>
                
            </div>
        </header>

        <!-- Header Slot (if any) -->
        @isset($header)
            <header class="w-full px-6 py-4 bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-16 z-30">
                {{ $header }}
            </header>
        @endisset

        <!-- Main Content Area -->
        <main class="p-6 sm:p-8 w-full max-w-7xl mx-auto min-h-screen">
            {{ $slot }}
        </main>

        <!-- AOS JS -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            AOS.init({
                once: true,
                offset: 50,
            });
        </script>
    </body>
</html>
