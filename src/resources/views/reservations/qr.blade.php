@extends('layouts.rese_layout')

@section('css')
<link rel="stylesheet" href="{{ asset('css/qr_code.css') }}">
@endsection

@section('content')
<main class="qr-code-page">
    <h1 class="qr-code-title">QRコード</h1>
    <div class="qr-code-container">
        {!! QrCode::size(200)->generate($qrData) !!}
    </div>
    <div class="back-to-mypage">
        <a href="{{ route('mypage') }}" class="back-button">マイページに戻る</a>
    </div>
</main>
@endsection