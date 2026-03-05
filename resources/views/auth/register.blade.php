<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduChain') }} - Create Account</title>

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

        .register-container {
            width: 100%;
            max-width: 520px;
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 0 50px rgba(16, 185, 129, 0.1);
            position: relative;
            overflow: hidden;
        }

        .register-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-yellow), var(--accent-green));
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

        .role-selector {
            margin-bottom: 25px;
            text-align: center;
        }

        .role-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .role-option {
            padding: 15px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.05);
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .role-option:hover {
            border-color: var(--accent-green);
            background: rgba(16, 185, 129, 0.1);
        }

        .role-option.active {
            border-color: var(--accent-green);
            background: rgba(16, 185, 129, 0.15);
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.2);
        }

        .role-option h4 {
            margin: 0 0 5px 0;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .role-option p {
            margin: 0;
            font-size: 0.75rem;
            color: var(--text-secondary);
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

        .conditional-field {
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .conditional-field.show {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
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

        .login-link {
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

        .login-link:hover {
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
    <div class="register-container">
        <div class="logo-section">
            <div class="logo-text">EduChain</div>
            <div class="subtitle">Verify degrees. Prevent fraud. Build trust.</div>
        </div>

        <h2 class="form-title">Create Your Account</h2>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div class="role-selector">
                <label class="form-label">I am a</label>
                <div class="role-grid">
                    <div class="role-option" data-role="recruiter">
                        <h4>Recruiter / HR</h4>
                        <p>Verify degrees for hiring</p>
                    </div>
                    <div class="role-option" data-role="university">
                        <h4>University Admin</h4>
                        <p>Issue blockchain degrees</p>
                    </div>
                    <div class="role-option" data-role="student">
                        <h4>Student</h4>
                        <p>Get verified credentials</p>
                    </div>
                </div>
                <input type="hidden" id="role" name="role" required>
            </div>

            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input id="name" name="name" type="text" required
                       class="form-input" placeholder="Enter your full name">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" name="email" type="email" autocomplete="email" required
                       class="form-input" placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" name="password" type="password" required
                       class="form-input" placeholder="Create a strong password">
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="form-input" placeholder="Confirm your password">
            </div>

            <div id="university-field" class="conditional-field">
                <div class="form-group">
                    <label for="university_name" class="form-label">University Name</label>
                    <input id="university_name" name="university_name" type="text"
                           class="form-input" placeholder="Enter your university name">
                </div>
            </div>

            <div id="company-field" class="conditional-field">
                <div class="form-group">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input id="company_name" name="company_name" type="text"
                           class="form-input" placeholder="Enter your company name">
                </div>
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
                Create Account
            </button>
        </form>

        <div class="divider">
            <span>Already have an account?</span>
        </div>

        <a href="{{ route('login') }}" class="login-link">
            Sign In
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleOptions = document.querySelectorAll('.role-option');
            const roleInput = document.getElementById('role');
            const universityField = document.getElementById('university-field');
            const companyField = document.getElementById('company-field');

            roleOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all options
                    roleOptions.forEach(opt => opt.classList.remove('active'));
                    
                    // Add active class to clicked option
                    this.classList.add('active');
                    
                    // Update hidden input value
                    roleInput.value = this.dataset.role;
                    
                    // Show/hide conditional fields
                    universityField.classList.remove('show');
                    companyField.classList.remove('show');
                    
                    setTimeout(() => {
                        if (this.dataset.role === 'university') {
                            universityField.classList.add('show');
                        } else if (this.dataset.role === 'recruiter') {
                            companyField.classList.add('show');
                        }
                    }, 100);
                });
            });
        });
    </script>
</body>
</html>