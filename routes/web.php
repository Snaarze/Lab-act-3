<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;

Route::get('/', function () {
    return redirect()->route('registration.form');
});

// Registration Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('registration.form');
Route::post('/register', [AuthController::class, 'register'])->name('registration');

// Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Dashboard Route (Protected by auth middleware)
Route::get('/dashboard', [BlogPostController::class, 'dashboard'])->name('dashboard')->middleware('auth');

// Logout Route (Handles logout functionality)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('blog/create', [BlogPostController::class, 'create'])->name('create');
    Route::post('blog', [BlogPostController::class, 'store'])->name('store');
    Route::get('blog/{id}', [BlogPostController::class, 'show'])->name('show');
});



