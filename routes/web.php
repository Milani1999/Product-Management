<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        $user = Auth::user();

        switch ($user->role->name) {
            case 'Admin':
                return redirect()->route('dashboard');
            case 'Donator':
                return redirect()->route('products.index');
            case 'Issuer':
                return redirect()->route('issuer.dashboard');
            default:
                return redirect()->route('dashboard');
        }
    })->name('dashboard');

    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    // Route::get('/donator/dashboard', [DashboardController::class, 'donatorDashboard'])->name('donator.dashboard');
    Route::get('/issuer/dashboard', [DashboardController::class, 'issuerDashboard'])->name('issuer.dashboard');
    
    Route::get('/donator/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/donator/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/donator/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/donator/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/donator/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/donator/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::patch('/donator/products/{product}', [ProductController::class, 'update']);
    Route::delete('/donator/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    Route::get('/donator/products/{product}/donate', [DonationController::class, 'donate'])->name('products.donate');
    Route::post('/donator/products/{product}/donate', [DonationController::class, 'store'])->name('products.donate.submit');

    Route::get('/donator/donations', [DonationController::class, 'index'])->name('donator.index');

});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/donations', [DonationController::class, 'index2'])->name('admin.donations');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';
