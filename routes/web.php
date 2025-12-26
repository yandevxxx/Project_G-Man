<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // User Routes
    Route::get('/shop', [App\Http\Controllers\PurchaseController::class, 'catalog'])->name('purchases.catalog');
    Route::get('/checkout/{id}', [App\Http\Controllers\PurchaseController::class, 'checkout'])->name('purchases.checkout');
    Route::post('/checkout', [App\Http\Controllers\PurchaseController::class, 'processCheckout'])->name('purchases.process_checkout');
    Route::get('/purchases/history', [App\Http\Controllers\PurchaseController::class, 'history'])->name('purchases.history');

    // Admin-only routes
    Route::middleware('admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::get('/admin/transactions', [App\Http\Controllers\PurchaseController::class, 'adminIndex'])->name('admin.transactions');
    });
});
