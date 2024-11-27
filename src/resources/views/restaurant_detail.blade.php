@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurant_detail.css') }}">
@endsection

@section('content')

<main class="shop-page__content">
    <!-- レストラン情報の表示 -->
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

        <!-- フォーム -->
        <form action="{{ route('reserve.store') }}" method="POST" class="reservation-form__form" novalidate>
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <input type="hidden" name="member_id" value="1">

            <!-- 日付フィールド -->
            <div class="reservation-form__group">
                <label for="date" class="reservation-form__label"></label>
                <input type="date" id="date" name="date"
                    value="{{ old('date') }}"
                    class="reservation-form__input reservation-form__input--date @error('date') is-invalid @enderror" required>
                @error('date')
                <div class="reservation-form__error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- 時間フィールド -->
            <div class="reservation-form__group">
                <label for="time" class="reservation-form__label"></label>
                <select id="time" name="time"
                    class="reservation-form__select reservation-form__select--time" required>
                    <option value="" disabled {{ old('time') ? '' : 'selected' }}>時間を選択</option>
                    <option value="09:00" {{ old('time') == '09:00' ? 'selected' : '' }}>09:00</option>
                    <option value="10:00" {{ old('time') == '10:00' ? 'selected' : '' }}>10:00</option>
                    <option value="11:00" {{ old('time') == '11:00' ? 'selected' : '' }}>11:00</option>
                    <option value="12:00" {{ old('time') == '12:00' ? 'selected' : '' }}>12:00</option>
                    <option value="13:00" {{ old('time') == '13:00' ? 'selected' : '' }}>13:00</option>
                    <option value="14:00" {{ old('time') == '14:00' ? 'selected' : '' }}>14:00</option>
                    <option value="15:00" {{ old('time') == '15:00' ? 'selected' : '' }}>15:00</option>
                    <option value="16:00" {{ old('time') == '16:00' ? 'selected' : '' }}>16:00</option>
                    <option value="17:00" {{ old('time') == '17:00' ? 'selected' : '' }}>17:00</option>
                    <option value="18:00" {{ old('time') == '18:00' ? 'selected' : '' }}>18:00</option>
                    <option value="19:00" {{ old('time') == '19:00' ? 'selected' : '' }}>19:00</option>
                    <option value="20:00" {{ old('time') == '20:00' ? 'selected' : '' }}>20:00</option>
                    <option value="21:00" {{ old('time') == '21:00' ? 'selected' : '' }}>21:00</option>
                    <option value="22:00" {{ old('time') == '22:00' ? 'selected' : '' }}>22:00</option>
                </select>
                @error('time')
                <div class="reservation-form__error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- 人数フィールド -->
            <div class="reservation-form__group">
                <label for="number" class="reservation-form__label"></label>
                <select id="number" name="number"
                    class="reservation-form__select reservation-form__select--people" required>
                    <option value="" disabled {{ old('number') ? '' : 'selected' }}>人数を選択</option>
                    <option value="1" {{ old('number') == 1 ? 'selected' : '' }}>1人</option>
                    <option value="2" {{ old('number') == 2 ? 'selected' : '' }}>2人</option>
                    <option value="3" {{ old('number') == 3 ? 'selected' : '' }}>3人</option>
                    <option value="4" {{ old('number') == 4 ? 'selected' : '' }}>4人</option>
                    <option value="5" {{ old('number') == 5 ? 'selected' : '' }}>5人</option>
                    <option value="6" {{ old('number') == 6 ? 'selected' : '' }}>6人</option>
                    <option value="7" {{ old('number') == 7 ? 'selected' : '' }}>7人</option>
                    <option value="8" {{ old('number') == 8 ? 'selected' : '' }}>8人</option>
                    <option value="9" {{ old('number') == 9 ? 'selected' : '' }}>9人</option>
                    <option value="10" {{ old('number') == 10 ? 'selected' : '' }}>10人以上</option>
                </select>
                @error('number')
                <div class="reservation-form__error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- 予約するボタン -->
            <button type="submit" name="action" value="reserve"
                class="reservation-form__button--submit">予約する</button>
        </form>
    </section>
    <!-- 予約詳細エリア -->
    <section class="reservation-summary__container">
        <div class="reservation-summary">
            <p class="reservation-summary__text">
                <strong>Shop</strong> {{ $restaurant->name }}
            </p>
            <p class="reservation-summary__text">
                <strong>Date</strong> {{ $latest_reservation ? $latest_reservation->reservation_date : 'N/A' }}
            </p>
            <p class="reservation-summary__text">
                <strong>Time</strong>
                {{ $latest_reservation ? \Carbon\Carbon::parse($latest_reservation->reservation_time)->format('H:i') : 'N/A' }}
            </p>
            <p class="reservation-summary__text">
                <strong>Number</strong> {{ $latest_reservation ? $latest_reservation->number_of_people : 'N/A' }}人
            </p>
        </div>
    </section>


</main>

@endsection