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
            {{-- 管理者用リンク --}}
            @if(Auth::user()->role === 'admin')
            <li class="menu__item">
                <a href="{{ route('admin.dashboard') }}" class="menu__link">Admin Dashboard</a>
            </li>
            @endif

            {{-- 店舗代表者用リンク --}}
            @if(Auth::user()->role === 'owner')
            <li class="menu__item">
                <a href="{{ route('owner.dashboard') }}" class="menu__link">Owner Dashboard</a>
            </li>
            @endif

        </ul>
    </nav>
</div>

@endsection