<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::all();
    return view('pages.home',compact('products'));
})->name('home');

Route::get('/dashboard', function () {
   
    $products = Product::all();
    return view('pages.admin.dashboard',compact('products'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('products', ProductController::class)->middleware('auth');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::resource('cart', CartController::class);

Route::prefix('checkout')->group(function () {
    Route::get('customer-information', [OrderController::class,'customerInformation'])->name('order.customer-information');
    Route::post('customer-information', [OrderController::class,'processCustomerInformation'])->name('order.process-customer-information');

    Route::get('overview', [OrderController::class,'orderOverview'])->name('order.overview');

    Route::post('payment', [OrderController::class,'payment'])->name('order.payment');
    Route::post('processPayment', [OrderController::class,'processPayment'])->name('order.processPayment');

    Route::get('confirmation', [OrderController::class,'confirmation'])->name('order.confirmation');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
