<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <!-- Указываем favicon -->
    <meta name="msapplication-TileColor" content="#0d6efd">
    <meta name="theme-color" content="#0d6efd">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">

    <!-- Указываем favicon -->
    <link rel="icon" href="{{ config('app.url') }}/images/favicon.ico" sizes="32x32" type="image/png">
    <link rel="apple-touch-icon" href="{{ config('app.url') }}/images/apple-touch-icon.png">
    <link rel="manifest" href="{{ config('app.url') }}/images/site.webmanifest">
    <title>Новое сообщение</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 620px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .header {
            background-color: #0d6efd;
            color: #fff;
            padding: 20px 30px;
        }

        .header h2 {
            margin: 0;
        }

        .content {
            padding: 30px;
        }

        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px;
            border: 3px solid #0d6efd;
        }

        .message-box {
            background: #f1f3f5;
            border-left: 4px solid #0d6efd;
            padding: 15px 20px;
            border-radius: 8px;
            margin-top: 15px;
            font-size: 16px;
            line-height: 1.5;
        }

        .sender-info {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        .button {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 24px;
            background-color: #0d6efd;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0b5ed7;
        }

        @media (prefers-color-scheme: dark) {
            body {
                background-color: #181a1b;
                color: #e4e6eb;
            }

            .email-container {
                background: #242526;
                color: #e4e6eb;
            }

            .message-box {
                background: #3a3b3c;
                border-left-color: #4dabf7;
            }

            .sender-info {
                color: #bbb;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h2>📨 Новое сообщение от {{ $from->name }}</h2>
        </div>
    </div>
    <div class="content">

        <p>Вы получили новое сообщение на платформе:</p>

        <div class="message-box">
            {{ $text }}
        </div>

        <div class="sender-info">
            Отправитель: {{ $from->name }}<br>
        </div>

        <a href="{{ $url }}" class="button">Открыть чат</a>
    </div>
    </div>
</body>

</html>
