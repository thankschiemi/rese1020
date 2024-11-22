@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_create.css') }}">
@endsection

@section('content')
<main class="review-create">
    <h1 class="review-create__title">評価を作成</h1>
    <form method="POST" action="{{ route('reviews.store') }}" class="review-create__form">
        @csrf
        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
        <input type="hidden" name="restaurant_id" value="{{ $reservation->restaurant->id }}">

        <div class="review-create__form-group">
            <label for="rating" class="review-create__label">評価 (1～5)</label>
            <select id="rating" name="rating" class="review-create__select" required>
                <option value="1">1 - 非常に良い</option>
                <option value="2">2 - 良い</option>
                <option value="3">3 - 普通</option>
                <option value="4">4 - 悪い</option>
                <option value="5">5 - 非常に悪い</option>
            </select>
        </div>

        <div class="review-create__form-group">
            <label for="comment" class="review-create__label">コメント</label>
            <textarea id="comment" name="comment" rows="4" class="review-create__textarea" placeholder="店舗へのコメントを記入してください"></textarea>
        </div>

        <button type="submit" class="review-create__button">送信</button>
    </form>
</main>
@endsection