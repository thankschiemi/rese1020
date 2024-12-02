@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin_home.css') }}">
@endsection

@section('content')
<main class="admin-dashboard">
    <h1 class="admin-dashboard__title">管理画面トップ</h1>
    <section class="admin-dashboard__menu">
        <ul>
            <li><a href="{{ route('admin.stores.index') }}">店舗管理</a></li>
            <li><a href="{{ route('admin.notifications.index') }}">通知管理</a></li>
        </ul>
    </section>
</main>
@endsection