@extends('layouts.rese_layout')


@section('content')
<h1 class="user-management__title">ユーザー管理</h1>
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
@endsection