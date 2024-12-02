<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/dashboard', function () {
    return view('pages.admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('products', ProductManagementController::class)->middleware('auth');
Route::get('products/create', [ProductManagementController::class, 'createProductPage'])->name('products.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
