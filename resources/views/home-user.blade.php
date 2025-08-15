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

<main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-white mb-6 text-center">Halo, Selamat Datang {{ Auth::user()->name }}</h1>

    <div class="flex flex-col sm:flex-row justify-center items-center gap-8 mb-8">
    
    <div class="bg-white p-6 rounded-lg shadow w-full sm:w-72 text-center">
        <p class="text-sm font-medium text-gray-500">Total Booking (Hari Ini)</p>
        <p class="mt-1 text-4xl font-bold text-indigo-700">{{ $todayBookingsCount }}</p>
    </div>

    <div class="bg-white p-6 rounded-lg shadow w-full sm:w-72 text-center">
        <p class="text-sm font-medium text-gray-500">Pengguna Aktif</p>
        <p class="mt-1 text-4xl font-bold text-indigo-700">{{ $totalUsers }}</p>
    </div>
    
    </div>

    <div class="bg-white p-6 rounded-lg shadow overflow-x-auto">
        <h2 class="text-xl font-semibold mb-4 text-gray-900 text-center">Jadwal Booking Hari Ini</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lapangan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($bookings as $booking)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $booking->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">Lapangan {{ $booking->lapangan->no_lapangan }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($booking->start_datetime)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($booking->start_datetime)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_datetime)->format('H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada booking untuk hari ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    </div>
</main>
</body>
</html>