@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_store.css') }}">
@endsection

@section('content')
<main class="edit-store">
    <a href="/owner/dashboard" class="btn btn-primary">ダッシュボードに戻る</a>
    <h1 class="edit-store__title">{{ $store ? '店舗情報編集' : '店舗情報作成' }}</h1>
    <form class="edit-store__form" method="POST" action="{{ $store ? route('owner.update_store', $store->id) : route('owner.store_store') }}" novalidate>
        @csrf
        @if($store)
        @method('PUT')
        @endif

        @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
        @endif

        <div class="edit-store__form-group">
            <label class="edit-store__label" for="name">店舗名</label>
            <input class="edit-store__input" type="text" name="name" value="{{ old('name', $store->name ?? '') }}">
            @error('name')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="edit-store__form-group">
            <label class="edit-store__label" for="region_id">地域</label>
            <select class="edit-store__input" name="region_id" required>
                @foreach ($regions as $region)
                <option value="{{ $region->id }}" {{ (old('region_id', $store->region_id ?? '') == $region->id) ? 'selected' : '' }}>{{ $region->name }}</option>
                @endforeach
            </select>
            @error('region_id')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="edit-store__form-group">
            <label class="edit-store__label" for="genre_id">ジャンル</label>
            <select class="edit-store__input" name="genre_id" required>
                @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" {{ (old('genre_id', $store->genre_id ?? '') == $genre->id) ? 'selected' : '' }}>{{ $genre->name }}</option>
                @endforeach
            </select>
            @error('genre_id')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="edit-store__form-group">
            <label class="edit-store__label" for="description">店舗概要</label>
            <textarea class="edit-store__input" name="description">{{ old('description', $store->description ?? '') }}</textarea>
            @error('description')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="edit-store__form-group">
            <label class="edit-store__label" for="image_url">画像URL</label>
            <input class="edit-store__input" type="text" name="image_url" value="{{ old('image_url', $store->image_url ?? '') }}">
            @error('image_url')
            <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button class="edit-store__button" type="submit">{{ $store ? '更新' : '作成' }}</button>
    </form>
</main>
@endsection