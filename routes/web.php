<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OtpController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard (OTP Protected)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (!session('otp_verified')) {
        return redirect()->route('otp.form');
    }
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| OTP Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/otp', [OtpController::class, 'showOtpForm'])->name('otp.form');
    Route::get('/send-otp', [OtpController::class, 'sendOtp'])->name('otp.send');
    Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');
});

require __DIR__.'/auth.php';
