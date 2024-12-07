<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductManagementController;
use App\Http\Controllers\CartController;
use App\Models\Product;
use Flasher\Laravel\Http\Request;
use Illuminate\Support\Facades\Route;
use Flasher\Notyf\Prime\NotyfInterface;

Route::get('/', function () {
    $products = Product::all();
    return view('pages.home',compact('products'));
})->name('home');

Route::get('/dashboard', function () {
   
    $products = Product::all();
    return view('pages.admin.dashboard',compact('products'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('products', ProductManagementController::class)->middleware('auth');
Route::get('/products/{product}', [ProductManagementController::class, 'show'])->name('products.show');
Route::resource('cart', CartController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
