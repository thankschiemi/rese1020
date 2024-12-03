@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_store.css') }}">
@endsection

@section('content')
<main class="edit-store">
    <h1 class="edit-store__title">{{ $store ? '店舗情報編集' : '店舗情報作成' }}</h1>
    <form method="POST" action="{{ $store ? route('owner.store_update', $store->id) : route('owner.store_store') }}">
        @csrf
        @if($store)
        @method('PUT')
        @endif

        <label for="name">店舗名</label>
        <input type="text" name="name" value="{{ old('name', $store->name ?? '') }}" required>

        <label for="region_id">地域</label>
        <select name="region_id" required>
            @foreach ($regions as $region)
            <option value="{{ $region->id }}" {{ (old('region_id', $store->region_id ?? '') == $region->id) ? 'selected' : '' }}>{{ $region->name }}</option>
            @endforeach
        </select>

        <label for="genre_id">ジャンル</label>
        <select name="genre_id" required>
            @foreach ($genres as $genre)
            <option value="{{ $genre->id }}" {{ (old('genre_id', $store->genre_id ?? '') == $genre->id) ? 'selected' : '' }}>{{ $genre->name }}</option>
            @endforeach
        </select>

        <label for="description">店舗概要</label>
        <textarea name="description">{{ old('description', $store->description ?? '') }}</textarea>

        <label for="image_url">画像URL</label>
        <input type="text" name="image_url" value="{{ old('image_url', $store->image_url ?? '') }}">

        <button type="submit">{{ $store ? '更新' : '作成' }}</button>
    </form>
</main>
@endsection