<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    // 決済画面を表示
    public function showPaymentPage()
    {
        return view('payment');
    }

    // 決済処理
    public function processPayment(PaymentRequest $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => 1000, // 金額
                'currency' => 'jpy',
                'automatic_payment_methods' => ['enabled' => true],
            ]);

            return response()->json(['success' => true, 'client_secret' => $paymentIntent->client_secret]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }
}
