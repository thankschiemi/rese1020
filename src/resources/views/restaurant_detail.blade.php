@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurant_detail.css') }}">
@endsection

@section('content')

<main class="shop-page__content">
    <section class="shop-info">
        <div class="shop-info__header">
            <a href="{{ url()->previous() }}" class="shop-info__back-button">◀</a>
            <h2 class="shop-info__name">{{ $restaurant->name }}</h2>
        </div>
        <div class="shop-info__image">
            <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->name }}の画像">
        </div>
        <p class="shop-info__tags">#{{ $restaurant->region->name }} #{{ $restaurant->genre->name }}</p>
        <p class="shop-info__description">
            {{ $restaurant->description }}
        </p>
    </section>

    <!-- 予約フォーム -->
    <section class="reservation-form">
        <h2 class="reservation-form__title">予約</h2>
        <form action="{{ route('reserve.store') }}" method="POST" class="reservation-form__form">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <input type="hidden" name="member_id" value="1"> <!-- 仮に1と設定 -->

            <div class="reservation-form__group">
                <label for="date" class="reservation-form__label">Date</label>
                <input type="date" id="date" name="date" class="reservation-form__input" required>
                @error('date')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="reservation-form__group">
                <label for="time" class="reservation-form__label">Time</label>
                <input type="time" id="time" name="time" class="reservation-form__input" required>
                @error('time')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="reservation-form__group">
                <label for="number" class="reservation-form__label">Number</label>
                <select id="number" name="number" class="reservation-form__select" required>
                    <option value="1">1人</option>
                    <option value="2">2人</option>
                    <option value="3">3人</option>
                    <option value="4">4人</option>
                </select>
                @error('number')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="reservation-summary">
                <div class="reservation-summary__item">
                    <p><strong>Shop</strong> {{ Session::get('reservation.restaurant_name') ?? $restaurant->name }}</p>
                    <p><strong>Date</strong> {{ Session::get('reservation.date') ?? 'N/A' }}</p>
                    <p><strong>Time</strong> {{ Session::get('reservation.time') ?? 'N/A' }}</p>
                    <p><strong>Number</strong> {{ Session::get('reservation.number') ?? 'N/A' }}人</p>
                </div>
            </div>



            <button type="submit" class="reservation-form__submit-button">予約する</button>
        </form>
    </section>


</main>

@endsection