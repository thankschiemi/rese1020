@extends('rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')

<form class="register__form">
    <h2 class="register__form-title">Register</h2>
    <div class="register__form-group">
        <label for="username" class="register__label">
            <i class="register__icon register__icon--user"></i>
            ユーザー名
        </label>
        <input type="text" id="username" name="username" class="register__input">
    </div>
    <div class="register__form-group">
        <label for="email" class="register__label">
            <i class="register__icon register__icon--email"></i>
            メールアドレス
        </label>
        <input type="email" id="email" name="email" class="register__input">
    </div>
    <div class="register__form-group">
        <label for="password" class="register__label">
            <i class="register__icon register__icon--password"></i>
            パスワード
        </label>
        <input type="password" id="password" name="password" class="register__input">
    </div>
    <button type="submit" class="register__button">登録</button>
</form>

@endsection