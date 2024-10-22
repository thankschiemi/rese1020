@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_done.css') }}">
@endsection

@section('content')

<main class="reservation-done__content">
    <div class="reservation-done__message-box">
        <p class="reservation-done__message">ご予約ありがとうございます</p>
        <button class="reservation-done__button">戻る</button>
    </div>
</main>

@endsection