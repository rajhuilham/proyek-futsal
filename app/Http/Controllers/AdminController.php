<?php

namespace App\Http\Controllers;

use App\Models\Jadwal; // Sesuaikan jika nama model Anda berbeda
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
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
            ->paginate(10); 

        // Kirim semua data ke view 'home-admin'
        return view('home-admin', [
            'todayBookingsCount' => $todayBookingsCount,
            'totalUsers' => $totalUsers,
            'bookings' => $bookings,
        ]);
    }
     function user()
    {
        echo "user Dashboard";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo '<a href="/logout">Logout >></a>';
    }
     function member()
    {
        echo "member Dashboard";
        echo "<h1>" . Auth::user()->name . "</h1>";
        echo '<a href="/logout">Logout >></a>';
    }
}
