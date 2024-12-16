<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    public function processPayment(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => 1000, // 金額 (例: 1000 = 10ドル)
                'currency' => 'jpy',
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never', // リダイレクトを許可しない設定
                ],
            ]);


            return response()->json(['success' => true]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
