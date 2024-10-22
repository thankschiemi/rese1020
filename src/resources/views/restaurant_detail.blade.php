@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurant_detail.css') }}">
@endsection

@section('content')

<main class="shop-page__content">
    <section class="shop-info">
        <button class="shop-info__back-button">◀</button>
        <h2 class="shop-info__name">仙人</h2>
        <div class="shop-info__image">
            <img src="sushi.jpg" alt="仙人の画像">
        </div>
        <p class="shop-info__tags">#東京都 #寿司</p>
        <p class="shop-info__description">
            料理長厳選の食材から作る寿司を用いたコースをぜひお楽しみください。食材・味・価格、
            お客様の満足度を徹底的に追及したお店です。特別な日のお食事、ビジネス接待まで
            気軽に使用することができます。
        </p>
    </section>

    <section class="reservation-form">
        <h2 class="reservation-form__title">予約</h2>
        <form class="reservation-form__form">
            <div class="reservation-form__group">
                <label for="date" class="reservation-form__label">Date</label>
                <input type="date" id="date" name="date" class="reservation-form__input">
            </div>
            <div class="reservation-form__group">
                <label for="time" class="reservation-form__label">Time</label>
                <input type="time" id="time" name="time" class="reservation-form__input">
            </div>
            <div class="reservation-form__group">
                <label for="number" class="reservation-form__label">Number</label>
                <select id="number" name="number" class="reservation-form__select">
                    <option value="1">1人</option>
                    <option value="2">2人</option>
                    <option value="3">3人</option>
                    <option value="4">4人</option>
                </select>
            </div>

            <div class="reservation-form__summary">
                <p class="reservation-form__summary-item">Shop: 仙人</p>
                <p class="reservation-form__summary-item">Date: 2021-04-01</p>
                <p class="reservation-form__summary-item">Time: 17:00</p>
                <p class="reservation-form__summary-item">Number: 1人</p>
            </div>

            <button type="submit" class="reservation-form__submit-button">予約する</button>
        </form>
    </section>
</main>

@endsection