<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 5px;
            overflow: hidden;
        }
        .email-header {
            background-color: rgb(33,37,41);
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
        }
        .email-body p {
            margin: 15px 0;
            line-height: 1.5;
        }
        .email-footer {
            background-color: #f1f1f1;
            padding: 15px;
            text-align: center;
            font-size: 14px;
            color: #666666;
        }
        .email-footer a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>{{ config('app.name') }}</h1>
        </div>
        <div class="email-body">
            {{ $slot }}
        <div class="email-footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Alle Rechte vorbehalten.</p>

        </div>
    </div>
</body>
</html>
