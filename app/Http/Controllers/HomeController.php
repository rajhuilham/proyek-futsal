<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Menghitung total booking untuk hari ini menggunakan kolom 'start_datetime'
        $todayBookingsCount = Jadwal::whereDate('start_datetime', Carbon::today())->count();

        // Menghitung total semua pengguna terdaftar
        $totalUsers = User::count();

        // Mengambil daftar booking untuk hari ini menggunakan kolom 'start_datetime'
        $bookings = Jadwal::with(['user', 'lapangan'])
            ->whereDate('start_datetime', Carbon::today())
            ->orderBy('start_datetime', 'asc') // Urutkan berdasarkan datetime
            ->paginate(4);

        // Kirim semua data ke view
        return view('home-user', [
            'todayBookingsCount' => $todayBookingsCount,
            'totalUsers' => $totalUsers,
            'bookings' => $bookings,
        ]);
    }
}