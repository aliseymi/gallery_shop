<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function show($product_id)
    {
        $product = Product::findOrFail($product_id);

        $similarProducts = Product::where('category_id', $product->category_id)->where('id','!=',$product->id)->take(4)->get();

        return view('frontend.products.show', compact('product', 'similarProducts'));
    }

    public function quickSee(Request $request)
    {
        $id = $request->id;

        $product = Product::find($id);

        $product->price = number_format($product->price) . ' تومان';

        $product->description = strip_tags($product->description);

        $product->href = route('home.cart.add', $product->id);

        return $product;
    }
}
