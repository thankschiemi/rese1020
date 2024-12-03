@extends('layouts.rese_layout')

@section('content')
<div class="notifications-management">
    <h1>通知管理</h1>
    <p>ここから利用者への通知を作成することができます。</p>

    <form action="{{ route('admin.notifications.index') }}" method="POST">
        @csrf
        <label for="notification-title">通知のタイトル</label>
        <input type="text" id="notification-title" name="title" required>

        <label for="notification-content">通知内容</label>
        <textarea id="notification-content" name="content" required></textarea>

        <button type="submit">通知を作成</button>
    </form>
</div>
@endsection