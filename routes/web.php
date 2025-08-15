<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/service', function () {
    return view('service', ['title' => 'Service']);
});

// routes/web.php
use App\Http\Controllers\ContactController;

// Route yang sudah ada untuk menampilkan halaman kontak
Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

// TAMBAHKAN ROUTE INI untuk memproses data form
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/home-user', function () {
    return view('home-user');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('/login', [App\Http\Controllers\LoginController::class, 'login']);
});
Route::get('/home', function () {
    return redirect('/admin');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
    Route::get('/admin/user', [App\Http\Controllers\AdminController::class, 'user']);
    Route::get('/admin/member', [App\Http\Controllers\AdminController::class, 'member']);
    Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout']);
});

use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/'); // Arahkan ke halaman utama setelah logout
})->name('logout'); // Memberi nama 'logout' pada route ini

use App\Http\Controllers\HomeController;

Route::get('/home-user', [HomeController::class, 'index'])
    ->middleware(['auth']) // Melindungi halaman, hanya untuk user yang login
    ->name('home-user');

use App\Http\Controllers\BookingController;

// Route untuk menampilkan halaman form sewa
Route::get('/sewa-lapangan', [BookingController::class, 'create'])
    ->middleware(['auth'])
    ->name('booking.create');

// Route untuk memproses data dari form sewa
Route::post('/sewa-lapangan', [BookingController::class, 'store'])
    ->middleware(['auth'])
    ->name('booking.store');
// Route untuk menampilkan contact user
Route::get('/contact-user', function () {
    return view('contact-user');
});
// routes/web.php
use App\Http\Controllers\AdminController;
// Gunakan grup untuk semua route admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Route untuk dashboard admin (yang sudah ada)
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');

    // Route BARU untuk halaman kelola sewa
    Route::get('/kelola-sewa', [BookingController::class, 'index'])->name('admin.sewa');
    // Route untuk menghapus data booking
    Route::delete('/kelola-sewa/{jadwal}', [BookingController::class, 'destroy'])->name('admin.sewa.destroy');

    // Route untuk menampilkan form edit
    Route::get('/kelola-sewa/{jadwal}/edit', [BookingController::class, 'edit'])->name('admin.sewa.edit');

    // Route untuk memproses update
    Route::put('/kelola-sewa/{jadwal}', [BookingController::class, 'update'])->name('admin.sewa.update');
});

// routes/web.php -> di dalam Route::middleware(['auth', 'admin'])->group(...)
use App\Http\Controllers\Admin\MemberController;

// Route BARU untuk halaman kelola member
// Ganti Route::get('/members', ...) dengan ini:
Route::resource('/kelola-member', MemberController::class)
     ->parameters(['kelola-member' => 'member']) // <-- TAMBAHKAN BARIS INI
     ->names('admin.member');

// routes/web.php
use App\Http\Controllers\PaymentController;

Route::middleware(['auth'])->group(function () {
    // Route untuk menampilkan halaman QR Code
    Route::get('/pembayaran/{jadwal}', [PaymentController::class, 'show'])->name('payment.show');
    
    // Route untuk menampilkan halaman konfirmasi
    Route::get('/konfirmasi/{jadwal}', [PaymentController::class, 'confirmation'])->name('payment.confirmation');
});