<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIREMA') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

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
    <!-- Background aplikasi dibuat abu-abu sangat terang sesuai panduan warna -->
    <body class="font-sans antialiased text-slate-800 bg-slate-50 relative overflow-x-hidden min-h-screen selection:bg-blue-200 selection:text-blue-900">
        
        <!-- Decorative Ambient Background -->
        <div class="fixed inset-0 z-[-1] pointer-events-none overflow-hidden bg-slate-50">
            <!-- Blur biru di kiri atas -->
            <div class="absolute -top-[10%] -left-[10%] w-[500px] h-[500px] rounded-full bg-blue-400/20 blur-[120px]"></div>
            <!-- Blur indigo di kanan bawah -->
            <div class="absolute -bottom-[10%] -right-[5%] w-[600px] h-[600px] rounded-full bg-indigo-300/20 blur-[120px]"></div>
            <!-- Blur emerald di kanan atas -->
            <div class="absolute top-[15%] right-[10%] w-[400px] h-[400px] rounded-full bg-emerald-200/20 blur-[100px]"></div>
            
            <!-- Pattern grid halus (Dot pattern) -->
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMiIgY3k9IjIiIHI9IjEiIGZpbGw9InJnYmEoMCwwLDAsMC4wNCkiLz48L3N2Zz4=')] [mask-image:linear-gradient(to_bottom,white_20%,transparent_80%)]"></div>
        </div>

        <!-- Top Navigation Bar (Glassmorphism & Centered Layout) -->
        @if(!(request()->routeIs('asesmen_awal.create') && !(Auth::user()->is_assessed ?? false)))
        <header x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-gray-200/60 shadow-[0_4px_30px_rgba(0,0,0,0.02)] sticky top-0 z-50 transition-all duration-300">
            <!-- Container dibentangkan penuh ke ujung layar dengan margin proporsional -->
            <div class="max-w-full px-6 md:px-12 lg:px-16">
                <div class="flex justify-between items-center h-20 relative">
                    
                    <!-- Left: Logo & Brand (Mentok Kiri) -->
                    <div class="flex items-center gap-3 cursor-pointer shrink-0 w-1/4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform">
                            <span class="text-white font-extrabold text-xl leading-none">S</span>
                        </div>
                        <span class="font-extrabold text-2xl tracking-tight text-slate-800 hidden sm:block">SIREMA</span>
                    </div>

                    <!-- Center: Navigation Links -->
                    <nav class="hidden md:flex flex-1 justify-center items-center gap-4 lg:gap-8">
                        <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-full text-base font-semibold transition-all duration-300 {{ request()->routeIs('dashboard') ? 'text-blue-700 bg-blue-50' : 'text-slate-500 hover:text-blue-700 hover:bg-blue-50/80' }}">Dashboard</a>
                        
                        <a href="/lomba" class="px-6 py-3 rounded-full text-base font-semibold transition-all duration-300 {{ request()->is('lomba*') ? 'text-blue-700 bg-blue-50' : 'text-slate-500 hover:text-blue-700 hover:bg-blue-50/80' }}">Lomba</a>
                        
                        @if(in_array(Auth::user()->role ?? '', ['koordinator', 'staf']))
                        <a href="/mahasiswa" class="px-6 py-3 rounded-full text-base font-semibold transition-all duration-300 {{ request()->is('mahasiswa*') ? 'text-blue-700 bg-blue-50' : 'text-slate-500 hover:text-blue-700 hover:bg-blue-50/80' }}">Mahasiswa</a>
                        @endif

                        @if((Auth::user()->role ?? '') === 'kaprodi')
                        <a href="/validasi" class="px-6 py-3 rounded-full text-base font-semibold transition-all duration-300 {{ request()->is('validasi*') ? 'text-blue-700 bg-blue-50' : 'text-slate-500 hover:text-blue-700 hover:bg-blue-50/80' }}">Validasi Lomba</a>
                        @endif
                        
                        @if((Auth::user()->role ?? '') === 'mahasiswa')
                        <a href="/asesmen-awal" class="px-6 py-3 rounded-full text-base font-semibold transition-all duration-300 {{ request()->is('asesmen-awal*') ? 'text-blue-700 bg-blue-50' : 'text-slate-500 hover:text-blue-700 hover:bg-blue-50/80' }}">Update Nilai</a>
                        @endif

                        <a href="{{ route('bantuan') }}" class="px-6 py-3 rounded-full text-base font-semibold transition-all duration-300 {{ request()->routeIs('bantuan') ? 'text-blue-700 bg-blue-50' : 'text-slate-500 hover:text-blue-700 hover:bg-blue-50/80' }}">Bantuan</a>
                    </nav>

                    <!-- Right: User Profile & Notification (Mentok Kanan) -->
                    <div class="flex items-center justify-end gap-6 shrink-0 w-1/4">
                        <!-- Notifications Dropdown -->
                        <div x-data="{ open: false }" class="relative hidden sm:block">
                            @php
                                $unreadCount = Auth::user()->unreadNotifications->count() ?? 0;
                            @endphp
                            <button @click="open = !open" @click.outside="open = false" class="relative p-2.5 text-slate-400 hover:text-blue-600 transition-all duration-300 rounded-full hover:bg-blue-50 group focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                @if($unreadCount > 0)
                                <!-- Red indicator dot -->
                                <span class="absolute top-2.5 right-2.5 w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-white"></span>
                                @endif
                            </button>

                            <!-- Dropdown Content -->
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200" 
                                 x-transition:enter-start="opacity-0 scale-95" 
                                 x-transition:enter-end="opacity-100 scale-100" 
                                 x-transition:leave="transition ease-in duration-75" 
                                 x-transition:leave-start="opacity-100 scale-100" 
                                 x-transition:leave-end="opacity-0 scale-95" 
                                 class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-slate-100 py-3 z-50"
                                 style="display: none;">
                                <div class="px-4 pb-2 border-b border-slate-100 flex justify-between items-center mb-2">
                                    <h3 class="font-bold text-slate-800">Notifikasi</h3>
                                    @if($unreadCount > 0)
                                    <form action="{{ route('notifications.readAll') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 font-medium">Tandai sudah dibaca</button>
                                    </form>
                                    @endif
                                </div>
                                
                                @if($unreadCount > 0)
                                <div class="max-h-64 overflow-y-auto">
                                    @foreach(Auth::user()->unreadNotifications as $notification)
                                    <div class="px-4 py-3 hover:bg-slate-50 transition border-b border-slate-50 last:border-0">
                                        <p class="text-sm text-slate-800 font-medium mb-1">{{ $notification->data['message'] ?? 'Status diperbarui' }}</p>
                                        <span class="text-[10px] text-slate-400">{{ $notification->created_at->diffForHumans() }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                @else
                                <div class="px-4 py-6 text-center text-slate-500 text-sm">
                                    <svg class="w-12 h-12 text-slate-200 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    <p>Belum ada notifikasi baru.</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="h-8 w-px bg-gray-200 hidden sm:block"></div>

                        <!-- Profile Dropdown -->
                        <div class="relative z-50">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <!-- Menambahkan efek hover scale pada avatar dan ring border -->
                                    <button class="flex items-center gap-3 transition-all duration-300 focus:outline-none group">
                                        <div class="text-right hidden sm:block">
                                            <p class="text-sm font-bold text-slate-800 leading-tight">{{ Auth::user()->name ?? 'Dewi Lestari' }}</p>
                                            <p class="text-[11px] text-slate-500 font-bold tracking-wider uppercase mt-0.5">{{ (Auth::user()->role ?? '') === 'koordinator' ? 'Koordinator' : ((Auth::user()->role ?? '') === 'staf' ? 'Staf' : ((Auth::user()->role ?? '') === 'kaprodi' ? 'Kaprodi' : 'Mahasiswa')) }}</p>
                                        </div>
                                        <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-sm ring-2 ring-transparent group-hover:ring-blue-300 group-hover:scale-105 transition-all duration-300">
                                            {{ substr(Auth::user()->name ?? 'D', 0, 1) }}
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2 py-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ __('Profil Saya') }}
                                    </x-dropdown-link>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();" class="text-rose-600 hover:bg-rose-50 flex items-center gap-2 mt-1 border-t border-gray-100 pt-2 pb-2">
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
                        <button @click="open = ! open" class="md:hidden p-2 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 focus:outline-none transition-colors">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div x-show="open" class="md:hidden border-t border-gray-100 bg-white shadow-lg" style="display: none;">
                <div class="px-4 pt-4 pb-6 space-y-2">
                    <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->routeIs('dashboard') ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-blue-700 hover:bg-blue-50' }}">Dashboard</a>
                    <a href="/lomba" class="block px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->is('lomba*') ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-blue-700 hover:bg-blue-50' }}">Lomba</a>
                    
                    @if(in_array(Auth::user()->role ?? '', ['koordinator', 'staf']))
                    <a href="/mahasiswa" class="block px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->is('mahasiswa*') ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-blue-700 hover:bg-blue-50' }}">Manajemen Mahasiswa</a>
                    @endif

                    @if((Auth::user()->role ?? '') === 'kaprodi')
                    <a href="/validasi" class="block px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->is('validasi*') ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-blue-700 hover:bg-blue-50' }}">Validasi Lomba</a>
                    @endif
                    
                    <a href="{{ route('bantuan') }}" class="block px-4 py-3 rounded-xl text-base font-medium transition-colors {{ request()->routeIs('bantuan') ? 'text-blue-700 bg-blue-50' : 'text-slate-600 hover:text-blue-700 hover:bg-blue-50' }}">Bantuan</a>
                </div>
            </div>
        </header>
        @endif

        <!-- 
        ==========================================================================
        INSTRUKSI PENGHAPUSAN JUDUL HALAMAN (PAGE TITLE) LAMA
        ==========================================================================
        Slot Header (Judul Halaman seperti 'Dashboard Kaprodi') di bawah navbar 
        TELAH DIHAPUS SEPENUHNYA sesuai permintaan untuk membuat tampilan lebih bersih.
        Anda tidak perlu lagi mem-passing <x-slot name="header"> dari file view Anda,
        atau jika masih ada di file view, slot tersebut akan otomatis diabaikan.
        ==========================================================================
        -->

        <!-- Main Content Area -->
        <!-- Menyelaraskan padding dan bentangan penuh dengan Navbar -->
        <main class="w-full max-w-full px-6 md:px-12 lg:px-16 min-h-screen pt-8 pb-12">
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
