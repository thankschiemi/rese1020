@extends('layouts.admin_layout')

@section('content')
<div class="manage-stores">
    <h1>店舗管理</h1>
    <p>現在登録されている店舗代表者一覧です。</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>名前</th>
                <th>メールアドレス</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            {{-- ダミーデータ --}}
            <tr>
                <td>1</td>
                <td>山田 太郎</td>
                <td>owner@example.com</td>
                <td>
                    <button>編集</button>
                    <button>削除</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection