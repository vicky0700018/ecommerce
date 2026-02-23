<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

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

    $user = Auth::user();
    $totalOrders = $user->orders()->count();
    $totalSpent = $user->orders()->sum('total_amount');
    $savedAddresses = $user->addresses()->count();
    $recentOrders = $user->orders()->with('items.product')->orderBy('created_at', 'desc')->take(3)->get();
    
    $products = \App\Models\Product::all();
    $recommendedProducts = $products->random(min(4, $products->count()));
    
    return view('dashboard', compact('totalOrders', 'totalSpent', 'savedAddresses', 'recentOrders', 'recommendedProducts'));
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
    Route::get('/profile/addresses', [ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    
    // Address Routes
    Route::post('/addresses', [AddressController::class, 'store'])->name('address.store');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('address.destroy');
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

/*
|--------------------------------------------------------------------------
| Product Routes
|--------------------------------------------------------------------------
*/
Route::resource('products', ProductController::class);

/*
|--------------------------------------------------------------------------
| Cart Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
});

/*
|--------------------------------------------------------------------------
| Payment Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment-success/{order}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/stripe-public-key', [PaymentController::class, 'getStripeKey'])->name('payment.stripe-key');
});


require __DIR__.'/auth.php';
