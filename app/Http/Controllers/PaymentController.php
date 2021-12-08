<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Services\Payment\PaymentService;
use App\Http\Requests\Payments\PayRequest;
use App\Models\Payment;
use App\Models\Product;
use App\Services\Payment\Requests\IDPayRequest;

class PaymentController extends Controller
{
    public function pay(PayRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::firstOrCreate([
            'email' => $validatedData['email']
        ],[
            'name' => $validatedData['name'],
            'mobile' => $validatedData['mobile']
        ]);

        
        try{

            $orderItems = json_decode(Cookie::get('cart'), true);

            $products = Product::findMany(array_keys($orderItems));

            $totalPrice = $products->sum('price');

            $ref_code = Str::random(30);

            $order = Order::create([
                'user_id' => $user->id,
                'amount' => $totalPrice,
                'status' => 'unpaid',
                'ref_code' => $ref_code
            ]);

            $orderItemsForCreatedOrder = $products->map(function($product){
                $currentProduct = $product->only(['id', 'price']);

                $currentProduct['product_id'] = $currentProduct['id'];

                unset($currentProduct['id']);

                return $currentProduct;
            });

            $order->orderItems()->createMany($orderItemsForCreatedOrder->toArray());
            
            $ref_id = rand(1111,9999);

            $payment = Payment::create([
                'order_id' => $order->id,
                'gateway' => 'idpay',
                'status' => 'unpaid',
                'res_id' => $ref_id,
                'ref_id' => $ref_id 
            ]);

            $idPayRequest = new IDPayRequest([
                'order_id' => $ref_code,
                'amount' => $totalPrice,
                'user' => $user
            ]);

            $paymentService = new PaymentService(PaymentService::IDPAY, $idPayRequest);

            return $paymentService->pay();

        }catch(\Exception $e){

            return back()->with('failed', $e->getMessage());
            
        }
    }

    public function callback()
    {
        
    }
}
