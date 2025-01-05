@extends('layouts.rese_layouts_menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/account_settings.css') }}">
@endsection

@section('content')

@if(session('error'))
<p class="alert alert-danger">{{ session('error') }}</p>
@endif

<div class="menu">
    <nav class="menu__nav">
        <ul class="menu__list">
            <li class="menu__item">
                <a href="{{ url('/') }}" class="menu__link">Home</a>
            </li>
            <li class="menu__item">
                <a href="{{ url('/register') }}" class="menu__link">Registration</a>
            </li>
            <li class="menu__item">
                <a href="{{ url('/login') }}" class="menu__link">Login</a>
            </li>
        </ul>
    </nav>
</div>

@endsection