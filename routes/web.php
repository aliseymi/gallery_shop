<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('', [HomeController::class, 'all'])->name('home.products.all');

Route::get('{product_id}/show', [ProductsController::class, 'show'])->name('home.products.show');
