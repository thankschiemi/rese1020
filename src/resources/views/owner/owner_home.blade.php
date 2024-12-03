@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome 読み込み -->
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
                <a href="{{ route('owner.edit_store') }}" class="dashboard__link">
                    <i class="fas fa-store"></i> 店舗情報
                </a>
            </li>
            <li>
                <a href="{{ route('owner.reservations.index') }}" class="dashboard__link">
                    <i class="fas fa-calendar-alt"></i> 予約管理
                </a>
            </li>
        </ul>
    </section>
</main>
@endsection