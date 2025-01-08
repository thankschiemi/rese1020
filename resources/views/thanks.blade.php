@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<main class="thanks__content">
    <div class="thanks__message-box">
        <p class="thanks__message">会員登録ありがとうございます</p>
        <form method="POST" action="{{ route('auto-login') }}">
            @csrf
            <button type="submit" class="thanks__button">ログインする</button>

    </div>
</main>

@endsection