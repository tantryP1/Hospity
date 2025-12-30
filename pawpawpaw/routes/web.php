<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KonfirmasiController;
use App\Models\Reservation;

// PATIENT //
// 1. menuju landing page
Route::get('/', function () {
    return view('landing');
});

// 2. buat akun kalau belum punya
Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::post('/register', [AuthController::class, 'register'])->name('register');

// 3. masuk ke akun kalau sudah punya
Route::get('/loginpage', function () {
    return view('loginpage');
})->name('loginpage');

Route::post('/login', [AuthController::class, 'login'])->name('login');

// 4. berhasil login dan signup
Route::get('/homepage', function () {
    return view('homepage');
})->name('home');

// 5. melakukan reservasi
Route::get('/caridokter', function () {
    return view('caridokter');
})->name('caridokter');

// 6. tekan tombol cari dokter (sudah ada rutenya di api.php)

// 7. pesan dokter + tampilkan halaman detail
Route::get('/appointments/{appointmentId}', function ($appointmentId) {
    return view('detail', ['appointmentId' => $appointmentId]);
});

// 8. buat feedback
Route::get('/feedback', function () {
    return view('feedback');
})->name('feedback');

// 9. ke halaman konfirmasi
Route::get('/konfirmasi/{id}', [KonfirmasiController::class, 'show'])->name('konfirmasi.show');

// 10. rute QR Code
Route::get('/qr/{id}', function ($id) {
    $reservation = Reservation::findOrFail($id);
    return view('qr', ['id' => $reservation->id_reservation]);
});

// 11. rute Countdown
Route::get('/countdown/{id}', function ($id_reservation) {
    $reservation = Reservation::findOrFail($id_reservation);
    return view('countdown', ['reservation' => $reservation]);
});

// ADMIN
// 12. berhasil login
Route::get('/admindashboard', function () {
    return view('admindashboard');
})->name('admindashboard');

// 13. ngedit
Route::get('/edit/{id}', function ($id) {
    return view('edit', ['id' => $id]);
});

// DOKTER
// 14. berhasil login
Route::get('/doctordashboard', function () {
    return view('doctordashboard');
})->name('doctordashboard');

Route::get('/pengelolaan', function () {
    return view('pengelolaan');
})->name('pengelolaan');