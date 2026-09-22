<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIREMA - Sistem Rekomendasi Mahasiswa</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">
    
    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center">
                    <h1 class="text-2xl font-bold text-blue-600">SIREMA</h1>
                </div>
                <div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium mr-4">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-blue-600 py-20 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Selamat Datang di SIREMA</h1>
        <p class="text-lg md:text-xl max-w-2xl mx-auto">Sistem Pendaftaran dan Asesmen Lomba. Temukan kompetisi terbaik untuk Anda, daftar, dan raih prestasi!</p>
        @guest
            <a href="{{ route('register') }}" class="mt-8 inline-block bg-white text-blue-600 font-bold px-6 py-3 rounded-full shadow hover:bg-gray-100">Daftar Sekarang</a>
        @endguest
    </div>

    <!-- Bulletin Lomba -->
    <div class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-center mb-10">Bulletin Lomba yang Sedang Berjalan</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($lombas as $lomba)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $lomba->nama_lomba }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($lomba->deskripsi, 120) }}</p>
                    <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login untuk mendaftar &rarr;</a>
                </div>
            </div>
            @endforeach
            
            @if(count($lombas) == 0)
                <p class="text-center text-gray-500 col-span-3">Belum ada lomba yang tersedia saat ini.</p>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 text-center mt-12">
        <p>&copy; {{ date('Y') }} SIREMA. Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>
