<?php

use App\Http\Controllers\Auth\GuruAuthController;
use App\Http\Controllers\Auth\OperatorAuthController;
use App\Http\Controllers\Auth\SiswaAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

/** Operator */
Route::middleware('multi.guard')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

/** Operator */
Route::middleware('auth:operator')->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('data-siswa', \App\Http\Controllers\DataSiswaController::class);
    Route::resource('data-guru', \App\Http\Controllers\DataGuruController::class);
    Route::resource('data-mapel', \App\Http\Controllers\MapelController::class);
    Route::resource('daftar-kelas', \App\Http\Controllers\KelasController::class);
    Route::resource('data-keuangan-siswa', \App\Http\Controllers\KeuanganController::class);
    Route::resource('pendaftaran-siswa', \App\Http\Controllers\PendaftaranSiswaController::class);

    // Setting
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings/update', [SettingController::class, 'update'])->name('settings.update');

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Logout
    Route::post('operator/logout', [OperatorAuthController::class, 'destroy'])->name('operator.logout');
});

/** Guru */
Route::middleware('auth:guru')->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Logout
    Route::post('guru/logout', [GuruAuthController::class, 'destroy'])->name('guru.logout');
});

/** Siswa */
Route::middleware('auth:siswa')->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Logout
    Route::post('siswa/logout', [SiswaAuthController::class, 'destroy'])->name('siswa.logout');
});

/** Auth */
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Routes untuk login operator
Route::middleware('guest:operator')->group(function () {
    Route::get('operator/login', [OperatorAuthController::class, 'create'])->name('operator.login');
    Route::post('operator/login', [OperatorAuthController::class, 'store'])->name('operator.login.post');
});
// Routes untuk login guru
Route::middleware('guest:guru')->group(function () {
    Route::get('guru/login', [GuruAuthController::class, 'create'])->name('guru.login');
    Route::post('guru/login', [GuruAuthController::class, 'store'])->name('guru.login.post');
});
// Routes untuk login siswa
Route::middleware('guest:siswa')->group(function () {
    Route::get('siswa/login', [SiswaAuthController::class, 'create'])->name('siswa.login');
    Route::post('siswa/login', [SiswaAuthController::class, 'store'])->name('siswa.login.post');
});


