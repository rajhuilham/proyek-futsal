<x-layouts.app>
    {{-- Mengirim judul spesifik untuk halaman ini ke layout --}}
    <x-slot:title>Admin Dashboard</x-slot:title>

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
</x-layouts.app>