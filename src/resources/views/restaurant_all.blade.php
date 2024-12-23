@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/restaurant_all.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/common_restaurant.css') }}?v={{ time() }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ time() }}">

@endsection

@section('header_filters')
<div class="header_filters">
    <form method="GET" action="{{ route('restaurants.index') }}" class="filter">
        <div class="filter-wrapper">
            <div class="filter-select">
                <select name="region_id" class="filter_area" onchange="this.form.submit()">
                    <option value="">All area</option>
                    @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ request('region_id') == $region->id ? 'selected' : '' }}>
                        {{ $region->name }}
                    </option>
                    @endforeach
                </select>
                <div class="dropdown-icon">▼</div>
            </div>
        </div>
        <div class="filter-wrapper">
            <div class="filter-select">
                <select name="genre_id" class="filter_genre" onchange="this.form.submit()">
                    <option value="">All genre</option>
                    @foreach ($genres as $genre)
                    <option value="{{ $genre->id }}" {{ request('genre_id') == $genre->id ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                    @endforeach
                </select>
                <div class="dropdown-icon">▼</div>
            </div>
        </div>
        <div class="filter-wrapper">
            <div class="filter-select">
                <label for="keyword" class="sr-only">Search</label>
                <img src="{{ asset('images/glass-icon.png') }}" alt="Search Icon" class="search-icon">

                <input type="search" id="keyword" name="keyword" class="filter_search" placeholder="Search ..." value="{{ request('keyword') }}">
            </div>
        </div>
    </form>
</div>
@endsection

@section('content')
<div class="page_content" id="restaurants-favorite-section">
    @forelse ($restaurants as $restaurant)
    <article class="restaurant" data-restaurant-id="{{ $restaurant->id }}">
        @if ($restaurant->image_url)
        <img src="{{ asset('storage/' . $restaurant->image_url) }}" alt="店舗画像">
        @else
        <img src="{{ asset('images/default-image.png') }}" alt="デフォルト画像" class="default-image">
        @endif

        <div class="restaurant__details">
            <h2 class="restaurant__name">{{ $restaurant->name }}</h2>
            <p class="restaurant__tags">#{{ $restaurant->region->name }} #{{ $restaurant->genre->name }}</p>
            <div class="restaurant_buttons">
                <a href="{{ route('restaurants.detail', $restaurant->id) }}" class="restaurant_button" aria-label="詳しくみるボタン">詳しくみる</a>
                <button class="restaurant_favorite-button {{ $restaurant->is_favorite ? 'active' : '' }}" aria-label="お気に入り追加">
                    ❤
                </button>
            </div>
        </div>
    </article>
    @empty
    <p class="no_results">該当する飲食店は見つかりませんでした。</p>
    @endforelse
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.restaurant_favorite-button').forEach(button => {
            button.addEventListener('click', function() {
                const restaurantId = this.closest('.restaurant').dataset.restaurantId;

                fetch(`/favorites/${restaurantId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            console.error('HTTP Error:', response.status, response.statusText);
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.isFavorite) {
                            this.classList.add('active');
                        } else {
                            this.classList.remove('active');
                        }
                    })
                    .catch(error => {
                        console.error('Fetch Error:', error);
                    });
            });
        });
    });
</script>


@endsection