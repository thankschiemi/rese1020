@extends('layouts.rese_layouts_menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/main_menu.css') }}">
@endsection

@section('content')

<div class="menu">
    <nav class="menu__nav">
        <ul class="menu__list">
            <li class="menu__item">
                <a href="#" class="menu__link">Home</a>
            </li>
            <li class="menu__item">
                <a href="#" class="menu__link">Logout</a>
            </li>
            <li class="menu__item">
                <a href="#" class="menu__link">Mypage</a>
            </li>
        </ul>
    </nav>
</div>


@endsection