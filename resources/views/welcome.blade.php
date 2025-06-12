<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Welcome Page</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /* Global Styles */
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #1a1a2e, #2e294e, #3a506b);
            background-size: 400% 400%; /* Smooth transition for animation */
            animation: gradientAnimation 15s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: var(--white);
        }

        /* Gradient animation */
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-box {
            background: rgba(18, 18, 18, 0.95); /* Semi-transparent dark color */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
            width: 350px;
            text-align: center;
            position: relative;
            backdrop-filter: blur(10px); /* Frosted glass effect */
        }

        .login-box h2 {
            font-size: 2rem;
            color: #ffffff;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn, .btn-btn-grey {
            padding: 12px 25px;
            border: none;
            border-radius: 25px;
            color: #ffffff;
            cursor: pointer;
            transition: all 0.4s;
            font-size: 1rem;
            font-weight: 600;
            text-align: center;
            text-transform: uppercase;
            box-shadow: 0 3px 10px rgba(0, 123, 255, 0.3);
        }

        .btn {
            background-color: #007bff; /* Primary blue */
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.5);
        }

        .btn:hover {
            background-color: #0056b3; /* Darker blue */
            box-shadow: 0 6px 20px rgba(0, 86, 179, 0.6);
            transform: translateY(-3px); /* Lift effect */
        }

        .btn-btn-grey {
            background-color: #a050b5; /* Custom purple */
            box-shadow: 0 4px 15px rgba(160, 80, 181, 0.5);
        }

        .btn-btn-grey:hover {
            background-color: #7e3a8e; /* Darker purple */
            box-shadow: 0 6px 20px rgba(126, 58, 142, 0.6);
            transform: translateY(-3px); /* Lift effect */
        }

        /* Add subtle hover effects to container */
        .container a {
            text-decoration: none;
            display: inline-block;
            width: 48%; /* For responsive design */
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Get Started!</h2>
        <div class="container">
            <a href="{{ route('login') }}" class="btn">Log in</a>
            <a href="{{ route('register') }}" class="btn-btn-grey">Register</a>
        </div>
    </div>
</body>
</html>
