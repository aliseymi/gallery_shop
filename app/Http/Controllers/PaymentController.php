<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Services\Payment\PaymentService;
use App\Http\Requests\Payments\PayRequest;
use App\Mail\SendOrderedImages;
use App\Services\Payment\Requests\IDPayRequest;
use App\Services\Payment\Requests\IDPayVerifyRequest;
use Illuminate\Support\Facades\Mail;

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

            if(count($orderItems) <= 0){
                throw new \InvalidArgumentException('سبد خرید شما خالی است');
            }

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
            

            $payment = Payment::create([
                'order_id' => $order->id,
                'gateway' => 'idpay',
                'status' => 'unpaid',
                'ref_code' => $ref_code 
            ]);

            $idPayRequest = new IDPayRequest([
                'order_id' => $ref_code,
                'amount' => $totalPrice,
                'user' => $user,
                'api_key' => config('services.gateways.id_pay.api_key')
            ]);

            $paymentService = new PaymentService(PaymentService::IDPAY, $idPayRequest);

            return $paymentService->pay();

        }catch(\Exception $e){

            return back()->with('failed', $e->getMessage());
            
        }
    }

    public function callback(Request $request)
    {
        $paymentInfo = $request->all();

        $idPayVerifyRequest = new IDPayVerifyRequest([
            'id' => $paymentInfo['id'],
            'orderId' => $paymentInfo['order_id'],
            'apiKey' => config('services.gateways.id_pay.api_key')
        ]);

        $paymentService = new PaymentService(PaymentService::IDPAY, $idPayVerifyRequest);

        $result = $paymentService->verify();

        if(!$result['status']){
            return redirect(route('home.checkout.show'))->with('failed', 'پرداخت شما انجام نشد');
        }

        if($result['statusCode'] == 101){
            return redirect(route('home.checkout.show'))->with('failed', 'پرداخت شما انجام شده و تصاویر برای شما ایمیل شده است');
        }

        $currentPayment = Payment::where('ref_code', $result['data']['order_id'])->first();

        $currentPayment->update([
            'status' => 'paid',
            'res_id' => $result['data']['track_id']
        ]);

        $currentPayment->order()->update([
            'status' => 'paid'
        ]);

        $currentUser = $currentPayment->order->user;

        $boughtImages = $currentPayment->order->orderItems->map(function($orderItem){
            return $orderItem->product->source_url;
        });


        Mail::to($currentUser)->send(new SendOrderedImages($boughtImages->toArray(), $currentUser));

        Cookie::queue('cart', null);

        return redirect(route('home.products.all'))->with('success', 'خرید شما با موفقیت انجام شد و تصاویر به ایمیل شما ارسال شدند');
    }
}
