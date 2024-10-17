<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MybookController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'login'])->name('login'); 
    Route::get('/login/register', [AuthenticatedSessionController::class, 'indexRegister'])->name('login.register'); 
    Route::post('/login/auth', [AuthenticatedSessionController::class, 'store'])->name('login.auth'); 
});

Route::middleware('auth', 'verified')->group(function () {

    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/dashboard', [BookController::class, 'adminDashboard'])->name('dashboard');

        Route::prefix('/admin')->name('admin.')->group(function () {
            Route::prefix('/daftar-buku')->name('daftar-buku.')->group(function () {
                Route::get('/', [BookController::class, 'adminIndex'])->name('index');
                Route::get('/tambah', [BookController::class, 'create'])->name('create');
                Route::post('/tambah', [BookController::class, 'store'])->name('store');
                Route::get('/edit/{id}', [BookController::class, 'edit'])->name('edit');
                Route::patch('/{id}', [BookController::class, 'update'])->name('update');
                Route::delete('/{id}', [BookController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('/kelola-akun')->name('kelola-akun.')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name('index');
                Route::get('/tambah', [UserController::class, 'create'])->name('create');
                Route::post('/', [UserController::class, 'store'])->name('store');
                Route::get('/{id}', [UserController::class, 'show'])->name('show');
                Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
                Route::patch('/{id}', [UserController::class, 'update'])->name('update');
                Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
            });

            Route::prefix('/peminjam')->name('peminjaman.')->group(function () {
                Route::get('/', [LoanController::class, 'riwayat'])->name('index');
                Route::get('/laporan', [LoanController::class, 'laporan'])->name('laporan');
            });
        });
    });
    
    Route::middleware(['isUser', 'verified'])->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/daftar-buku', [BookController::class, 'index'])->name('daftar-buku');
        Route::get('/buku-saya', [MybookController::class, 'index'])->name('buku-saya');
        Route::get('/detail-buku/{id}', [BookController::class, 'show'])->name('detail-buku');
        Route::get('/pinjam/{book_id}', [LoanController::class, 'pinjam'])->name('pinjam');
        Route::get('/kembalikan/{loan_id}', [LoanController::class, 'kembalikan'])->name('kembalikan');
        Route::get('/riwayat', [LoanController::class, 'riwayat'])->name('riwayat');
        Route::delete('/hapus-histori', [LoanController::class, 'deleteHistoryPengembalian'])->name('hapus-histori-pengembalian');
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


require __DIR__.'/auth.php';