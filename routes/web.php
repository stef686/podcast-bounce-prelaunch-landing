<?php

use App\Http\Controllers\WaitlistController;
use App\Models\WaitlistSignup;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'waitlistCount' => WaitlistSignup::count(),
    ]);
})->name('home');

Route::post('/waitlist', [WaitlistController::class, 'store'])->name('waitlist.store');
