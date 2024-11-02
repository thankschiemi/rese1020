@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common_restaurant.css') }}">
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@section('content')
<main class="mypage">
    <p class="mypage__user-name">ゲストさん</p>

    <!-- 予約情報の表示 -->
    @forelse ($reservations as $reservation)
    <div class="reservation-card">
        <div class="reservation__card-header">
            <div class="reservation__icon">
                <img src="{{ asset('image/clock-image-20241022.png') }}" alt="時計アイコン">
            </div>
            <h3 class="reservation__card-title">予約{{ $loop->iteration }}</h3>
            <button class="reservation__close-button">
                <img src="{{ asset('image/Butt_white-image-20241022.png') }}" alt="閉じるボタン">
            </button>
        </div>
        <ul class="reservation-card__details">
            <li class="reservation-card__detail">Shop: {{ $reservation->restaurant->name }}</li>
            <li class="reservation-card__detail">Date: {{ $reservation->reservation_date }}</li>
            <li class="reservation-card__detail">Time: {{ $reservation->reservation_time }}</li>
            <li class="reservation-card__detail">Number: {{ $reservation->number_of_people }}人</li>
        </ul>
    </div>
    @empty
    <p class="no_results">予約情報がありません。</p>
    @endforelse

    <!-- お気に入り店舗の表示 -->
    <h2 class="mypage__section-title">お気に入り店舗</h2>
    @forelse ($favorites as $favorite)
    <article class="restaurant">
        <div class="restaurant__image">
            <img src="{{ $favorite->restaurant->image_url }}" alt="店舗画像" class="login_icon">
        </div>
        <div class="restaurant__details">
            <h2 class="restaurant__name">{{ $favorite->restaurant->name }}</h2>
            <p class="restaurant__tags">#{{ $favorite->restaurant->region->name }} #{{ $favorite->restaurant->genre->name }}</p>
            <div class="restaurant_buttons">
                <a href="{{ route('restaurants.detail', $favorite->restaurant->id) }}" class="restaurant_button">詳しくみる</a>
                <button class="favorites__favorite-button">❤️</button>
            </div>
        </div>
    </article>
    @empty
    <p class="no_results">お気に入り店舗がありません。</p>
    @endforelse
</main>
@endsection