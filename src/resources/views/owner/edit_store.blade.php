@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/edit_store.css') }}">
@endsection

@section('content')
<main class="edit-store">


    <h1 class="edit-store__title">店舗情報作成</h1>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form method="POST" action="{{ route('owner.store_store') }}">
        @csrf

        <label for="name">店舗名</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label for="region_id">地域</label>
        <select name="region_id" required>
            @foreach ($regions as $region)
            <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                {{ $region->name }}
            </option>
            @endforeach
        </select>

        <label for="genre_id">ジャンル</label>
        <select name="genre_id" required>
            @foreach ($genres as $genre)
            <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                {{ $genre->name }}
            </option>
            @endforeach
        </select>

        <label for="description">店舗概要</label>
        <textarea name="description">{{ old('description') }}</textarea>

        <label for="image_url">画像URL</label>
        <input type="text" name="image_url" value="{{ old('image_url') }}">

        <button type="submit">作成</button>
    </form>
</main>

@endsection