@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@section('content')

<main class="mypage__content">
    <p class="mypage__user-name">testさん</p>

    <section class="reservation">
        <h2 class="reservation__title">予約状況</h2>
        <div class="reservation__card">
            <div class="reservation__card-header">
                <span class="reservation__icon">⏰</span>
                <h3 class="reservation__card-title">予約1</h3>
                <button class="reservation__close-button">✖</button>
            </div>
            <ul class="reservation__details">
                <li class="reservation__detail">Shop: 仙人</li>
                <li class="reservation__detail">Date: 2021-04-01</li>
                <li class="reservation__detail">Time: 17:00</li>
                <li class="reservation__detail">Number: 1人</li>
            </ul>
        </div>
    </section>

    <section class="favorites">
        <h2 class="favorites__title">お気に入り店舗</h2>
        <div class="favorites__list">
            <article class="favorites__item">
                <div class="favorites__image">
                    <img src="sushi.jpg" alt="仙人の画像">
                </div>
                <div class="favorites__details">
                    <h3 class="favorites__name">仙人</h3>
                    <p class="favorites__tags">#東京都 #寿司</p>
                    <button class="favorites__button">詳しくみる</button>
                </div>
                <div class="favorites__favorite">
                    <button class="favorites__favorite-button">❤️</button>
                </div>
            </article>

            <article class="favorites__item">
                <div class="favorites__image">
                    <img src="yakiniku.jpg" alt="牛助の画像">
                </div>
                <div class="favorites__details">
                    <h3 class="favorites__name">牛助</h3>
                    <p class="favorites__tags">#大阪府 #焼肉</p>
                    <button class="favorites__button">詳しくみる</button>
                </div>
                <div class="favorites__favorite">
                    <button class="favorites__favorite-button">❤️</button>
                </div>
            </article>
        </div>
    </section>
</main>

@endsection