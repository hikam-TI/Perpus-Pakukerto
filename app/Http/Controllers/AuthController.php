<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $credentials['username'])
            ->orWhere('email', $credentials['username'])
            ->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['username' => 'Username / Email atau password salah'])->onlyInput('username');
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usernameBase = Str::slug(explode('@', $data['email'])[0]);
        $username = $usernameBase;
        $count = 1;

        while (User::where('username', $username)->exists()) {
            $username = $usernameBase . $count++;
        }

        $user = User::create([
            'name' => $data['name'],
            'username' => $username,
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'user',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            Log::error('Google login failed: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['google' => 'Gagal masuk dengan Google. Silakan coba lagi.']);
        }

        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            if (! empty($googleUser->getId()) && empty($user->google_id)) {
                $user->google_id = $googleUser->getId();
                $user->save();
            }
        } else {
            $usernameBase = Str::slug(explode('@', $googleUser->getEmail())[0]);
            $username = $usernameBase;
            $count = 1;

            while (User::where('username', $username)->exists()) {
                $username = $usernameBase . $count++;
            }

            $user = User::create([
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Pengguna Google',
                'username' => $username,
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(Str::random(16)),
                'role' => 'user',
                'google_id' => $googleUser->getId(),
            ]);
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
