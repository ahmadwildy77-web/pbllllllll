<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIREMA') }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50 flex items-center justify-center min-h-screen">
        
        <div class="w-full sm:max-w-md px-6 py-12">
            
            <!-- Logo SIREMA -->
            <div class="mb-10 text-center flex flex-col items-center">
                <a href="/" class="flex flex-col items-center gap-3">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center">
                        <span class="text-white font-bold text-2xl leading-none">S</span>
                    </div>
                    <span class="font-bold text-2xl tracking-tight text-gray-900">SIREMA</span>
                </a>
            </div>

            <!-- Login Card -->
            <div class="w-full bg-white px-8 py-10 shadow-sm border border-gray-200 rounded-2xl">
                {{ $slot }}
            </div>
            
            <!-- Footer Text -->
            <div class="mt-8 text-center">
                <p class="text-sm text-gray-500">&copy; {{ date('Y') }} SIREMA. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
