@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="login__container">
    <form class="login__form" method="POST" action="{{ route('login.authenticate') }}">
        @csrf
        <h2 class="login__form-title">Login</h2>

        <div class="login__form-group">
            <label for="email" class="login__label">
                <img src="{{ asset('image/mail-image-20241022.png') }}" alt="メールアイコン" class="login__icon">
            </label>
            <input type="email" id="email" name="email" placeholder="Email" class="login__input" required>
        </div>

        <div class="login__form-group">
            <label for="password" class="login__label">
                <img src="{{ asset('image/key-image-20241022.png') }}" alt="パスワードアイコン" class="login__icon">
            </label>
            <input type="password" id="password" name="password" placeholder="Password" class="login__input" required>
        </div>

        <button type="submit" class="login__button">ログイン</button>
    </form>
</div>

@endsection