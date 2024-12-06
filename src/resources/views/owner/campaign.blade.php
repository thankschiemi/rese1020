@extends('layouts.rese_layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/campaign.css') }}">

<main class="notification">
    <a href="{{ route('owner.dashboard') }}" class="notification__back-btn">ダッシュボードに戻る</a>
    <h1 class="notification__title">キャンペーン・お知らせメール送信</h1>
    <p class="notification__description">
        このフォームを使って、利用者様にキャンペーンやお知らせメールを送信できます。
    </p>

    @if (session('success'))
    <p class="notification__success">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('owner.sendNotification') }}" class="notification__form">
        @csrf
        <div class="notification__form-group">
            <label for="subject" class="notification__label">件名:</label>
            <input type="text" id="subject" name="subject" class="notification__input" value="{{ old('subject') }}">
        </div>

        <div class="notification__form-group">
            <label for="message" class="notification__label">内容:</label>
            <textarea id="message" name="message" class="notification__textarea">{{ old('message', '') }}</textarea>

        </div>

        <button type="submit" class="notification__button">送信</button>
    </form>
</main>
@endsection