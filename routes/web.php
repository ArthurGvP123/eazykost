<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\KostController;
use App\Models\Kost;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. HALAMAN UTAMA (HOME)
Route::get('/', function () {
    $kosts = Kost::where('is_available', true)->latest()->get();
    return view('welcome', compact('kosts'));
})->name('home');


// 2. RUTE TAMU (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});


// 3. RUTE LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


// 4. RUTE PUBLIK (Detail Kost)
Route::get('/kost/{slug}', [KostController::class, 'show'])->name('kost.show');


// 5. RUTE PENGHUNI (User)
Route::middleware(['auth'])->group(function() {
    // Aksi Sewa
    Route::post('/kost/{id}/rent', [KostController::class, 'requestRent'])->name('kost.rent');
    
    // [BARU] Halaman Riwayat Pengajuan
    Route::get('/my-requests', [KostController::class, 'myRequests'])->name('my.requests');
    
    Route::get('/lapor', function() {
        return "Halaman Lapor Masalah (Coming Soon)"; 
    })->name('lapor');
});


// 6. RUTE PEMILIK (Owner)
Route::middleware(['auth', 'is_owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'index'])->name('dashboard');
    Route::get('/create', [OwnerController::class, 'create'])->name('create');
    Route::post('/store', [OwnerController::class, 'store'])->name('store');
    Route::get('/manage/{id}', [OwnerController::class, 'show'])->name('manage');
    Route::put('/update/{id}', [OwnerController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [OwnerController::class, 'destroy'])->name('destroy');
    
    // Kontak WA & Arsip
    Route::post('/request/{id}/contact', [OwnerController::class, 'markAsContacted'])->name('request.contact');
});