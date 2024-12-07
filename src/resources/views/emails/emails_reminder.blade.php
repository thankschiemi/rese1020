<!DOCTYPE html>
<html>

<head>
    <title>予約リマインダー</title>
</head>

<body>
    <p>{{ $reservation->name }} 様</p>
    <p>本日は、以下の予約があります:</p>
    <ul>
        <li><strong>日時:</strong> {{ $reservation->reservation_date }}</li>
        <li><strong>店舗:</strong> {{ optional($reservation->restaurant)->name ?? '店舗情報がありません' }}</li>
    </ul>
    <p>お気をつけてお越しください。</p>
</body>

</html>