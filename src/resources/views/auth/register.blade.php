@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')

<div class="register__container">
    <form class="register__form" action="{{ route('register.store') }}" method="POST">
        @csrf
        <h2 class="register__form-title">Register</h2>

        <div class="register__form-group">
            <label for="username" class="register__label">
                <img src="{{ asset('image/person-image-20241022.png') }}" alt="メンバーアイコン" class="register__icon">
            </label>
            <input type="text" name="name" placeholder="Username" class="register__input" value="{{ old('name') }}">
            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="register__form-group">
            <label for="email" class="register__label">
                <img src="{{ asset('image/mail-icon.png') }}" alt="メールアイコン" class="register__icon">
            </label>
            <input type="email" name="email" placeholder="Email" class="register__input" value="{{ old('email') }}">
            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="register__form-group">
            <label for="password" class="register__label">
                <img src="{{ asset('image/key-image-20241022.png') }}" alt="パスワードアイコン" class="register__icon">
            </label>
            <input type="password" name="password" placeholder="Password" class="register__input">
            @error('password')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>


        <button type="submit" class="register__button">登録</button>
    </form>
</div>

@endsection