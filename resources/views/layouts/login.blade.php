<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Login')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f6fbff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 0 24px rgba(0,0,0,0.08);
            padding: 40px 30px;
            width: 100%;
            max-width: 400px;
        }
        .login-title {
            font-weight: bold;
            margin-bottom: 24px;
            text-align: center;
            color: #a259ec;
        }
    </style>
</head>
<body>
    <div class="login-box">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 