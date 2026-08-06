<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>404 - Page Not Found | Warrgyizmorsch CRM</title>

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/image.png') }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- FontAwesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f0f4f9 0%, #e2eaf4 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #1e293b;
        }

        .error-wrapper {
            max-width: 520px;
            width: 100%;
            text-align: center;
        }

        .logo-container {
            margin-bottom: 30px;
        }

        .logo-container img {
            max-height: 60px;
            width: auto;
        }

        .error-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 50px 40px;
            box-shadow: 0 20px 40px rgba(0, 111, 201, 0.08), 0 1px 3px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }

        .error-badge {
            display: inline-block;
            font-size: 88px;
            font-weight: 800;
            line-height: 1;
            background: linear-gradient(135deg, #006FC9 0%, #004b87 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 15px;
            letter-spacing: -2px;
        }

        .error-title {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
        }

        .error-text {
            font-size: 15px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary {
            background-color: #006FC9;
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(0, 111, 201, 0.25);
        }

        .btn-primary:hover {
            background-color: #00569e;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0, 111, 201, 0.35);
        }

        .btn-secondary {
            background-color: #f1f5f9;
            color: #475569 !important;
            border: 1px solid #cbd5e1;
        }

        .btn-secondary:hover {
            background-color: #e2e8f0;
            color: #1e293b !important;
        }
    </style>
</head>

<body>
    <div class="error-wrapper">
        <div class="logo-container">
            <img src="{{ asset('images/WARR LOGO.webp') }}" alt="Warrgyizmorsch Logo">
        </div>

        <div class="error-card">
            <div class="error-badge">404</div>

            <h1 class="error-title">Oops! Page Not Found</h1>

            <p class="error-text">
                The page you are looking for doesn’t exist, has been removed, or is temporarily unavailable.
            </p>

            <div class="action-buttons">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-home"></i> Back to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Go to Login
                    </a>
                @endauth

                <button onclick="history.back()" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Go Back
                </button>
            </div>
        </div>
    </div>
</body>

</html>