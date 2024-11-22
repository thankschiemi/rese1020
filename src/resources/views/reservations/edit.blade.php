@extends('layouts.rese_layout')

@section('content')
<main class="edit-reservation">
    <h1>予約編集</h1>
    <form action="{{ route('reserve.update', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="reservation_date">日付:</label>
        <input type="date" name="reservation_date" value="{{ old('reservation_date', $reservation->reservation_date) }}" required>

        <label for="reservation_time">時間:</label>
        <input type="time" name="reservation_time" value="{{ old('reservation_time', date('H:i', strtotime($reservation->reservation_time))) }}" required>


        <label for="number_of_people">人数:</label>
        <input type="number" name="number_of_people" value="{{ old('number_of_people', $reservation->number_of_people) }}" min="1" required>

        <button type="submit">変更する</button>
    </form>

</main>

@endsection