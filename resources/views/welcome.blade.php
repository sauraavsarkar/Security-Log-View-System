<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
            background-color: white;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.125rem;
            color: #4b5563;
            margin-bottom: 30px;
        }

        .auth-links {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .auth-links a {
            display: inline-block;
            padding: 12px 20px;
            background-color:rgb(56, 56, 56);
            color: white;
            font-weight: 600;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .auth-links a:hover {
            background-color:rgb(61, 61, 61);
            transform: translateY(-2px);
        }

        .auth-links a:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(73, 73, 73, 0.4);
        }

        .auth-links a.secondary {
            background-color:rgb(0, 0, 0);
        }

        .auth-links a.secondary:hover {
            background-color:rgb(0, 0, 0);
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .container {
                padding: 30px;
            }

            h1 {
                font-size: 2rem;
            }

            p {
                font-size: 1rem;
            }

            .auth-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Our Website</h1>
        <p>We're glad you're here!</p>
        <div class="auth-links">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="secondary">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>
</html>
