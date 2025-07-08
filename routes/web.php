<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PemasokController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\ProfileController;


// --- Auth Login, Register & Logout ---
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess'])->name('loginProcess');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('registerProcess');
// --- Auth Login, Register & Logout ---

// --- Lupa Password Manual (tanpa kode otp atau kirim link ke email) ---
// Menampilkan form input email
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');

// Memproses email dan mengarahkan ke form ganti password
Route::post('/forgot-password', [AuthController::class, 'forgotPasswordProcess'])->name('password.email');

// Menampilkan form untuk memasukkan password baru
Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');

// Memproses password baru dan menyimpannya
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
// --- Lupa Password Manual (tanpa kode otp atau kirim link ke email) ---

// --- Route yang membutuhkan autentikasi dengan role user ---
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::resource('ruang', RuangController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::resource('pemasok', PemasokController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('barang_masuk', BarangMasukController::class);
    Route::get('/profile/{id}', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/{id}/personal', [ProfileController::class, 'changePersonal'])->name('profile.changePersonal');
    Route::put('/profile/{id}/password', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
// --- Route yang membutuhkan autentikasi dengan role user ---

// --- Route yang membutuhkan autentikasi dengan role admin ---
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');
});
// --- Route yang membutuhkan autentikasi dengan role admin ---