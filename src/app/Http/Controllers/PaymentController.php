<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => 1000, // 金額
                'currency' => 'jpy',
                'payment_method' => $request->payment_method_id,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never', // リダイレクトを無効にする
                ],
            ]);




            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
