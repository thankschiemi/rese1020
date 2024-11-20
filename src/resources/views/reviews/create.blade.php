@extends('layouts.rese_layout')

@section('content')
<main>
    <h1>評価を作成</h1>
    <form method="POST" action="{{ route('reviews.store') }}">
        @csrf
        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
        <input type="hidden" name="restaurant_id" value="{{ $reservation->restaurant->id }}">

        <label for="rating">評価 (1～5)</label>
        <select id="rating" name="rating" required>
            <option value="1">1 - 非常に悪い</option>
            <option value="2">2 - 悪い</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 良い</option>
            <option value="5">5 - 非常に良い</option>
        </select>

        <label for="comment">コメント</label>
        <textarea id="comment" name="comment" rows="4" placeholder="店舗へのコメントを記入してください"></textarea>

        <button type="submit">送信</button>
    </form>
</main>
@endsection