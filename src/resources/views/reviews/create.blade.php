@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/review_create.css') }}">
@endsection

@section('content')
<main class="review">
    <section class="review__create">
        <h1 class="review__title">評価を作成</h1>
        <form method="POST" action="{{ route('reviews.store') }}" class="review__form">
            @csrf
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
            <input type="hidden" name="restaurant_id" value="{{ $reservation->restaurant->id }}">

            <div class="review__form-group">
                <label for="rating" class="review__label">評価 (1～5)</label>
                <select id="rating" name="rating" class="review__select" required>
                    <option value="1">1 - 非常に良い</option>
                    <option value="2">2 - 良い</option>
                    <option value="3">3 - 普通</option>
                    <option value="4">4 - 悪い</option>
                    <option value="5">5 - 非常に悪い</option>
                </select>
            </div>

            <div class="review__form-group">
                <label for="comment" class="review__label">コメント</label>
                <textarea id="comment" name="comment" rows="4" class="review__textarea" placeholder="店舗へのコメントを記入してください"></textarea>
            </div>

            <button type="submit" class="review__button">送信</button>
        </form>
    </section>

    <section class="review__list">
        <h2 class="review__list-title">評価一覧</h2>
        @if($reviews->isEmpty())
        <p class="review__no-data">まだ評価はありません。</p>
        @else
        @foreach($reviews as $review)
        <div class="review__item">
            <p class="review__rating">評価: {!! str_repeat('★', $review->rating) !!}{!! str_repeat('☆', 5 - $review->rating) !!} ({{ $review->rating }} / 5)</p>
            <p class="review__comment">コメント: {{ $review->comment }}</p>
            <p class="review__date">投稿日: {{ $review->created_at->format('Y-m-d') }}</p>
        </div>
        @endforeach

        <div class="review__pagination">
            {{ $reviews->links() }}
        </div>


        @endif
    </section>
</main>

@endsection