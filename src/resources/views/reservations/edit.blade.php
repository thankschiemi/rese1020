@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation_edit.css') }}">
@endsection

@section('content')
<main class="reservation-edit">
    <h1 class="reservation-edit__title">予約編集</h1>
    <form class="reservation-edit__form" action="{{ route('reserve.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="reservation-edit__form-group">
            <label class="reservation-edit__label" for="reservation_date">Date</label>
            <input class="reservation-edit__input" type="date" name="reservation_date" value="{{ old('reservation_date', $reservation->reservation_date) }}" required>
        </div>

        <div class="reservation-edit__form-group">
            <label class="reservation-edit__label" for="reservation_time">Time</label>
            <input class="reservation-edit__input" type="time" name="reservation_time" value="{{ old('reservation_time', date('H:i', strtotime($reservation->reservation_time))) }}" required>
        </div>

        <div class="reservation-edit__form-group">
            <label class="reservation-edit__label" for="number_of_people">Number</label>
            <input class="reservation-edit__input" type="number" name="number_of_people" value="{{ old('number_of_people', $reservation->number_of_people) }}" min="1" required>
        </div>

        <button class="reservation-edit__button" type="submit">変更する</button>
    </form>
</main>
@endsection