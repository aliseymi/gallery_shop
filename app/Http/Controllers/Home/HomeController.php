<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function all()
    {
        $products = Product::all();

        $categories = Category::all();

        return view('frontend.products.all', compact('products', 'categories'));
    }
}
