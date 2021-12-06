<?php

use App\Http\Controllers\Home\CartController;
use App\Http\Controllers\Home\CheckoutController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'all'])->name('home.products.all');

Route::get('{product_id}/show', [ProductsController::class, 'show'])->name('home.products.show');

Route::get('{product_id}/addToCart', [CartController::class, 'addToCart'])->name('home.cart.add');

Route::get('{product_id}/removeFromCart', [CartController::class, 'removeFromCart'])->name('home.cart.remove');

Route::get('checkout', [CheckoutController::class, 'show'])->name('home.checkout.show');
