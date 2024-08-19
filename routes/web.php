<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

/** Dashboard */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('data-siswa', \App\Http\Controllers\DataSiswaController::class);
});

/** Auth */
Route::middleware('guest')->group(function () {
    Route::get('/operator/login', [\App\Http\Controllers\Auth\OperatorAuthController::class, 'create'])->name('login');
    Route::post('/operator/login', [\App\Http\Controllers\Auth\OperatorAuthController::class, 'store']);
});
Route::get('/siswa/login', function () {
    return view('auth.siswa.login');
});
Route::get('/guru/login', function () {
    return view('auth.login');
});
Route::middleware('auth')->group(function () {
    Route::delete('logout', [\App\Http\Controllers\Auth\AuthenticatedController::class, 'destroy'])->name('logout');
});
// Route::get('/operator/login', function () {
//     return view('auth.operator.login');
// });
