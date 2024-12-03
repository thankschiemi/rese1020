@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_store.css') }}">
@endsection

@section('content')
<main class="edit-store">
    <h1 class="edit-store__title">店舗情報作成</h1>
    <form action="{{ route('owner.stores.update', $store->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">店舗名</label>
        <input type="text" name="name" id="name" value="{{ old('name', $store->name) }}" required>

        <label for="region_id">地域</label>
        <select name="region_id" id="region_id">
            @foreach ($regions as $region)
            <option value="{{ $region->id }}" {{ $store->region_id == $region->id ? 'selected' : '' }}>
                {{ $region->name }}
            </option>
            @endforeach
        </select>

        <label for="genre_id">ジャンル</label>
        <select name="genre_id" id="genre_id">
            @foreach ($genres as $genre)
            <option value="{{ $genre->id }}" {{ $store->genre_id == $genre->id ? 'selected' : '' }}>
                {{ $genre->name }}
            </option>
            @endforeach
        </select>

        <label for="description">店舗概要</label>
        <textarea name="description" id="description">{{ old('description', $store->description) }}</textarea>

        <label for="image_url">画像URL</label>
        <input type="text" name="image_url" id="image_url" value="{{ old('image_url', $store->image_url) }}">

        <button type="submit">更新</button>
    </form>

</main>
@endsection