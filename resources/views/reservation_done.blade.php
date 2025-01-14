@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_done.css') }}">
@endsection

@section('content')

<main class="done__content">
    <div class="done__message-box">
        <p class="done__message">ご予約ありがとうございます</p>
        <a href="{{ route('payment.page') }}" class="payment-button">決済画面へ進む</a>
        <a href="{{ url()->previous() }}" class="back-button">戻る</a>
    </div>
</main>

@endsection