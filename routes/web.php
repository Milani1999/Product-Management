<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

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
                return redirect()->route('donator.dashboard');
            case 'Issuer':
                return redirect()->route('issuer.dashboard');
            default:
                return redirect()->route('dashboard');
        }
    })->name('dashboard');

 
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/donator/dashboard', [DashboardController::class, 'donatorDashboard'])->name('donator.dashboard');
    Route::get('/issuer/dashboard', [DashboardController::class, 'issuerDashboard'])->name('issuer.dashboard');
});

require __DIR__.'/auth.php';
