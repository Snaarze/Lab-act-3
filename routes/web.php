<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Registration Routes
Route::get('/register', [AuthController::class, 'registration'])->name('registration.form');
Route::post('/register', [AuthController::class, 'registration'])->name('registration');

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Dashboard Route (Protected by auth middleware)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Logout Route (Handles logout functionality)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


