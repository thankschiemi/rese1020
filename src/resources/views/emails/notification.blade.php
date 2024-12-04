<!DOCTYPE html>
<html>

<head>
    <title>お知らせメール</title>
</head>

<body>
    <h1>{{ $subject }}</h1> <!-- 件名 -->
    <p>こんにちは、{{ $member['name'] ?? 'お客様' }} 様</p>
    <p>{{ $message }}</p> <!-- メール本文 -->
    <p>Reseをご利用いただきありがとうございます。</p>
</body>

</html>