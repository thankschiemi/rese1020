@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> <!-- Font Awesome 読み込み -->
@endsection

@section('content')
<main class="dashboard">
    <h1 class="dashboard__title">
        Owner Dashboard
        <span class="dashboard__subtitle">店舗管理画面</span>
    </h1>

    <section class="dashboard__menu">
        <ul>
            <li>
                <a href="{{ route('owner.create_store') }}" class="dashboard__link">
                    <i class="fas fa-store"></i> 店舗情報作成
                </a>
            </li>
            <li>
                <a href="{{ route('owner.store_list') }}" class="dashboard__link">
                    <i class="fas fa-list"></i> 店舗一覧（編集可能）
                </a>
            </li>
            <li>
                <a href="{{ route('owner.reservations.index') }}" class="dashboard__link">
                    <i class="fas fa-calendar-alt"></i> 予約情報確認
                </a>
            </li>
            <li>
                <a href="{{ route('owner.campaign') }}" class="dashboard__link">
                    <i class="fas fa-envelope"></i> メール送信
                </a>
            </li>
        </ul>
    </section>
</main>
@endsection