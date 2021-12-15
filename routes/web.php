<?php

use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\CheckoutController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ProductsController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'all'])->name('home.products.all');

// route for ajax
Route::post('quickSee', [ProductsController::class, 'quickSee']);

Route::get('{product_id}/show', [ProductsController::class, 'show'])->name('home.products.show');

Route::get('{product_id}/addToCart', [CartController::class, 'addToCart'])->name('home.cart.add');

Route::get('{product_id}/removeFromCart', [CartController::class, 'removeFromCart'])->name('home.cart.remove');

Route::get('checkout', [CheckoutController::class, 'show'])->name('home.checkout.show');

Route::prefix('payment')->group(function(){

    Route::post('pay', [PaymentController::class, 'pay'])->name('payment.pay');

    Route::post('callback', [PaymentController::class, 'callback'])->name('payment.callback');

});
