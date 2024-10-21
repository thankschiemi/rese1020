@extends('rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/account_settings.css') }}">
@endsection

@section('content')

<div class="menu">
    <div class="menu__header">
        <button class="menu__close-button">✖</button>
    </div>
    <nav class="menu__nav">
        <ul class="menu__list">
            <li class="menu__item">
                <a href="#" class="menu__link">Home</a>
            </li>
            <li class="menu__item">
                <a href="#" class="menu__link">Registration</a>
            </li>
            <li class="menu__item">
                <a href="#" class="menu__link">Login</a>
            </li>
        </ul>
    </nav>
</div>


@endsection