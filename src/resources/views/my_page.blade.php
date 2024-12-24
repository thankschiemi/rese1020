@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/common_restaurant.css') }}">
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
@endsection

@section('content')
<main class="mypage">
    <div class="mypage__content">

        <!-- 左カラム：予約情報 -->
        <section class="mypage__reservations">
            <!-- フラッシュメッセージ表示 -->
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <h2 class="mypage__status-title">予約状況</h2>
            @forelse ($reservations as $reservation)
            <div class="reservation-card" data-reservation-id="{{ $reservation->id }}">
                <div class="reservation__card-header">
                    <div class="reservation__icon">
                        <img src="{{ asset('images/clock-image-20241022.png') }}" alt="時計アイコン">
                    </div>
                    <h3 class="reservation__card-title">予約{{ $loop->iteration }}</h3>
                </div>
                <form method="POST" action="{{ route('reserve.destroy', $reservation->id) }}" class="reservation__close-button">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="close-icon"></button>
                </form>
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
                        <span class="detail-value">{{ date('H:i', strtotime($reservation->reservation_time)) }}</span>
                    </li>
                    <li class="reservation-card__detail">
                        <span class="detail-label">Number</span>
                        <span class="detail-value">{{ $reservation->number_of_people }}人</span>
                    </li>
                </ul>
                <div class="reservation-card__buttons">
                    <a href="{{ route('reserve.edit', $reservation->id) }}" class="reservation-card__button reservation-card__button--change">予約の変更</a>
                    <button type="button" class="reservation-card__button reservation-card__button--refresh" onclick="location.reload();">更新</button>
                    <a href="{{ route('reviews.create', $reservation->id) }}" class="reservation-card__button reservation-card__button--rate">評価</a>
                </div>
                <div class="qr-code-wrapper">
                    <div class="qr-code">
                        {!! QrCode::encoding('UTF-8')->size(100)->generate($reservation->qrData) !!}
                    </div>
                    <p class="qr-instruction">このQRコードを店舗スタッフに提示してください</p>
                </div>
            </div>
            @empty
            <p class="no_results">予約情報がありません。</p>
            @endforelse
        </section>

        <!-- 右カラム：お気に入り店舗 -->
        <section id="mypage-favorite-section" class="mypage__favorites">
            <p class="mypage__user-name">{{ $user->name }}さん</p>
            <h2 class="mypage__section-title">お気に入り店舗</h2>
            <div class="favorites__list">
                @forelse ($favorites as $favorite)
                <article class="restaurant" data-restaurant-id="{{ $favorite->restaurant->id }}">
                    <div class="restaurant__image">
                        @if ($favorite->restaurant->image_url)
                        <img src="{{ asset('storage/' . $favorite->restaurant->image_url) }}" alt="店舗画像" class="restaurant__image">
                        @else
                        <img src="{{ asset('images/default-image.png') }}" alt="デフォルト画像" class="default-image">
                        @endif
                    </div>
                    <div class="restaurant__details">
                        <h2 class="restaurant__name">{{ $favorite->restaurant->name }}</h2>
                        <p class="restaurant__tags">#{{ $favorite->restaurant->region->name }} #{{ $favorite->restaurant->genre->name }}</p>
                        <div class="restaurant_buttons">
                            <a href="{{ route('restaurants.detail', $favorite->restaurant->id) }}" class="restaurant_button">詳しくみる</a>
                            <button class="restaurant_favorite-button {{ $favorite->restaurant->is_favorite ? 'active' : '' }}">❤</button>
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

<script>
    document.querySelectorAll('.restaurant_favorite-button').forEach(button => {
        button.addEventListener('click', function() {
            const restaurantId = this.closest('.restaurant').dataset.restaurantId;

            fetch(`/favorites/${restaurantId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.isFavorite) {
                        this.classList.add('active');
                    } else {
                        this.classList.remove('active');
                        this.closest('.restaurant').remove();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    });
</script>

@endsection