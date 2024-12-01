@extends('layouts.owner_layout')

@section('content')
<main>
    <h1>店舗情報編集</h1>
    <form action="{{ route('owner.stores.update') }}" method="POST">
        @csrf
        <!-- 店舗情報の編集フォーム -->
        <div>
            <label for="name">店舗名</label>
            <input type="text" id="name" name="name" value="{{ old('name', $store->name ?? '') }}">
        </div>
        <button type="submit">更新</button>
    </form>
</main>
@endsection