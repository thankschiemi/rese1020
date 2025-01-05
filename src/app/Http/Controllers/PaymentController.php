<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function showPaymentPage()
    {
        return view('payment');
    }

    public function processPayment(PaymentRequest $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $request->input('amount', 1000),
                'currency' => 'jpy',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            return response()->json([
                'success' => true,
                'client_secret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => '決済処理中にエラーが発生しました。',
            ], 200);
        }
    }
}
