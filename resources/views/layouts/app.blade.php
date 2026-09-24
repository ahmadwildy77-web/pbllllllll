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
        
        <!-- AlpineJS CDN -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

        <!-- AOS CSS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <!-- Scripts & Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-[#1d1d1f] bg-gray-50">
        <!-- Top Navigation Bar -->
        <header x-data="{ open: false }" class="bg-white border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    
                    <!-- Left: Logo & Brand -->
                    <div class="flex items-center gap-8">
                        <!-- Logo -->
                        <div class="flex items-center gap-3 cursor-pointer">
                            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center shadow-sm">
                                <span class="text-white font-bold text-lg leading-none">S</span>
                            </div>
                            <span class="font-bold text-xl tracking-tight text-gray-900 hidden sm:block">SIREMA</span>
                        </div>

                        <!-- Desktop Navigation Links -->
                        <nav class="hidden md:flex space-x-1">
                            <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition-colors">Dashboard</a>
                            
                            <a href="/lomba" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('lomba*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition-colors">Lomba</a>
                            
                            @if(in_array(Auth::user()->role, ['koordinator', 'staf']))
                            <a href="/mahasiswa" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('mahasiswa*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition-colors">Manajemen Mahasiswa</a>
                            @endif

                            @if(Auth::user()->role === 'kaprodi')
                            <a href="/validasi" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('validasi*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition-colors">Validasi Lomba</a>
                            @endif
                            
                            @if(Auth::user()->role === 'mahasiswa')
                            <a href="/asesmen-awal" class="px-3 py-2 rounded-md text-sm font-medium {{ request()->is('asesmen-awal*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }} transition-colors">Update Nilai</a>
                            @endif

                            <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors">Bantuan</a>
                        </nav>
                    </div>

                    <!-- Right: User Profile -->
                    <div class="flex items-center gap-4">
                        <!-- Notifications -->
                        <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors rounded-full hover:bg-gray-100 hidden sm:block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>

                        <div class="h-8 w-px bg-gray-200 hidden sm:block"></div>

                        <!-- Profile Dropdown -->
                        <div class="relative z-50">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center gap-3 hover:opacity-80 transition-opacity focus:outline-none">
                                        <div class="text-right hidden sm:block">
                                            <p class="text-sm font-semibold text-gray-900 leading-tight">{{ Auth::user()->name ?? 'Dewi Lestari' }}</p>
                                            <p class="text-xs text-gray-500 font-medium tracking-wide uppercase">{{ Auth::user()->role === 'koordinator' ? 'Koordinator' : (Auth::user()->role === 'staf' ? 'Staf' : (Auth::user()->role === 'kaprodi' ? 'Kaprodi' : 'Mahasiswa')) }}</p>
                                        </div>
                                        <div class="w-10 h-10 rounded-full bg-blue-100 border border-blue-200 flex items-center justify-center text-blue-700 font-bold text-sm">
                                            {{ substr(Auth::user()->name ?? 'D', 0, 1) }}
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 hidden sm:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Profile Link -->
                                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ __('Profil') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();" class="text-red-500 hover:bg-red-50 hover:text-red-600 flex items-center gap-2 mt-1 border-t border-gray-100 pt-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            {{ __('Keluar') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        
                        <!-- Mobile Menu Button -->
                        <button @click="open = ! open" class="md:hidden p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div x-show="open" class="md:hidden border-t border-gray-200 bg-white" style="display: none;">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('dashboard') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Dashboard</a>
                    <a href="/lomba" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('lomba*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Lomba</a>
                    
                    @if(in_array(Auth::user()->role, ['koordinator', 'staf']))
                    <a href="/mahasiswa" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('mahasiswa*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Manajemen Mahasiswa</a>
                    @endif

                    @if(Auth::user()->role === 'kaprodi')
                    <a href="/validasi" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('validasi*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Validasi Lomba</a>
                    @endif
                    
                    @if(Auth::user()->role === 'mahasiswa')
                    <a href="/asesmen-awal" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('asesmen-awal*') ? 'text-blue-600 bg-blue-50' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">Update Nilai</a>
                    @endif
                    
                    <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50">Bantuan</a>
                </div>
            </div>
        </header>

        <!-- Header Slot (if any) -->
        @isset($header)
            <header class="w-full px-6 py-4 bg-white/80 backdrop-blur-md border-b border-gray-100 sticky top-[73px] z-40">
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
