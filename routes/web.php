<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProcessingController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\URL;

if (config('app.env') == 'production') {
    URL::forceScheme('https');
}

Route::get('/', function () {
    $products = Product::all();
    return view('pages.home',compact('products'));
})->name('home');

Route::get('/dashboard', function () {
   
    $products = Product::all();
    return view('pages.admin.dashboard',compact('products'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('stripe', [StripeController::class, 'stripe']);
Route::post('stripe/create-checkout-session', [StripeController::class, 'createCheckoutSession'])->name("stripe.create-checkout-session");
Route::get('stripe/return/{session_id}', [StripeController::class, 'paymentReturn'])->name("stripe.return");

Route::resource('products', ProductController::class)->middleware('auth');

Route::prefix('order-processing')->middleware('auth')->group(function () {
    Route::get('/', [OrderProcessingController::class, 'index'])->name('order-processing.index');
    Route::get('/open', [OrderProcessingController::class, 'showOrdersOpen'])->name('order-processing.open');
    Route::get('/closed', [OrderProcessingController::class, 'showOrdersClosed'])->name('order-processing.closed');
    Route::get('order/{id}',[OrderProcessingController::class, 'showOrderDetails'])->name('order-processing.show');
    Route::put('order/{id}',[OrderProcessingController::class, 'updateOrder'])->name('order-processing.update');
    Route::delete('order/{id}',[OrderProcessingController::class, 'deleteOrder'])->name('order-processing.destroy');
});

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
