@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurant_all.css') }}">
<link rel="stylesheet" href="{{ asset('css/common_restaurant.css') }}">
@endsection

@section('header_filters')
<div class="header_filters">
    <form method="GET" action="{{ route('restaurants.index') }}" class="filter">
        <div class="filter-wrapper">
            <select name="region_id" class="filter_area">
                <option value="">All area</option>
                @foreach ($regions as $region)
                <option value="{{ $region->id }}" {{ request('region_id') == $region->id ? 'selected' : '' }}>
                    {{ $region->name }}
                </option>
                @endforeach
            </select>
            <div class="dropdown-icon">▼</div>
        </div>

        <div class="filter-wrapper">
            <select name="genre_id" class="filter_genre">
                <option value="">All genre</option>
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                    {{ $genre->name }}
                </option>
                @endforeach
            </select>
            <div class="dropdown-icon">▼</div>
        </div>

        <div class="search-container">
            <img src="{{ asset('image/magnifying-glass-icon.png') }}" alt="Search Icon" class="search-icon">
            <input type="search" name="keyword" class="filter_search" placeholder="Search ..." value="{{ request('keyword') }}">
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="page_content">
    @forelse ($restaurants as $restaurant)
    <article class="restaurant">
        <div class="restaurant__image">
            <img src="{{ $restaurant->image_url }}" alt="店舗画像" class="login_icon">
        </div>
        <div class="restaurant__details">
            <h2 class="restaurant__name">{{ $restaurant->name }}</h2>
            <p class="restaurant__tags">#{{ $restaurant->region->name }} #{{ $restaurant->genre->name }}</p>
            <div class="restaurant_buttons">
                <a href="{{ route('restaurants.detail', $restaurant->id) }}" class="restaurant_button">詳しくみる</a>

                <form action="{{ route('favorites.store', ['restaurant_id' => $restaurant->id]) }}" method="POST">
                    @csrf
                    <button class="restaurant_favorite-button {{ $restaurant->is_favorite ? 'active' : '' }}">❤️</button>
                </form>
            </div>
        </div>
    </article>
    @empty
    <p class="no_results">該当する飲食店は見つかりませんでした。</p>
    @endforelse
</div>
@endsection