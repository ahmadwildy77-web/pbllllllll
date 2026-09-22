<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nim_nip' => ['required', 'string', 'max:50', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $role = 'mahasiswa';
        $email = $request->email;
        $nim_nip = $request->nim_nip;

        if (str_ends_with($email, '@staf.ac.id')) {
            $role = 'staf';
        } elseif (in_array($email, ['koor@kampus.ac.id', 'kaprodi@kampus.ac.id']) || in_array($nim_nip, ['19800101', '19700101'])) {
            $role = 'koor_kaprodi';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'nim_nip' => $nim_nip,
            'password' => Hash::make($request->password),
            'role' => $role,
            'status_akun' => 'Aktif',
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
