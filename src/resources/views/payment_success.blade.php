<!-- resources/views/payment_success.blade.php -->
@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment_success.css') }}">
@endsection

@section('content')
<main class="success__content">
    <div class="success__message-box">
        <p class="success__message">決済が成功しました！</p>
        <a href="{{ route('home') }}" class="home-button">ホームに戻る</a>
    </div>
</main>
@endsection