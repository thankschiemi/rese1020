<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rese</title>
    <!-- Robotoフォントを読み込む -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common_butt.css') }}" />
    @yield('css')
</head>

<body>
    <header class="header">
        <!-- ✖アイコン -->
        <div class="icon">
            <a href="{{ $previousUrl ?? route('restaurants.index') }}" class="icon__link">
                <div class="icon__line icon__line--cross"></div>
                <div class="icon__line icon__line--cross"></div>
            </a>
        </div>

    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>