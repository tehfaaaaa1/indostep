<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/',[UserController::class, 'home'])->name('home');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');

Route::prefix('/destination')->name('destination.')->group(function () {
    Route::get('/', [UserController::class, 'destination'])->name('list');
});

Route::prefix('/reserve-online')->name('reservation.')->group(function () {
    Route::get('/', [UserController::class, 'reserve'])->name('reserve');
});

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/destination', [AdminController::class,'destination'])->name('destination');
    Route::get('/destination-cef/{Destination:Slug?}', [AdminController::class,'destinationCEF'])->name('destinationCEF');
    Route::get('/destination-ceb/{Destination:Slug?}', [AdminController::class,'destinationCEB'])->name('destinationCEB');
    Route::post('/create-expert', [AdminController::class,'createExpertAxios'])->name('create-expert-ax');
});
