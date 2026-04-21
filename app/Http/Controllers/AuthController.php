<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            $user = User::where('google_id', $googleUser->id)
                        ->orWhere('email', $googleUser->email)
                        ->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(str()->random(24)), // Random password for SSO users
                    'role' => 'user', // Default role
                    'foto_profil' => $googleUser->avatar,
                ]);
            } else {
                // Update google_id and avatar if they exist but weren't linked before
                $user->update([
                    'google_id' => $googleUser->id,
                    'foto_profil' => $user->foto_profil ?? $googleUser->avatar,
                ]);
            }

            Auth::login($user);
            request()->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect('/dashboardadmin')->with('success', 'Selamat datang Admin!');
            }

            return redirect('/dashboarduser')->with('success', 'Berhasil masuk dengan Google!');
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Gagal masuk menggunakan Google. Silakan coba lagi.');
        }
    }

    public function showLoginForm()
    {
        return view('auth.login&register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/dashboardadmin')->with('success', 'Selamat datang Admin!');
            }

            return redirect()->intended('/dashboarduser')->with('success', 'Berhasil masuk!');
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Pendaftaran berhasil, silakan masuk menggunakan akun Anda!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil keluar!');
    }
}
