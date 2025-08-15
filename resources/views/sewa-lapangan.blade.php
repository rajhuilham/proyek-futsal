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
  <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <h1 class="text-lg font-semibold leading-6 text-gray-900 text-center">Form Pemesanan Lapangan</h1>
        </div>
    </header>

    <main class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-lg shadow">
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Pemesan</label>
                        <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" readonly class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm sm:text-sm">
                    </div>

                    <div>
                        <label for="lapangan_id" class="block text-sm font-medium text-gray-700">Pilih Lapangan</label>
                        <select id="lapangan_id" name="lapangan_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="" selected disabled>-- Pilih Lapangan --</option>
                            @foreach ($lapangans as $lapangan)
                                <option value="{{ $lapangan->id }}" {{ old('lapangan_id') == $lapangan->id ? 'selected' : '' }}>
                                    Lapangan {{ $lapangan->no_lapangan }} - ({{ $lapangan->keterangan }})
                                </option>
                            @endforeach
                        </select>
                        @error('lapangan_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="booking_date" class="block text-sm font-medium text-gray-700">Tanggal Booking</label>
                        <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('booking_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Waktu Booking</label>
                        <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('start_time')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700">Durasi Sewa (Jam)</label>
                        <select id="duration" name="duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="1" {{ old('duration') == 1 ? 'selected' : '' }}>1 Jam</option>
                            <option value="2" {{ old('duration') == 2 ? 'selected' : '' }}>2 Jam</option>
                            <option value="3" {{ old('duration') == 3 ? 'selected' : '' }}>3 Jam</option>
                        </select>
                         @error('duration')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>