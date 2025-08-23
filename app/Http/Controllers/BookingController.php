<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Lapangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Menampilkan semua data booking (halaman admin).
     */
    public function index(Request $request) // Tambahkan Request $request
    {
        // Ambil tanggal dari input filter, jika tidak ada, gunakan tanggal hari ini
        $selectedDate = $request->input('tanggal', Carbon::today()->toDateString());

        $bookings = Jadwal::with(['user', 'lapangan'])
            // Filter berdasarkan tanggal yang dipilih
            ->whereDate('start_datetime', $selectedDate)
            ->orderBy('start_datetime', 'asc') // Urutkan dari jam terawal
            ->paginate(10)
            ->withQueryString(); // Agar pagination tetap membawa filter tanggal

        // Kirim data booking dan tanggal yang dipilih ke view
        return view('kelola-sewa', [
            'bookings' => $bookings,
            'selectedDate' => $selectedDate
        ]);
    }

    /**
     * Menampilkan form pemesanan untuk user.
     */
    public function create()
    {
        $lapangans = Lapangan::all();
        return view('sewa-lapangan', ['lapangans' => $lapangans]);
    }

    /**
     * Menyimpan data booking baru dari form user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'lapangan_id' => ['required', 'exists:lapangans,id'],
            'booking_date' => ['required', 'date', 'after_or_equal:today'],
            'start_time' => ['required'],
            'duration' => ['required', 'integer', 'min:1'],
        ]);

        $startDateTime = Carbon::parse($request->booking_date . ' ' . $request->start_time);
        $user = Auth::user();
        $durationHours = (int)$request->duration;
        
        if ($user->role === 'member') {
            $endDateTime = $startDateTime->copy()->addHours($durationHours)->addMinutes(15);
            $price = 0;
            $status = 'Lunas';
        } else {
            $endDateTime = $startDateTime->copy()->addHours($durationHours);
            $price = 150000 * $durationHours;
            $status = 'Menunggu';
        }

        $existingBooking = Jadwal::where('lapangan_id', $request->lapangan_id)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->where('start_datetime', '<', $endDateTime)
                      ->where('end_datetime', '>', $startDateTime);
            })->exists();

        if ($existingBooking) {
            return back()->withErrors(['start_time' => 'Jadwal di jam ini sudah dibooking.'])->withInput();
        }

        $booking = Jadwal::create([
            'user_id' => $user->id,
            'lapangan_id' => $request->lapangan_id,
            'start_datetime' => $startDateTime,
            'end_datetime' => $endDateTime,
            'price' => $price,
            'status' => $status,
        ]);

        if ($user->role === 'member') {
            return redirect()->route('home-user')->with('success', 'Booking berhasil! Anda mendapat tambahan waktu 15 menit.');
        } else {
            return redirect()->route('payment.show', $booking);
        }
    }

    /**
     * Menampilkan form edit booking untuk admin.
     */
    public function edit(Jadwal $jadwal)
    {
        return view('admin.edit', ['booking' => $jadwal]);
    }

    /**
     * Memperbarui data booking dari form admin.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        $request->validate([
            'booking_date' => ['required', 'date'],
            'start_time' => ['required'],
            'duration' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'string', 'in:Menunggu,Lunas'],
        ]);

        $startDateTime = Carbon::parse($request->booking_date . ' ' . $request->start_time);
        $endDateTime = $startDateTime->copy()->addHours((int)$request->duration);

        $existingBooking = Jadwal::where('lapangan_id', $jadwal->lapangan_id)
            ->where('id', '!=', $jadwal->id)
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                $query->where('start_datetime', '<', $endDateTime)
                      ->where('end_datetime', '>', $startDateTime);
            })->exists();

        if ($existingBooking) {
            return back()->withErrors(['start_time' => 'Jadwal baru bentrok dengan booking lain.'])->withInput();
        }

        $jadwal->update([
            'status' => $request->status,
            'start_datetime' => $startDateTime,
            'end_datetime' => $endDateTime,
            'price' => 150000 * (int)$request->duration,
        ]);

        return redirect()->route('admin.sewa')->with('success', 'Data booking berhasil diperbarui.');
    }

    /**
     * Menghapus data booking.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('admin.sewa')->with('success', 'Data booking berhasil dihapus.');
    }
}