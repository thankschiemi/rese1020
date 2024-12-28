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
            <ul class="payment-list" novalidate>
                <li>
                    <label for="card-holder-name">カード名義人</label>
                    <input id="card-holder-name" type="text" class="stripe-input" placeholder="名義人の名前">
                    @error('card_name')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </li>
                <li>
                    <label for="card-number">カード番号</label>
                    <div id="card-number" class="stripe-input"></div>
                    @error('card_number')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </li>
                <li>
                    <label for="card-expiry">有効期限</label>
                    <div id="card-expiry" class="stripe-input"></div>
                    @error('expiry_date')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
                </li>
                <li>
                    <label for="card-cvc">セキュリティコード</label>
                    <div id="card-cvc" class="stripe-input"></div>
                    @error('cvc')
                    <div class="error-message">{{ $message }}</div>
                    @enderror
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
        // Stripe公開キーを使用してインスタンスを1度だけ作成
        const stripe = Stripe("{{ config('app.stripe_key') }}");

        // Elementsの初期化 (重複しないよう注意)
        const elements = stripe.elements();

        // カード情報の入力フィールドを作成 (1回のみ)
        const cardNumber = elements.create('cardNumber');
        const cardExpiry = elements.create('cardExpiry');
        const cardCvc = elements.create('cardCvc');

        // マウントする (重複しないように)
        cardNumber.mount('#card-number');
        cardExpiry.mount('#card-expiry');
        cardCvc.mount('#card-cvc');

        const form = document.getElementById('payment-form');
        const submitButton = document.getElementById('submit-button');

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            submitButton.disabled = true;

            // カード名義人を取得
            const cardHolderName = document.getElementById('card-holder-name').value;

            // 名義人が空の場合のバリデーション
            if (!cardHolderName.trim()) {
                alert("名義人を入力してください。");
                submitButton.disabled = false;
                return;
            }

            // PaymentMethod作成
            const {
                error,
                paymentMethod
            } = await stripe.createPaymentMethod({
                type: 'card',
                card: cardNumber,
                billing_details: {
                    name: cardHolderName
                },
            });

            // エラーハンドリング
            if (error) {
                console.error(error.message);
                alert("エラー: " + error.message);
                submitButton.disabled = false;
            } else {
                console.log("PaymentMethod成功: ", paymentMethod.id);

                // サーバーにデータ送信
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
                    alert("決済が成功しました！");
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