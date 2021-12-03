<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\CategoriesController;

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
});
