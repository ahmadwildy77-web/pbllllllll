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
    <body class="font-sans antialiased bg-[#f5f5f7] text-[#1d1d1f]">
        
        <!-- Top Navbar -->
        <nav class="bg-white border-b border-gray-100 sticky top-0 z-40">
            <div class="w-full px-4 sm:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Left: Logo & Dropdown Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false" class="flex items-center space-x-2 focus:outline-none group">
                            <div class="w-8 h-8 bg-gradient-to-tr from-[#0066cc] to-[#5ac8fa] rounded-lg flex items-center justify-center text-white font-bold transition-transform group-hover:scale-105">S</div>
                            <span class="font-bold text-xl tracking-tight text-gray-900 group-hover:text-[#0066cc] transition-colors">SIREMA</span>
                            <svg class="w-4 h-4 text-gray-400 transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                             class="absolute left-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 p-3 z-50 origin-top-left"
                             style="display: none;">
                            @include('layouts.navigation')
                        </div>
                    </div>

                    <!-- Right: User Profile & Role & Logout -->
                    <div class="flex items-center space-x-4 border-l border-gray-200 pl-4 ml-auto">
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-[#0066cc] flex items-center justify-center font-bold text-sm border border-blue-100">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="text-sm font-bold text-gray-900 leading-tight">{{ Auth::user()->name }}</span>
                            <span class="text-[10px] text-gray-500 font-medium uppercase tracking-wider">{{ Auth::user()->role === 'koordinator' ? 'Koordinator' : (Auth::user()->role === 'staf' ? 'Staf' : (Auth::user()->role === 'kaprodi' ? 'Kaprodi' : 'Mahasiswa')) }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="ml-4 pl-4 border-l border-gray-100">
                            @csrf
                            <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-medium flex items-center transition-colors">
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Header Slot (if any) -->
        @isset($header)
            <header class="w-full px-4 sm:px-8 py-4 bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-16 z-30">
                {{ $header }}
            </header>
        @endisset

        <!-- Page Content -->
        <main class="w-full px-4 sm:px-8 py-8">
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
