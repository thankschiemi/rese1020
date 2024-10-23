<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rese</title>
    <!-- Robotoフォントを読み込む -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <!-- アイコン -->
            <div class="icon">
                <div class="icon__line icon__line--medium"></div>
                <div class="icon__line icon__line--long"></div>
                <div class="icon__line icon__line--short"></div>
            </div>
            <!-- "Rese" テキスト -->
            <span class="header__title">Rese</span>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>