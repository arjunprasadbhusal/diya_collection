<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [HomeController::class, 'shop'])->name('products.index');
Route::get('/products/{id}', [HomeController::class, 'show'])->name('products.show');

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('/login', [AdminAuthenticatedSessionController::class, 'store'])->name('login.store');
    });

    Route::middleware(['auth', 'verified', 'isadmin'])->group(function () {
        Route::get('/dashboard', function () {
            $orderCount = \App\Models\Order::count();
            $revenueTotal = \App\Models\Order::sum('total');
            $productCount = \App\Models\Product::count();
            $categoryCount = \App\Models\Category::count();
            $recentOrders = \App\Models\Order::latest()->take(5)->get();

            return view('dashboard', compact(
                'orderCount',
                'revenueTotal',
                'productCount',
                'categoryCount',
                'recentOrders'
            ));
        })->name('dashboard');

        Route::resource('category', \App\Http\Controllers\CategoryController::class);
        Route::resource('product', \App\Http\Controllers\ProductController::class);
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
