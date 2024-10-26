@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')

<div class="register__container">
    <form class="register__form">
        <h2 class="register__form-title">Register</h2>


        <div class="register__form-group">
            <label for="username" class="register__label">
                <img src="{{ asset('image/person-image-20241022.png') }}" alt="メンバーアイコン" class="register__icon">
            </label>
            <input type="name" name="name" placeholder="Username" class="register__input">
        </div>

        <div class="register__form-group">
            <label for="email" class="register__label">
                <img src="{{ asset('image/mail-image-20241022.png') }}" alt="メールアイコン" class="register__icon">
            </label>
            <input type="email" name="email" placeholder="Email" class="register__input">
        </div>

        <div class="register__form-group">
            <label for="password" class="register__label">
                <img src="{{ asset('image/key-image-20241022.png') }}" alt="パスワードアイコン" class="register__icon">
            </label>
            <input type="password" name="password" placeholder="Password" class="register__input">
        </div>

        <button type="submit" class="register__button">登録</button>
    </form>

    @endsection