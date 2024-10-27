@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurant_all.css') }}">
@endsection

@section('content')

<div class="restaurant__container">
    <form method="GET" action="{{ route('restaurants.index') }}" class="filter">
        <select name="region_id" class="filter__area" onchange="this.form.submit()">
            <option value="">All area</option>
            <option value="tokyo">Tokyo</option>
            <option value="osaka">Osaka</option>
            <option value="fukuoka">Fukuoka</option>
        </select>

        <select name="genre_id" class="filter__genre" onchange="this.form.submit()">
            <option value="">All genre</option>
            <option value="sushi">寿司</option>
            <option value="yakiniku">焼肉</option>
            <option value="izakaya">居酒屋</option>
            <option value="itarian">イタリアン</option>
        </select>

        <input type="search" name="keyword" class="filter__search" placeholder="Search ..." value="{{ request('keyword') }}">
    </form>


    <main class="page__content">
        <section class="restaurant-list">
            @foreach ($restaurants as $restaurant)
            <article class="restaurant">
                <div class="restaurant__image">
                    <img src="{{ asset('image/' . $restaurant->image_url) }}" alt="店舗画像" class="login__icon">
                </div>
                <div class="restaurant__details">
                    <h2 class="restaurant__name">{{ $restaurant->name }}</h2>
                    <p class="restaurant__tags">#{{ $restaurant->region->name }} #{{ $restaurant->genre->name }}</p>
                    <a href="{{ route('restaurants.detail', $restaurant->id) }}" class="restaurant__button">詳しくみる</a>
                </div>
                <div class="restaurant__favorite">
                    <button class="restaurant__favorite-button"></button>
                </div>
            </article>
            @endforeach
        </section>

    </main>

    @endsection