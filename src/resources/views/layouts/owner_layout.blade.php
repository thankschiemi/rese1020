<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>店舗管理 - Rese</title>
    <!-- Robotoフォントを読み込む -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <a href="{{ route('owner.dashboard') }}" class="icon">
                <div class="icon__line icon__line--medium"></div>
                <div class="icon__line icon__line--long"></div>
                <div class="icon__line icon__line--short"></div>
            </a>
            <a href="{{ route('owner.dashboard') }}" class="header__title">店舗管理</a>

            <nav class="owner-menu">
                <ul>
                    <li><a href="{{ route('owner.dashboard') }}">ダッシュボード</a></li>
                    <li><a href="{{ route('owner.stores.edit') }}">店舗情報</a></li>
                    <li><a href="{{ route('owner.reservations.index') }}">予約管理</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>