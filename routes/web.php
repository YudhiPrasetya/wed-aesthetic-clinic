<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::livewire('/', 'pages::index')->name('index');

Route::livewire('/login', 'pages::auth.login')->name('login');
Route::livewire('/logout', 'logout')->name('logout');


Route::middleware(['auth'])->group(function(){
    // booking routes
    Route::livewire('/booking', 'pages::booking.list')->middleware('permission:Booking-list')->name('Booking-list');
    Route::livewire('/booking/{id}/edit', 'pages::booking.edit')->middleware('permission:Booking-edit')->name('Booking-edit');
});
