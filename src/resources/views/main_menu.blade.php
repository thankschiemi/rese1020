@extends('layouts.rese_layouts_menu')

@section('css')
<link rel="stylesheet" href="{{ asset('css/main_menu.css') }}">
@endsection

@section('content')

<div class="menu">
    <nav class="menu__nav">
        <ul class="menu__list">
            <li class="menu__item">
                <a href="{{ url('/') }}" class="menu__link">Home</a> <!-- ホーム画面のリンク -->
            </li>
            <li class="menu__item">
                <form method="POST" action="{{ route('logout') }}" class="menu__form">
                    @csrf
                    <button type="submit" class="menu__link">Logout</button>
                </form>
            </li>
            <li class="menu__item">
                <a href="{{ url('/mypage') }}" class="menu__link">Mypage</a> <!-- アカウント設定へのリンク -->
            </li>
        </ul>
    </nav>
</div>

@endsection