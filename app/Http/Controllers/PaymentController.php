<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Payment\PaymentService;
use Illuminate\Http\Request;
use App\Services\Payment\Requests\IDPayRequest;

class PaymentController extends Controller
{
    public function pay()
    {
        $user = User::first();

        $idPayRequest = new IDPayRequest([
            'user' => $user,
            'amount' => 10000
        ]);

        $paymentService = new PaymentService(PaymentService::IDPAY, $idPayRequest); 

        dd($paymentService->pay());
    }
}
