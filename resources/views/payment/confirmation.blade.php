<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Home - Harfelly Hall</title>
</head>
<body class="bg-gray-100" style="background-image: url('{{ asset('img/lapangan.jpg') }}'); background-size: cover; background-position: center;"\>
<nav class="bg-indigo-700 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0">
                    {{-- Icon User --}}
                    <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="font-semibold text-white">{{ Auth::user()->name }}</span>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-6">
                <a href="/home-user" class="text-gray-100 hover:text-indigo-300 font-medium">Home</a>
                <a href="/sewa-lapangan" class="text-gray-300 hover:text-indigo-300">Sewa Lapangan</a>
                <a href="/contact-user" class="text-gray-300 hover:text-indigo-300">Contact</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-300 hover:text-indigo-300">Log-out</button>
                </form>
            </div>
        </div>
    </div>
</nav>
<main class="max-w-2xl mx-auto py-10 px-4">
        <div class="bg-white p-8 rounded-lg shadow text-center">
            <h1 class="text-2xl font-bold mb-2">Konfirmasi Pembayaran</h1>
            <p class="text-gray-600 mb-6">Selamat, pembayaran Anda berhasil! Silakan kirim bukti pembayaran ke admin kami.</p>

            <div class="flex justify-center my-8">
                {{-- Ikon Ceklis --}}
                <svg class="w-24 h-24 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            @php
                // Siapkan pesan untuk WhatsApp
                $message = "Konfirmasi Pembayaran untuk Booking ID: " . $booking->id . "\n";
                $message .= "Nama: " . $booking->user->name . "\n";
                $message .= "Tanggal: " . \Carbon\Carbon::parse($booking->booking_date)->format('d/m/Y') . "\n";
                $message .= "Jam: " . \Carbon\Carbon::parse($booking->start_time)->format('H:i');
                $waLink = "https://wa.me/6283133094736?text=" . urlencode($message); // Ganti dengan nomor WA Admin
            @endphp

            <a href="{{ $waLink }}" target="_blank" class="inline-flex justify-center rounded-md bg-green-500 py-3 px-8 text-base font-medium text-white hover:bg-green-600">
                Kirim Bukti Pembayaran
            </a>
        </div>
    </main>
</body>
</html>