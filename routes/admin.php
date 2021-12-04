<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\UsersController;
use App\Models\User;

Route::prefix('categories')->group(function () {

    # admin/categories
    Route::get('',[CategoriesController::class,'all'])->name('admin.categories.all');

    Route::get('create', [CategoriesController::class, 'create'])->name('admin.categories.create');

    # admin/categories
    Route::post('', [CategoriesController::class, 'store'])->name('admin.categories.store');

    Route::delete('/{category_id}/delete',[CategoriesController::class,'delete'])->name('admin.categories.delete');

    Route::get('{category_id}/edit',[CategoriesController::class,'edit'])->name('admin.categories.edit');

    Route::put('{category_id}/update',[CategoriesController::class,'update'])->name('admin.categories.update');
});

Route::prefix('products')->group(function(){

    Route::get('', [ProductsController::class, 'all'])->name('admin.products.all');

    Route::get('create', [ProductsController::class,'create'])->name('admin.products.create');

    Route::post('', [ProductsController::class, 'store'])->name('admin.products.store');

    Route::delete('{product_id}/delete', [ProductsController::class, 'delete'])->name('admin.products.delete');
    
    Route::get('{product_id}/edit', [ProductsController::class, 'edit'])->name('admin.product.edit');

    Route::put('{product_id}/update',[ProductsController::class, 'update'])->name('admin.products.update');

    Route::get('{product_id}/download/demo', [ProductsController::class, 'downloadDemo'])->name('admin.products.download.demo');
    Route::get('{product_id}/download/source', [ProductsController::class, 'downloadSource'])->name('admin.products.download.source');
});

Route::prefix('users')->group(function(){
    
    Route::get('', [UsersController::class, 'all'])->name('admin.users.all');
    Route::get('create', [UsersController::class, 'create'])->name('admin.users.create');
    Route::post('', [UsersController::class, 'store'])->name('admin.users.store');
    Route::get('{user_id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
    Route::put('{user_id}/update', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('{user_id}/delete', [UsersController::class, 'delete'])->name('admin.users.delete');
});

Route::prefix('orders')->group(function(){

    Route::get('', [OrdersController::class, 'all'])->name('admin.orders.all');

});
