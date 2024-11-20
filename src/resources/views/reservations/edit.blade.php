@extends('layouts.rese_layout')

@section('content')
<main class="edit-reservation">
    <h1>予約編集</h1>
    <form method="POST" action="{{ route('reserve.update', $reservation->id) }}">
        @csrf
        @method('PUT')
        <label for="reservation_date">日付:</label>
        <input type="date" id="reservation_date" name="reservation_date" value="{{ $reservation->reservation_date }}">

        <label for="reservation_time">時間:</label>
        <input type="time" id="reservation_time" name="reservation_time" value="{{ $reservation->reservation_time }}">

        <label for="number_of_people">人数:</label>
        <input type="number" id="number_of_people" name="number_of_people" value="{{ $reservation->number_of_people }}">

        <button type="submit">変更する</button>
    </form>
</main>

@endsection