@extends('layouts.rese_layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/store_list.css') }}">
<main class="store-list">
    <a href="/owner/dashboard" class="btn btn-primary">ダッシュボードに戻る</a>
    <h1 class="store-list__title">{{ $user->name }}さんの店舗一覧</h1>
    @if(session('success'))
    <p class="success-message">{{ session('success') }}</p>
    @endif



    @if ($stores && $stores->count() > 0)
    <table class="store-list__table">
        <thead>
            <tr>
                <th>店舗名</th>
                <th>地域</th>
                <th>ジャンル</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stores as $store)
            <tr>
                <td>{{ $store->name }}</td>
                <td>{{ $store->region->name ?? '未設定' }}</td>
                <td>{{ $store->genre->name ?? '未設定' }}</td>
                <td><a href="{{ route('owner.store_edit', $store->id) }}">編集</a></td>

            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>店舗情報が見つかりません。新しく店舗を登録してください。</p>
    @endif
</main>
@endsection