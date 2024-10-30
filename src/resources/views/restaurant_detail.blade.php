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

        {{-- フォーム --}}
        <form action="{{ route('reserve.store') }}" method="POST" class="reservation-form__form">
            @csrf
            <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
            <input type="hidden" name="member_id" value="1"> <!-- 仮に1と設定 -->

            <div class="reservation-form__group">
                <label for="date" class="reservation-form__label">Date</label>
                <input type="date" id="date" name="date" value="{{ old('date') }}" class="reservation-form__input" required>
                @error('date')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="reservation-form__group">
                <label for="time" class="reservation-form__label">Time</label>
                <input type="time" id="time" name="time" value="{{ old('time') }}" class="reservation-form__input" required>
                @error('time')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="reservation-form__group">
                <label for="number" class="reservation-form__label">Number</label>
                <select id="number" name="number" class="reservation-form__select" required>
                    <option value="1" {{ old('number') == 1 ? 'selected' : '' }}>1人</option>
                    <option value="2" {{ old('number') == 2 ? 'selected' : '' }}>2人</option>
                    <option value="3" {{ old('number') == 3 ? 'selected' : '' }}>3人</option>
                    <option value="4" {{ old('number') == 4 ? 'selected' : '' }}>4人</option>
                </select>
                @error('number')
                <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- 予約詳細の表示 -->
            @if(Session::has('reservation_preview'))
            <div class="reservation-summary">

                <div class="reservation-summary__item">
                    <p><strong>Shop</strong> {{ Session::get('reservation_preview.restaurant_name') ?? $restaurant->name }}</p>
                    <p><strong>Date</strong> {{ Session::get('reservation_preview.date') ?? 'N/A' }}</p>
                    <p><strong>Time</strong> {{ Session::get('reservation_preview.time') ?? 'N/A' }}</p>
                    <p><strong>Number</strong> {{ Session::get('reservation_preview.number') ?? 'N/A' }}人</p>
                </div>
            </div>
            @endif

            <!-- 確認ボタンと予約ボタン -->
            <button type="submit" name="action" value="preview" class="reservation-form__preview-button">確認</button>
            @if(Session::has('reservation_preview'))
            <button type="submit" name="action" value="reserve" class="reservation-form__submit-button">予約する</button>
            @endif
        </form>
    </section>

</main>

@endsection