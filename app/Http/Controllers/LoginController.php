<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // 1. Validasi
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // 3. Cek Role dan Redirect
            if ($user->role === 'admin') {
                return redirect()->intended('/admin');
            }

            // Untuk role 'user' dan 'member', arahkan ke tempat yang sama
            if (in_array($user->role, ['user', 'member'])) {
                return redirect()->intended('/home-user');
            }
            
            // Pengaman jika ada role lain
            Auth::logout();
            return redirect('/login')->withErrors(['email' => 'Role tidak valid.']);
        }

        // 4. Jika Login Gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}