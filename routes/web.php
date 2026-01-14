<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'store'])->name('register.store');

    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'verifyResetCredentials'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'updatePassword'])->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Routes
    Route::get('/shop', [PurchaseController::class, 'catalog'])->name('purchases.catalog');
    Route::get('/checkout/{id}', [PurchaseController::class, 'checkout'])->name('purchases.checkout');
    Route::post('/checkout', [PurchaseController::class, 'processCheckout'])->name('purchases.process_checkout');
    Route::get('/purchases/history', [PurchaseController::class, 'history'])->name('purchases.history');

    // Profile Management
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    // Admin-only routes
    Route::middleware('admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('suppliers', SupplierController::class);
        Route::get('/admin/transactions', [PurchaseController::class, 'adminIndex'])->name('admin.transactions');
        Route::post('/admin/transactions/{id}/approve', [PurchaseController::class, 'approve'])->name('admin.transactions.approve');
        Route::post('/admin/transactions/{id}/reject', [PurchaseController::class, 'reject'])->name('admin.transactions.reject');

        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});


// tambahkan invoice alur pembayaran user
// tambahkan type payment
