<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/login', function () {
    return Inertia::render('Auth/Login');
})->name('login');
Route::get('/register', function () {
    return Inertia::render('Auth/Register');
})->name('register');
Route::post('/login/check', [LoginController::class, 'authenticate'])->name('login.post');
Route::post('/register/check', [LoginController::class, 'register'])->name('register.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');
Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');
Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::prefix('/destination')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Destination/Index');
    })->name('destination');
});

Route::prefix('/reserve-online')->group(function () {
    Route::get('/', function () {
        return Inertia::render('Reservation/Form');
    })->name('reserve');
});
