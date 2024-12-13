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
    form.addEventListener('submit', async (event) => {
        event.preventDefault(); // フォームのデフォルト動作を無効化
        submitButton.disabled = true; // ボタンを無効化して二重送信を防ぐ

        // カード情報をStripeに送信して、PaymentMethodを作成
        const {
            paymentMethod,
            error
        } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        });

        if (error) {
            alert('エラー: ' + error.message);
            submitButton.disabled = false; // ボタンを再度有効化
            return;
        }

        // サーバーサイドにPaymentMethod IDを送信
        const response = await fetch('/process-payment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                payment_method_id: paymentMethod.id
            })
        });

        const result = await response.json();

        if (result.success) {
            alert('決済が成功しました！');
            // 必要であれば決済成功後の処理をここに追加
        } else {
            alert('決済に失敗しました: ' + result.error);
            submitButton.disabled = false; // ボタンを再度有効化
        }
    });
</script>
@endsection