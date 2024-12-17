@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/create_store.css') }}">
@endsection

@section('content')
<main class="create-store">
    <a href="/owner/dashboard" class="btn btn-primary">ダッシュボードに戻る</a>
    <h1 class="create-store__title">店舗情報作成</h1>
    @if(session('success'))
    <p class="success-message">{{ session('success') }}</p>
    @endif


    <form method="POST" action="{{ route('owner.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <!-- 店舗名 -->
        <label for="name">店舗名</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}">
        @error('name')
        <div class="error-message">{{ $message }}</div>
        @enderror

        <!-- 地域 -->
        <label for="region_id">地域</label>
        <select name="region_id" id="region_id" required autocomplete="off">
            <option value="" disabled selected>選択してください</option>
            @foreach ($regions as $region)
            <option value="{{ $region->id }}" {{ old('region_id') == $region->id ? 'selected' : '' }}>
                {{ $region->name }}
            </option>
            @endforeach
        </select>
        @error('region_id')
        <div class="error-message">{{ $message }}</div>
        @enderror

        <!-- ジャンル -->
        <label for="genre_id">ジャンル</label>
        <select name="genre_id" id="genre_id" required autocomplete="off">
            <option value="" disabled selected>選択してください</option>
            @foreach ($genres as $genre)
            <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                {{ $genre->name }}
            </option>
            @endforeach
        </select>
        @error('genre_id')
        <div class="error-message">{{ $message }}</div>
        @enderror

        <!-- 店舗概要 -->
        <label for="description">店舗概要</label>
        <textarea name="description" id="description" rows="4" autocomplete="off">{{ old('description') }}</textarea>
        @error('description')
        <div class="error-message">{{ $message }}</div>
        @enderror

        <!-- 店舗画像 -->
        <label for="image">店舗画像</label>
        <input type="file" name="image" id="image">
        @error('image')
        <div class="error-message">{{ $message }}</div>
        @enderror
        <!-- 送信ボタン -->
        <button type="submit">作成</button>
    </form>
</main>
@endsection