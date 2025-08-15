<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Menampilkan halaman form registrasi.
     */
    public function create()
    {
        return view('auth.register'); // Kita akan buat file ini di langkah 3
    }

    /**
     * Menerima dan memvalidasi data dari form, lalu membuat user baru.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Otomatis set role sebagai 'user' untuk pendaftar baru
        ]);

       // 3. Jangan login-kan user, tapi arahkan ke halaman login dengan pesan sukses
        return redirect('/login')->with('success', 'Akun telah berhasil dibuat! Silakan login.');
    }
}