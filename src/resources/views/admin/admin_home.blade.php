@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome 読み込み -->
@endsection

@section('content')
<main class="dashboard">
    <h1 class="dashboard__title">
        Admin Dashboard
        <span class="dashboard__subtitle">管理画面</span>
    </h1>
    <section class="dashboard__menu">
        <ul>
            <li>
                <a href="{{ route('admin.stores.index') }}" class="dashboard__link">
                    <i class="fas fa-store"></i> 店舗管理
                </a>
            </li>
            <li>
                <a href="{{ route('admin.notifications.index') }}" class="dashboard__link">
                    <i class="fas fa-bell"></i> 通知管理
                </a>
            </li>
        </ul>
    </section>
</main>
@endsection