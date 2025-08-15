<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // Menampilkan halaman pembayaran dengan QR Code
    public function show(Jadwal $jadwal)
    {
        // Keamanan: Pastikan hanya pemesan yang bisa melihat halaman ini
        if (Auth::id() !== $jadwal->user_id) {
            abort(403, 'Akses Ditolak');
        }
        return view('payment.show', ['booking' => $jadwal]);
    }

    // Menampilkan halaman konfirmasi
    public function confirmation(Jadwal $jadwal)
    {
        if (Auth::id() !== $jadwal->user_id) {
            abort(403, 'Akses Ditolak');
        }
        return view('payment.confirmation', ['booking' => $jadwal]);
    }
}