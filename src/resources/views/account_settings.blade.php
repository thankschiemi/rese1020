@extends('layouts.rese_layouts_menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/account_settings.css') }}">
@endsection

@section('content')

<div class="menu">
    <nav class="menu__nav">
        <ul class="menu__list">
            <li class="menu__item">
                <a href="{{ url('/') }}" class="menu__link">Home</a> <!-- ホーム画面のリンク -->
            </li>
            <li class="menu__item">
                <a href="{{ url('/register') }}" class="menu__link">Registration</a> <!-- 新規登録画面へのリンク -->
            </li>
            <li class="menu__item">
                <a href="{{ url('/login') }}" class="menu__link">Login</a> <!-- ログイン画面へのリンク -->
            </li>
        </ul>
    </nav>
</div>

@endsection