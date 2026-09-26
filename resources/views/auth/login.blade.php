<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-900">Masuk ke SIREMA</h2>
        <p class="text-sm text-gray-500 mt-1">Masukkan email dan password Anda untuk melanjutkan</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email / NIM / NIP</label>
            <input id="email" type="text" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                class="block w-full px-3 py-2.5 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors sm:text-sm" placeholder="nama@email.com atau NIM/NIP">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password" 
                class="block w-full px-3 py-2.5 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors sm:text-sm" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                Log in
            </button>
        </div>
    </form>
</x-guest-layout>
