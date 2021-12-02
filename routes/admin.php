<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;

Route::prefix('categories')->group(function () {

    # admin/categories
    Route::get('',[CategoriesController::class,'all'])->name('admin.categories.all');

    Route::get('create', [CategoriesController::class, 'create'])->name('admin.categories.create');

    # admin/categories
    Route::post('', [CategoriesController::class, 'store'])->name('admin.categories.store');
});
