<!DOCTYPE html>
<html>

<head>
    <title>予約リマインダー</title>
</head>

<body>
    <p>{{ $reservation->member->name }} 様</p>

    <p>本日は、以下の予約があります:</p>
    <ul>
        <li><strong>店舗:</strong> {{ $reservation->restaurant->name ?? '店舗情報がありません' }}</li>
        <li><strong>予約日:</strong> {{ $reservation->reservation_date }}</li>
        <li><strong>予約時間:</strong> {{ date('H:i', strtotime($reservation->reservation_time)) }}</li>
    </ul>
    <p>お気をつけてお越しください。</p>
</body>

</html>