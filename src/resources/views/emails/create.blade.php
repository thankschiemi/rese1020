<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お知らせメール作成</title>
</head>

<body>
    <h1>お知らせメール作成</h1>

    @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('admin.emails.send') }}" method="POST">
        @csrf
        <label for="subject">件名:</label><br>
        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required><br><br>

        <label for="body">本文:</label><br>
        <textarea id="body" name="body" rows="10" required>{{ old('body') }}</textarea><br><br>

        <label for="recipient">宛先:</label><br>
        <input type="email" id="recipient" name="recipient" value="{{ old('recipient') }}" required><br><br>

        <button type="submit">送信</button>
    </form>
</body>

</html>