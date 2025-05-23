<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;

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

Route::prefix('/destination')->name('destination.')->group(function () {
    Route::get('/', [UserController::class, 'destination'])->name('list');
    Route::get('/detail/{Destination:Id}', [UserController::class, 'destinationDetail'])->name('detail');
});

Route::prefix('/reserve-online')->name('reservation.')->group(function () {
    Route::get('/', [UserController::class, 'reserve'])->name('reserve');
    Route::post('/post', [UserController::class, 'reservePost'])->name('post');
});


Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/destination', [AdminController::class,'destination'])->name('destination');
    Route::get('/accomodation', [AdminController::class,'accomodation'])->name('accomodation');
    Route::get('/expert', [AdminController::class,'expert'])->name('expert');
    Route::get('/destination-cef/{Destination:Slug?}', [AdminController::class,'destinationCEF'])->name('destinationCEF');
    Route::get('/accomodation-cef/{accomodation:Slug?}', [AdminController::class,'accomodationCEF'])->name('accomodationCEF');
    Route::post('/destination-ceb/{Destination:Slug?}', [AdminController::class,'destinationCEB'])->name('destinationCEB');
    Route::post('/create-expert', [AdminController::class,'createExpertAxios'])->name('create-expert-ax');
    Route::post('/create-accomodation', [AdminController::class,'createAccomodationAxios'])->name('create-accomodation-ax');
});
