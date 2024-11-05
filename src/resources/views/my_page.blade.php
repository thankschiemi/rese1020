@extends('layouts.rese_layout')

@section('css')
@section('css')
<link rel="stylesheet" href="{{ asset('css/common_restaurant.css') }}">
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@endsection

@section('content')
<main class="mypage">
    <div class="mypage__content">
        <!-- 左カラム：予約情報 -->
        <section class="mypage__reservations">
            <h2 class="mypage__status-title">予約状況</h2>
            @forelse ($reservations as $reservation)
            <div class="reservation-card">
                <div class="reservation__card-header">
                    <div class="reservation__icon">
                        <img src="{{ asset('image/clock-image-20241022.png') }}" alt="時計アイコン">
                    </div>
                    <h3 class="reservation__card-title">予約{{ $loop->iteration }}</h3>
                </div>
                <button class="reservation__close-button">
                    <div class="close-icon"></div>
                </button>
                <ul class="reservation-card__details">
                    <li class="reservation-card__detail">
                        <span class="detail-label">Shop</span>
                        <span class="detail-value">{{ $reservation->restaurant->name }}</span>
                    </li>
                    <li class="reservation-card__detail">
                        <span class="detail-label">Date</span>
                        <span class="detail-value">{{ $reservation->reservation_date }}</span>
                    </li>
                    <li class="reservation-card__detail">
                        <span class="detail-label">Time</span>
                        <span class="detail-value">{{ $reservation->reservation_time }}</span>
                    </li>
                    <li class="reservation-card__detail">
                        <span class="detail-label">Number</span>
                        <span class="detail-value">{{ $reservation->number_of_people }}人</span>
                    </li>
                </ul>
            </div>
            @empty
            <p class="no_results">予約情報がありません。</p>
            @endforelse
        </section>

        <!-- 右カラム：お気に入り店舗 -->
        <section class="mypage__favorites">
            <p class="mypage__user-name">ゲストさん</p>
            <h2 class="mypage__section-title">お気に入り店舗</h2>
            <div class="favorites__list">
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
                            <form action="{{ route('favorites.store', ['restaurant_id' => $favorite->restaurant->id]) }}" method="POST">
                                @csrf
                                <button class="restaurant_favorite-button {{ $favorite->restaurant->is_favorite ? 'active' : '' }}">❤️</button>
                            </form>
                        </div>
                    </div>
                </article>
                @empty
                <p class="no_results">お気に入り店舗がありません。</p>
                @endforelse
            </div>
        </section>
    </div>
</main>
@endsection