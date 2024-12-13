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


    <form method="POST" action="{{ route('owner.store') }}">
        @csrf
        <label for="name">店舗名</label>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <label for="region_id">地域</label>
        <select name="region_id" required>
            @foreach ($regions as $region)
            <option value="{{ $region->id }}">{{ $region->name }}</option>
            @endforeach
        </select>

        <label for="genre_id">ジャンル</label>
        <select name="genre_id" required>
            @foreach ($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
            @endforeach
        </select>

        <label for="description">店舗概要</label>
        <textarea name="description">{{ old('description') }}</textarea>

        <label for="image">店舗画像:</label>
        <input type="file" name="image" id="image">

        <button type="submit">作成</button>
    </form>
</main>
@endsection