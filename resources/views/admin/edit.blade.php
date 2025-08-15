<x-layouts.app>
    <x-slot:title>Edit Booking</x-slot:title>

    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <h1 class="text-lg font-semibold leading-6 text-gray-900">Edit Booking</h1>
        </div>
    </header>

    <main class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-lg shadow">
            <form action="{{ route('admin.sewa.update', $booking) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Pemesan</label>
                        <input type="text" value="{{ $booking->user->name }}" readonly class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="booking_date" class="block text-sm font-medium text-gray-700">Ubah Tanggal</label>
                        <input type="date" name="booking_date" id="booking_date" 
                               value="{{ \Carbon\Carbon::parse($booking->start_datetime)->format('Y-m-d') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Ubah Waktu Booking</label>
                        <input type="time" name="start_time" id="start_time" 
                               value="{{ \Carbon\Carbon::parse($booking->start_datetime)->format('H:i') }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700">Ubah Durasi Sewa (Jam)</label>
                        <select id="duration" name="duration" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @php
                                $currentDuration = \Carbon\Carbon::parse($booking->end_datetime)->diffInHours(\Carbon\Carbon::parse($booking->start_datetime));
                            @endphp
                            <option value="1" {{ $currentDuration == 1 ? 'selected' : '' }}>1 Jam</option>
                            <option value="2" {{ $currentDuration == 2 ? 'selected' : '' }}>2 Jam</option>
                            <option value="3" {{ $currentDuration == 3 ? 'selected' : '' }}>3 Jam</option>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Ubah Status</label>
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="Menunggu" {{ $booking->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="Lunas" {{ $booking->status == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                        </select>
                    </div>
                </div>

                <div class="mt-8 text-right">
                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-6 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                        Update Booking
                    </button>
                </div>
            </form>
        </div>
    </main>
</x-layouts.app>