<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'note' => 'required|string',
        ]);

        // Di sini Anda bisa menambahkan logika untuk mengirim email atau menyimpan ke database
        // Mail::to('admin@example.com')->send(new ContactFormMail($request->all()));

        // Arahkan kembali ke halaman kontak dengan pesan sukses
        return back()->with('success', 'Pesan Anda telah berhasil dikirim!');
    }
}