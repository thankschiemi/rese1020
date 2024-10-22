@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurant_all.css') }}">
@endsection

@section('content')

<nav class="filter">
    <select class="filter__area">
        <option value="">All area</option>
        <option value="tokyo">Tokyo</option>
        <option value="osaka">Osaka</option>
        <option value="fukuoka">Fukuoka</option>
    </select>
    <select class="filter__genre">
        <option value="">All genre</option>
        <!-- ジャンルのオプションが続く -->
    </select>
    <input type="search" class="filter__search" placeholder="Search ...">
</nav>

<main class="page__content">
    <section class="restaurant-list">
        <article class="restaurant">
            <div class="restaurant__image">
                <img src="sushi.jpg" alt="店舗画像">
            </div>
            <div class="restaurant__details">
                <h2 class="restaurant__name">仙人</h2>
                <p class="restaurant__tags">#東京都 #寿司</p>
                <button class="restaurant__button">詳しくみる</button>
            </div>
            <div class="restaurant__favorite">
                <button class="restaurant__favorite-button">❤️</button>
            </div>
        </article>
        <!-- 他の店舗も同様に続く -->
    </section>
</main>

@endsection