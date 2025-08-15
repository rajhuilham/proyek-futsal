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
            <h1 class="text-2xl font-bold mb-2">Pembayaran</h1>
            <p class="text-gray-600 mb-6">Scan QR-Code berikut untuk melanjutkan pemesanan</p>

            <div>
                <img src="/img/qris.jpg" alt="QR Code Pembayaran" class="mx-auto w-64 h-64 border rounded">
            </div>

            <p class="mt-4 text-lg font-bold">Total: Rp {{ number_format($booking->price, 0, ',', '.') }}</p>

            <div class="mt-8 flex justify-between items-center">
                <a href="{{ route('booking.create') }}" class="text-gray-600 hover:text-gray-800">&larr; Kembali</a>
                <a href="{{ route('payment.confirmation', $booking) }}" class="inline-flex justify-center rounded-md bg-indigo-600 py-2 px-6 text-sm font-medium text-white hover:bg-indigo-700">
                    Lanjut
                </a>
            </div>
        </div>
    </main>
</body>
</html>