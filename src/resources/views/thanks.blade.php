@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')

<main class="thanks__content">
    <div class="thanks__message-box">
        <p class="thanks__message">会員登録ありがとうございます</p>
        <button class="thanks__button">ログインする</button>
    </div>
</main>

@endsection