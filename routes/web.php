<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
