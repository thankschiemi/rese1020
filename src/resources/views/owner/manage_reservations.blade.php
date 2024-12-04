@extends('layouts.rese_layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/manage_reservations.css') }}">
<main class="store-list">
    <a href="{{ route('owner.dashboard') }}" class="btn">ダッシュボードに戻る</a>
    <h1 class="store-list__title">予約情報の確認画面</h1>
    <p>{{ Auth::check() ? Auth::user()->name : 'ゲスト' }}さんが管理するすべての店舗の予約情報です。</p>


    @if(!empty($reservations))
    <table class="store-list__table">
        <thead>
            <tr>
                <th>店舗名</th>
                <th>予約のお客様</th>
                <th>日時</th>
                <th>人数</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservations as $reservation)
            <tr>
                <td>{{ optional($reservation->restaurant)->name ?? '店舗なし' }}</td>
                <td>{{ optional($reservation->member)->name ?? '利用者なし' }}</td>
                <td>{{ $reservation->reservation_date ?? '未設定' }} {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</td>
                <td>{{ $reservation->number_of_people ?? '未設定' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>現在予約情報はありません。</p>
    @endif
</main>
@endsection