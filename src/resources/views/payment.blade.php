@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')

<main class="payment__content">
    <div class="payment__message-box">
        <p class="payment__message">決済情報を入力してください</p>

        <!-- 決済フォーム -->
        <form id="payment-form" class="payment-form">
            <ul class="payment-list">
                <li>
                    <label for="card-holder-name">カード名義人</label>
                    <input id="card-holder-name" type="text" class="stripe-input" placeholder="名義人の名前">
                </li>
                <li>
                    <label for="card-number">カード番号</label>
                    <div id="card-number" class="stripe-input"></div>
                </li>
                <li>
                    <label for="card-expiry">有効期限</label>
                    <div id="card-expiry" class="stripe-input"></div>
                </li>
                <li>
                    <label for="card-cvc">セキュリティコード</label>
                    <div id="card-cvc" class="stripe-input"></div>
                </li>
            </ul>
            <button id="submit-button" class="stripe-button">決済する</button>
        </form>

    </div>
</main>

@endsection

@section('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Stripe初期化
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        const elements = stripe.elements();

        // 各入力フィールド
        const cardNumber = elements.create('cardNumber');
        cardNumber.mount('#card-number');

        const cardExpiry = elements.create('cardExpiry');
        cardExpiry.mount('#card-expiry');

        const cardCvc = elements.create('cardCvc');
        cardCvc.mount('#card-cvc');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            submitButton.disabled = true;

            const cardHolderName = document.getElementById('card-holder-name').value;

            const {
                error,
                paymentMethod
            } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardNumber,
                billing_details: {
                    name: cardHolderName, // 名義人の名前を追加
                },
            });

            if (error) {
                alert("エラー: " + error.message);
                submitButton.disabled = false;
            } else {
                console.log("PaymentMethod成功: ", paymentMethod.id);
                // サーバーへ送信する処理
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

                if (result.success) {
                    window.location.href = "/payment-success";
                } else {
                    alert("決済に失敗しました: " + result.error);
                    submitButton.disabled = false;
                }
            }
        });

    });
</script>
@endsection