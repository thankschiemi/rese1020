@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')

<form class="login__form">
    <h2 class="login__form-title">Login</h2>
    <div class="login__form-group">
        <label for="email" class="login__label">
            <i class="login__icon login__icon--email"></i>
            Email
        </label>
        <input type="email" id="email" name="email" class="login__input">
    </div>
    <div class="login__form-group">
        <label for="password" class="login__label">
            <i class="login__icon login__icon--password"></i>
            Password
        </label>
        <input type="password" id="password" name="password" class="login__input">
    </div>
    <button type="submit" class="login__button">ログイン</button>
</form>

@endsection