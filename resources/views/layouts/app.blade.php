<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema Project - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%);
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 500px;
            width: 100%;
            background: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            text-align: center;
        }
        h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #e50914;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 1rem;
            color: #ddd;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #333;
            color: #fff;
            font-size: 1rem;
            transition: background 0.3s;
        }
        .form-group input:focus {
            outline: none;
            background: #444;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #e50914;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1rem;
            text-align: center;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn:hover {
            background-color: #b20710;
        }
        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
            color: #333;
            padding: 12px;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
            margin-top: 10px;
        }
        .google-btn img {
            width: 20px;
            margin-right: 10px;
        }
        .google-btn:hover {
            background-color: #f1f1f1;
        }
        .error {
            color: #ff4d4d;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        .success {
            color: #4caf50;
            font-size: 1rem;
            margin-bottom: 20px;
        }
        a {
            color: #e50914;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .divider {
            margin: 20px 0;
            text-align: center;
            color: #888;
            position: relative;
        }
        .divider::before,
        .divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 40%;
            height: 1px;
            background: #888;
        }
        .divider::before {
            left: 0;
        }
        .divider::after {
            right: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        @if (session('status'))
            <p class="success">{{ session('status') }}</p>
        @endif
        @if (session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif
        @yield('content')
    </div>
</body>
</html>