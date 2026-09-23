<div class="flex flex-col space-y-1">
    <div class="px-3 py-2 text-xs font-bold text-gray-400 uppercase tracking-wider">
        Menu Utama
    </div>
        <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-[#0066cc]/10 text-[#0066cc] font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('dashboard') ? 'text-[#0066cc]' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            {{ __('Dashboard') }}
        </a>
        <!-- We assume 'lomba.index' is the route for Lomba -->
        <a href="/lomba" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('lomba*') ? 'bg-[#0066cc]/10 text-[#0066cc] font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->is('lomba*') ? 'text-[#0066cc]' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
            {{ __('Lomba') }}
        </a>

        @if(in_array(Auth::user()->role, ['koordinator', 'staf']))
        <a href="/mahasiswa" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('mahasiswa*') ? 'bg-[#0066cc]/10 text-[#0066cc] font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->is('mahasiswa*') ? 'text-[#0066cc]' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            {{ __('Manajemen Mahasiswa') }}
        </a>
        @endif

        @if(Auth::user()->role === 'kaprodi')
        <a href="/validasi" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->is('validasi*') ? 'bg-[#0066cc]/10 text-[#0066cc] font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->is('validasi*') ? 'text-[#0066cc]' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ __('Validasi Lomba') }}
        </a>
        @endif
        
        @if(Auth::user()->role === 'mahasiswa')
        <a href="/asesmen-awal" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 text-gray-500 hover:bg-gray-50 hover:text-gray-900">
            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            {{ __('Update Nilai') }}
        </a>
        @endif
        
        <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('profile.edit') ? 'bg-[#0066cc]/10 text-[#0066cc] font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">
            <svg class="w-5 h-5 mr-3 {{ request()->routeIs('profile.edit') ? 'text-[#0066cc]' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            {{ __('Profil') }}
        </a>
    </div>

    <!-- Bottom Section / Help -->
    <div class="mt-4 px-2 pt-2 border-t border-gray-100">
        <a href="#" class="flex items-center px-4 py-2 text-xs font-medium text-gray-500 hover:bg-gray-50 rounded-xl hover:text-[#0066cc] transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Bantuan
        </a>
    </div>
</div>
