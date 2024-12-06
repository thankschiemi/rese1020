@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<div class="login__container">
    <form class="login__form" method="POST" action="{{ route('login.authenticate') }}" novalidate>
        @csrf
        <h2 class="login__form-title">Login</h2>

        <div class="login__form-group">
            <label for="email" class="login__label">
                <img src="{{ asset('image/mail-icon.png') }}" alt="メールアイコン" class="login__icon">
            </label>
            <input type="email" id="email" name="email" placeholder="Email"
                class="login__input @error('email') is-invalid @enderror"
                value="{{ old('email') }}">
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="login__form-group">
            <label for="password" class="login__label">
                <img src="{{ asset('image/key-image-20241022.png') }}" alt="パスワードアイコン" class="login__icon">
            </label>
            <input type="password" id="password" name="password" placeholder="Password"
                class="login__input @error('password') is-invalid @enderror">
            @error('password')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="login__button">ログイン</button>
    </form>

</div>

@endsection