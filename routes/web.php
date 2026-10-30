<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanWargaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ===== Halaman publik (warga) =====
Route::get('/', [LaporanWargaController::class, 'create'])->name('lapor.create');
Route::post('/lapor', [LaporanWargaController::class, 'store'])->name('lapor.store');

// ===== Halaman petugas (wajib login) =====
Route::middleware('auth')->group(function () {
    Route::resource('laporan', LaporanController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', fn () => redirect()->route('laporan.index'))
    ->middleware('auth')->name('dashboard');

require __DIR__.'/auth.php';