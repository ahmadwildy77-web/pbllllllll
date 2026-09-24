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
    <body class="font-sans antialiased bg-[#f5f5f7] text-[#1d1d1f] flex h-screen overflow-hidden">
        
        <!-- Sidebar (Left) -->
        <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between h-full flex-shrink-0 z-20">
            <!-- Top Section -->
            <div>
                <!-- App Logo -->
                <div class="h-16 flex items-center px-6 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-tr from-[#0066cc] to-[#5ac8fa] rounded-lg flex items-center justify-center text-white font-bold shadow-sm">S</div>
                        <span class="font-bold text-lg tracking-tight text-gray-900">SIREMA Universitas</span>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="p-4 space-y-1">
                    <a href="#" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-gray-500 hover:bg-[#0066cc]/10 hover:text-[#0066cc]">
                        <span class="font-semibold">HOME</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-gray-500 hover:bg-[#0066cc]/10 hover:text-[#0066cc]">
                        <span class="font-semibold">SIREMA</span>
                    </a>
                    <a href="/mahasiswa" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-gray-500 hover:bg-[#0066cc]/10 hover:text-[#0066cc]">
                        <span class="font-semibold">Mahasiswa</span>
                    </a>
                    <a href="/lomba" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-gray-500 hover:bg-[#0066cc]/10 hover:text-[#0066cc]">
                        <span class="font-semibold">LOMBA</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-gray-500 hover:bg-[#0066cc]/10 hover:text-[#0066cc]">
                        <span class="font-semibold">PRESTASI</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom Section (Logout) -->
            <div class="p-4 border-t border-gray-100 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center p-3 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors group">
                        <svg class="w-6 h-6 text-gray-500 group-hover:text-red-500 transition-colors mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <div class="text-left flex-1">
                            <div class="font-bold text-gray-900 text-sm group-hover:text-red-600 transition-colors">Keluar</div>
                            <div class="text-xs text-gray-500">Akun admin</div>
                        </div>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area (Right) -->
        <div class="flex-1 flex flex-col h-full overflow-hidden bg-[#f5f5f7]">
            
            <!-- Top Navbar (Header) -->
            <header class="h-16 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-6 sm:px-8 z-10 flex-shrink-0">
                <!-- Left: Page Title / Header Slot -->
                <div>
                    @isset($header)
                        {{ $header }}
                    @endisset
                </div>

                <!-- Right: Role Badge & Profile -->
                <div class="flex items-center space-x-6 ml-auto">
                    <!-- Role Badge -->
                    <div class="flex items-center bg-blue-50 px-3 py-1.5 rounded-full border border-blue-100">
                        <span class="text-[#0066cc] font-bold text-xs tracking-wide mr-1.5">KOOR MAHASISWA</span>
                        <svg class="w-4 h-4 text-[#0066cc]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>

                    <!-- User Profile -->
                    <div class="flex items-center space-x-3 border-l border-gray-200 pl-6">
                        <div class="flex flex-col text-right">
                            <span class="text-sm font-bold text-gray-900 leading-tight">Koordinator Mahasiswa</span>
                            <span class="text-xs text-gray-500 font-medium">Admin aktif</span>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold text-sm border border-gray-300">
                            KM
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 sm:p-8">
                {{ $slot }}
            </main>
        </div>

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
