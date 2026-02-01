# ShopHub Project Complete Codebase

This document contains the source code for all significant files in the ShopHub project.

---

## 📂 Models (`app/Models`)

### `User.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
```

### `Product.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_url',
        'stock',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
}
```

### `Order.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'payment_method',
        'stripe_payment_id',
        'payment_details',
    ];

    protected $casts = [
        'payment_details' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
```

### `OrderItem.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
```

### `Cart.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
```

### `Address.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'street',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

### `Otp.php`
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'otp'
    ];
}
```

---

## 📂 Controllers (`app/Http/Controllers`)

### `ProductController.php`
(See previous codebase artifact or file for full content - listing key methods)
- `index()`: Lists products
- `create()`, `store()`: Adds new product
- `show()`: Shows product details
- `edit()`, `update()`: Modifies product
- `destroy()`: Deletes product

### `CartController.php`
- `index()`: View cart totals
- `store()`: Add item/increment quantity
- `update()`: Change quantity
- `destroy()`: Remove item

### `PaymentController.php`
- `checkout()`: Show checkout page
- `processPayment()`: Handle Stripe/Demo payment
- `success()`: Show success page

### `AddressController.php`
```php
<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses()->get();
        return view('profile.addresses', compact('addresses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'street' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'postal_code' => 'required|string',
            'country' => 'required|string',
            'phone' => 'required|string',
            'is_default' => 'nullable|boolean',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->has('is_default') && $request->is_default) {
            Auth::user()->addresses()->update(['is_default' => false]);
        }

        Address::create($validated);

        return redirect()->route('profile.addresses')->with('success', 'Address added successfully!');
    }

    public function destroy(Address $address)
    {
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $address->delete();
        return redirect()->route('profile.addresses')->with('success', 'Address deleted successfully!');
    }
}
```

### `OtpController.php`
```php
<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    public function showOtpForm() { return view('auth.otp'); }

    public function sendOtp()
    {
        $otp = rand(1000, 9999);
        Otp::updateOrCreate(['user_id' => Auth::id()], ['otp' => $otp]);
        
        $message = config('app.env') === 'local' 
            ? "✅ OTP: $otp (Development Mode)"
            : 'OTP sent to your email';

        return redirect()->route('otp.form')->with('success', $message);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required']);
        $record = Otp::where('user_id', Auth::id())->where('otp', $request->otp)->first();

        if ($record) {
            $record->delete();
            session(['otp_verified' => true]);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['otp' => 'Invalid OTP']);
    }
}
```

### `ProfileController.php`
- `edit()`, `update()`, `destroy()`: Manage User Profile
- `addresses()`: View Saved Addresses
- `orders()`: View Order History

---

## 📂 Routes (`routes/web.php`)

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

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

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/addresses', [ProfileController::class, 'addresses'])->name('profile.addresses');
    Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');
    
    Route::post('/addresses', [AddressController::class, 'store'])->name('address.store');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('address.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/otp', [OtpController::class, 'showOtpForm'])->name('otp.form');
    Route::get('/send-otp', [OtpController::class, 'sendOtp'])->name('otp.send');
    Route::post('/verify-otp', [OtpController::class, 'verifyOtp'])->name('otp.verify');
});

Route::resource('products', ProductController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment-success/{order}', [PaymentController::class, 'success'])->name('payment.success');
});

require __DIR__.'/auth.php';
```

---

## 📂 Views (`resources/views`)

### `welcome.blade.php` (Homepage)
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopHub - E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">ShopHub</h1>
                </div>
                <!-- Auth Links -->
                <div class="flex items-center gap-4">
                    @auth
                    <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button type="submit" class="px-4 py-2 text-sm font-medium text-red-600 hover:text-red-800">Logout</button></form>
                    @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Login</a>
                    @if (Route::has('register'))<a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Register</a>@endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <!-- Sections for Hero, Features, Products, Newsletter -->
    <!-- (See file for full HTML content) -->
</body>
</html>
```

### `dashboard.blade.php` (User Dashboard)
```html
@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-2xl shadow-2xl p-8 mb-8">
        <h1 class="text-5xl font-black mb-2">👋 Welcome back, {{ Auth::user()->name }}!</h1>
        <p class="text-lg opacity-90">Happy shopping! Here's your account summary.</p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Stats Cards: Orders, Spent, Addresses -->
        <div class="bg-white rounded-2xl shadow-2xl p-6 border-l-4 border-purpose-600">
             <p class="text-gray-700 font-bold text-sm">📦 Total Orders</p>
             <p class="text-4xl font-black text-purple-900">{{ $totalOrders }}</p>
        </div>
         <div class="bg-white rounded-2xl shadow-2xl p-6 border-l-4 border-green-600">
             <p class="text-gray-700 font-bold text-sm">💰 Total Spent</p>
             <!-- Note: Multiplier removed based on fix -->
             <p class="text-4xl font-black text-green-600">₹{{ number_format($totalSpent, 0) }}</p>
        </div>
        <!-- ... -->
    </div>

    <!-- Quick Actions, Recent Orders, Recommended Products -->
    <!-- (See file for full HTML content) -->
</div>
@endsection
```

### `products/index.blade.php` (Product Listing)
```html
@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-5xl font-black text-purple-900">🎁 Our Premium Collection</h1>
        <a href="{{ route('products.create') }}" class="bg-primary text-black px-8 py-3 rounded-full font-bold">Add Product</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($products as $product)
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border-2 border-blue-300">
                <img src="{{ $product->image_url }}" class="w-full h-48 object-cover">
                <div class="p-5">
                    <h3 class="text-xl font-black mb-2">{{ $product->name }}</h3>
                    <div class="flex justify-between items-center mb-5">
                        <span class="text-4xl font-black text-blue-600">₹{{ number_format($product->price, 0) }}</span>
                    </div>
                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full bg-green-500 text-black px-3 py-3 rounded-xl font-bold">🛒 Add to Cart</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
```

### `cart/index.blade.php` (Shopping Cart)
```html
@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-5xl font-black text-purple-900 mb-8">🛒 Your Shopping Cart</h1>
    
    @if ($cartItems->isEmpty())
        <p>Your cart is empty</p>
    @else
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2">
                <!-- Cart Table -->
                <table class="w-full">
                    <!-- Headings -->
                    <tbody>
                        @foreach ($cartItems as $item)
                        <tr>
                            <!-- Product, Price, Update Quantity Form, Remove Button -->
                             <td class="px-6 py-4 font-black text-black text-lg">
                                ₹{{ number_format($item->product->price * $item->quantity, 0) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-span-1">
                 <!-- Order Summary & Checkout Button -->
                 <a href="{{ route('payment.checkout') }}" class="w-full bg-blue-600 text-black px-6 py-4 rounded-xl font-black block">💳 Proceed to Checkout</a>
            </div>
        </div>
    @endif
</div>
@endsection
```

### `payment/checkout.blade.php`
(See previous codebase artifact or file for full content)

### `payment/success.blade.php`
```html
@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-6xl font-black text-emerald-700 mb-3">Payment Successful!</h1>
        
        <div class="bg-white rounded-2xl shadow-2xl p-8 mb-8 text-left border-l-4 border-emerald-500">
            <h2 class="text-3xl font-black text-emerald-700 mb-6">📦 Order Details</h2>
            <!-- Order ID, Date, Payment Method -->
            <div class="mt-6">
                <h3 class="font-black text-xl mb-4 text-emerald-700">📋 Your Items:</h3>
                @foreach ($order->items as $item)
                    <!-- Item details -->
                @endforeach
                <div class="flex justify-between font-black text-2xl mt-6 pt-4 border-t-2 border-gray-200">
                    <span>Total Paid:</span>
                    <span class="text-orange-600">₹{{ number_format($order->total_amount, 0) }}</span>
                </div>
            </div>
        </div>
        
        <a href="{{ route('products.index') }}" class="block w-full bg-gradient-to-r from-cyan-500 via-blue-500 to-purple-500 text-white px-6 py-4 rounded-xl font-black text-lg">🛍️ Continue Shopping</a>
    </div>
</div>
@endsection
```

### `layouts/app.blade.php`
(See previous codebase artifact or file for full content)

---

## 📂 Database Seeders (`database/seeders`)

### `ProductSeeder.php`
```php
<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Classic Watch',
            'description' => 'Elegant design, verified quality.',
            'price' => 12999,
            'image_url' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=500&q=80',
            'stock' => 50,
        ]);

        Product::create([
            'name' => 'Noise Cancelling Headphones',
            'description' => 'Immersive sound experience.',
            'price' => 2499,
            'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=500&q=80',
            'stock' => 40,
        ]);
        
        // ... (Camera and Shoes entries)
    }
}
```
