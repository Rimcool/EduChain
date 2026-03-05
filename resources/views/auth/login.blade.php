<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduChain') }} - Sign In</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&family=Syne:wght@400;500;600;700;800&family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-panel: #111827;
            --text-primary: #e5e7eb;
            --text-secondary: #9ca3af;
            --accent-green: #10b981;
            --accent-red: #ef4444;
            --accent-yellow: #f59e0b;
            --border: #1f2937;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1f2937 100%);
            color: var(--text-primary);
            font-family: 'DM Sans', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 480px;
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 0 50px rgba(16, 185, 129, 0.1);
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-green), #06b6d4);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-text {
            font-family: 'Space Mono', ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-green);
            text-shadow: 0 0 15px rgba(16, 185, 129, 0.4);
            letter-spacing: 2px;
        }

        .subtitle {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: var(--text-primary);
            font-family: 'Syne', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-secondary);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-primary);
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--accent-green);
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.2);
            background: rgba(255, 255, 255, 0.08);
        }

        .remember-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .remember-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
        }

        .remember-checkbox input {
            width: 16px;
            height: 16px;
            accent-color: var(--accent-green);
        }

        .forgot-link {
            color: var(--accent-green);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .forgot-link:hover {
            color: #06b6d4;
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--accent-green), #06b6d4);
            color: white;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(16, 185, 129, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 30px 0;
            color: var(--text-secondary);
            font-size: 0.8rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
        }

        .divider span {
            padding: 0 15px;
        }

        .register-link {
            display: block;
            text-align: center;
            padding: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: var(--text-primary);
            text-decoration: none;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
        }

        .register-link:hover {
            border-color: var(--accent-green);
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-green);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .error-message ul {
            margin: 0;
            padding-left: 20px;
        }

        .error-message li {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo-text">EduChain</div>
            <div class="subtitle">Verify degrees. Prevent fraud. Build trust.</div>
        </div>

        <h2 class="form-title">Welcome Back</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" name="email" type="email" autocomplete="email" required
                       class="form-input" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required
                       class="form-input" placeholder="Enter your password">
            </div>

            <div class="remember-section">
                <label class="remember-checkbox">
                    <input id="remember_me" name="remember" type="checkbox">
                    Remember me
                </label>
                
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Forgot your password?
                    </a>
                @endif
            </div>

            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit" class="submit-btn">
                Sign In
            </button>
        </form>

        <div class="divider">
            <span>Don't have an account?</span>
        </div>

        <a href="{{ route('register') }}" class="register-link">
            Create an Account
        </a>
    </div>
</body>
</html>