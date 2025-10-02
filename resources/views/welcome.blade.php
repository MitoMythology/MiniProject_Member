<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background: linear-gradient(135deg, #1e3a8a 0%, #312e81 50%, #4c1d95 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .bg-pattern {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.05;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(255,255,255,0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(255,255,255,0.08) 0%, transparent 60%);
            pointer-events: none;
        }

        .nav {
            position: fixed;
            top: 0;
            right: 0;
            padding: 2rem;
            display: flex;
            gap: 1rem;
            z-index: 100;
        }

        .nav a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav a:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .welcome-container {
            text-align: center;
            z-index: 1;
            animation: fadeIn 1s ease;
        }

        .welcome-container h1 {
            font-size: 5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 1rem;
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
            animation: float 3s ease-in-out infinite;
        }

        .welcome-container p {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 300;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-15px);
            }
        }

        @media (max-width: 768px) {
            .welcome-container h1 {
                font-size: 3rem;
            }
            
            .welcome-container p {
                font-size: 1.2rem;
            }

            .nav {
                padding: 1rem;
            }

            .nav a {
                padding: 0.4rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="bg-pattern"></div>
    
    <div class="nav">
        <a href="/login">Log in</a>
        <a href="/register">Register</a>
    </div>

    <div class="welcome-container">
        <h1>ยินดีต้อนรับ</h1>
        <p>Welcome to Laravel</p>
    </div>
</body>
</html>