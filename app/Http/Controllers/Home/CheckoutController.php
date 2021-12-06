<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CheckoutController extends Controller
{
    public function show(Request $request)
    {

        $cart = json_decode(Cookie::get('cart'), true);

        if(!$cart){

            return back()->with('error', 'سبد خرید شما خالی می باشد');

        }

        $totalPrice = array_sum(array_column($cart, 'price'));

        return view('frontend.checkout', compact('cart', 'totalPrice'));
    }
}
