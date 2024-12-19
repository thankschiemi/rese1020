@extends('layouts.rese_layout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/users.css') }}">

<div class="user-management__container">
    <h1 class="user-management__title">ユーザー管理</h1>
</div>

<!-- 新規作成カード -->
<div class="user-management__card user-management__card--form">
    <a href="{{ route('admin.dashboard') }}" class="user-management__back-btn">ダッシュボードに戻る</a>
    <h2 class="user-management__subtitle">店舗代表者の新規作成</h2>
    @if (session('success'))
    <p class="user-management__success">{{ session('success') }}</p>
    @endif
    <form method="POST" action="{{ route('admin.users.store') }}" class="user-management__form" novalidate>
        @csrf
        <div class="user-management__form-group">
            <span class="user-management__icon">
                <i class="fas fa-user"></i>
            </span>
            <input type="text" id="name" name="name" class="user-management__input" placeholder="名前" required>
            @error('name')
            <p class="user-management__error">{{ $message }}</p>
            @enderror
        </div>
        <div class="user-management__form-group">
            <span class="user-management__icon">
                <i class="fas fa-envelope"></i>
            </span>
            <input type="email" id="email" name="email" class="user-management__input" placeholder="メールアドレス" required>
            @error('email')
            <p class="user-management__error">{{ $message }}</p>
            @enderror
        </div>
        <div class="user-management__form-group">
            <span class="user-management__icon">
                <i class="fas fa-lock"></i>
            </span>
            <input type="password" id="password" name="password" class="user-management__input" placeholder="パスワード" required>
            @error('password')
            <p class="user-management__error">{{ $message }}</p>
            @enderror
        </div>
        <div class="user-management__form-group">
            <span class="user-management__icon">
                <i class="fas fa-lock"></i>
            </span>
            <input type="password" id="password_confirmation" name="password_confirmation" class="user-management__input" placeholder="パスワード確認" required>
        </div>
        <button type="submit" class="user-management__button">作成</button>
    </form>
</div>

<!-- 登録済みユーザー権限変更カード -->
<div class="user-management__card user-management__card--table">

    <h2 class="user-management__subtitle">登録済みユーザーの権限変更</h2>
    <p class="user-management__description">登録済みのユーザーの権限を変更できます。</p>

    <table class="user-management__table">
        <thead class="user-management__table-header">
            <tr>
                <th class="user-management__table-header-cell">ID</th>
                <th class="user-management__table-header-cell">名前</th>
                <th class="user-management__table-header-cell">メールアドレス</th>
                <th class="user-management__table-header-cell">現在の権限</th>
                <th class="user-management__table-header-cell">操作</th>
            </tr>
        </thead>
        <tbody class="user-management__table-body">
            @foreach ($users as $user)
            <tr class="user-management__table-row">
                <td class="user-management__table-cell">{{ $user->id }}</td>
                <td class="user-management__table-cell">{{ $user->name }}</td>
                <td class="user-management__table-cell">{{ $user->email }}</td>
                <td class="user-management__table-cell">{{ $user->role }}</td>
                <td class="user-management__table-cell">
                    <form method="POST" action="{{ route('admin.users.updateRole', $user->id) }}" class="user-management__form">
                        @csrf
                        @method('PUT')
                        <select name="role" class="user-management__select" required>
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>利用者</option>
                            <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>店舗代表者</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>管理者</option>
                        </select>
                        <button type="submit" class="user-management__button">変更</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection