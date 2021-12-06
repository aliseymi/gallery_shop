<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public $minutes = 600;

    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);

        $cart = json_decode(Cookie::get('cart'), true);

        if (!$cart) {

            $cart = [
                $product->id => [
                    'title' => $product->title,
                    'price' => $product->price,
                    'demo_url' => $product->demo_url
                ]
            ];

            $cart = json_encode($cart);

            Cookie::queue('cart', $cart, $this->minutes);

            return back()->with('success', 'محصول به سبد خرید اضافه شد');
        }

        if (isset($cart[$product->id])) {
            return back()->with('success', 'محصول به سبد خرید اضافه شد');
        }

        $cart[$product->id] = [
            'title' => $product->title,
            'price' => $product->price,
            'demo_url' => $product->demo_url
        ];

        Cookie::queue('cart', json_encode($cart), $this->minutes);

        return back()->with('success', 'محصول به سبد خرید اضافه شد');
    }

    public function removeFromCart($product_id)
    {
        $cart = json_decode(Cookie::get('cart'), true);

        if(isset($cart[$product_id])){
            unset($cart[$product_id]);
        }

        Cookie::queue('cart', json_encode($cart), $this->minutes);

        if(count($cart) == 0){
            return redirect(route('home.products.all'));
        }

        return back()->with('success', 'محصول از سبد خرید حذف شد');
    }
}
