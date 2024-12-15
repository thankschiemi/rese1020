@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_done.css') }}">
@endsection

@section('content')

<main class="done__content">
    <div class="done__message-box">
        <p class="done__message">ご予約ありがとうございます</p>

        <!-- 決済ボタン -->
        <form id="payment-form">
            <div id="card-element" class="stripe-input"></div>
            <button id="submit-button" class="stripe-button">決済する</button>
        </form>



        <!-- 戻るボタン -->
        <a href="{{ url()->previous() }}" class="back-button">戻る</a>
    </div>
</main>

@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log("Stripe.jsの読み込み完了！");

        // Stripeの初期化
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();

        // カード要素を作成
        const cardElement = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a',
                },
            },
        });

        // カード要素をDOMにマウント
        cardElement.mount('#card-element');


        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');

        form.addEventListener('submit', async (event) => {
            event.preventDefault(); // デフォルトの動作を無効化
            submitButton.disabled = true; // ボタンを無効化して二重送信を防ぐ
            console.log("決済ボタンがクリックされました");

            // Stripeにカード情報を送信してPaymentMethodを作成
            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardElement,
            });

            if (error) {
                console.error("カード情報エラー: ", error.message);
                alert("カード情報エラー: " + error.message);
                submitButton.disabled = false; // ボタンを再度有効化
                return;
            }

            console.log("PaymentMethod作成成功: ", paymentMethod.id);

            // サーバーサイドへPaymentMethod IDを送信
            const response = await fetch('/process-payment', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    payment_method_id: paymentMethod.id
                })
            });

            const result = await response.json();
            console.log("サーバーからのレスポンス: ", result);

            if (result.success) {
                alert("決済が成功しました！");
                location.href = "/done"; // 成功後のリダイレクト
            } else {
                alert("決済エラー: " + result.error);
                submitButton.disabled = false;
            }
        });
    });
</script>
@endsection