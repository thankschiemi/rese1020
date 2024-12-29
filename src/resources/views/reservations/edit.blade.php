@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_edit.css') }}">
@endsection

@section('content')
<main class="reservation-edit">
    <a href="{{ route('mypage') }}" class="reservation-edit__back-btn">マイページに戻る</a>
    <h1 class="reservation-edit__title">予約変更</h1>
    <form class="reservation-edit__form" action="{{ route('reserve.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- 日付フィールド -->
        <div class="reservation-edit__form-group">
            <label class="reservation-edit__label" for="reservation_date">Date</label>
            <input class="reservation-edit__input @error('reservation_date') is-invalid @enderror" type="date" name="reservation_date" value="{{ old('reservation_date', $reservation->reservation_date) }}" required>
            @error('reservation_date')
            <div class="reservation-edit__error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- 時間フィールド -->
        <div class="reservation-edit__form-group">
            <label class="reservation-edit__label" for="reservation_time">Time</label>
            <input class="reservation-edit__input @error('reservation_time') is-invalid @enderror" type="time" name="reservation_time" value="{{ old('reservation_time', date('H:i', strtotime($reservation->reservation_time))) }}" required>
            @error('reservation_time')
            <div class="reservation-edit__error-message">{{ $message }}</div>
            @enderror
        </div>

        <!-- 人数フィールド -->
        <div class="reservation-edit__form-group">
            <label class="reservation-edit__label" for="number_of_people">Number</label>
            <input class="reservation-edit__input @error('number_of_people') is-invalid @enderror" type="number" name="number_of_people" value="{{ old('number_of_people', $reservation->number_of_people) }}" min="1" required>
            @error('number_of_people')
            <div class="reservation-edit__error-message">{{ $message }}</div>
            @enderror
        </div>

        <button class="reservation-edit__button" type="submit">変更する</button>
    </form>
</main>
@endsection