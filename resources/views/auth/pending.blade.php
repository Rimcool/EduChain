<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduChain') }} - Account Pending</title>

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
            margin: 0;
            padding: 20px;
        }

        .pending-container {
            max-width: 800px;
            margin: 0 auto;
            background: rgba(17, 24, 39, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 0 50px rgba(245, 158, 11, 0.1);
            position: relative;
            overflow: hidden;
        }

        .pending-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-yellow), var(--accent-green));
        }

        .header-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-text {
            font-family: 'Space Mono', ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--accent-green);
            text-shadow: 0 0 15px rgba(16, 185, 129, 0.4);
            letter-spacing: 2px;
            margin-bottom: 10px;
        }

        .page-title {
            font-family: 'Syne', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            font-size: 2rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            background: linear-gradient(135deg, var(--text-primary), var(--text-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }

        .subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            margin-bottom: 30px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 20px;
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.4);
            border-radius: 50px;
            color: #fbbf24;
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 30px;
            box-shadow: 0 0 15px rgba(245, 158, 11, 0.2);
        }

        .status-icon {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: radial-gradient(circle, #fbbf24 0%, #f59e0b 50%, #d97706 100%);
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.5);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(245, 158, 11, 0); }
            100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0); }
        }

        .info-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 30px;
        }

        .info-title {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 15px;
            font-family: 'Syne', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
        }

        .info-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 15px;
        }

        .detail-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 12px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .detail-label {
            font-size: 0.75rem;
            color: var(--text-secondary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 0.9rem;
            color: var(--text-primary);
            font-weight: 600;
        }

        .note-box {
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.4);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .note-title {
            color: #fbbf24;
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .note-text {
            color: var(--text-secondary);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .progress-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .progress-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .progress-card:hover {
            border-color: rgba(16, 185, 129, 0.5);
            background: rgba(16, 185, 129, 0.05);
        }

        .progress-icon {
            width: 40px;
            height: 40px;
            margin: 0 auto 15px auto;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
        }

        .progress-icon.complete {
            background: linear-gradient(135deg, var(--accent-green), #06b6d4);
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.4);
        }

        .progress-icon.pending {
            background: linear-gradient(135deg, var(--accent-yellow), #f97316);
            box-shadow: 0 0 15px rgba(245, 158, 11, 0.4);
        }

        .progress-title {
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 5px;
            font-size: 0.9rem;
            font-family: 'Syne', system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
        }

        .progress-desc {
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
            background: rgba(255, 255, 255, 0.05);
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent-green), #06b6d4);
            border: none;
            color: white;
        }

        .btn-secondary {
            border-color: rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            border-color: var(--accent-green);
            background: rgba(16, 185, 129, 0.1);
            color: var(--accent-green);
        }
    </style>
</head>
<body>
    <div class="pending-container">
        <div class="header-section">
            <div class="logo-text">EduChain</div>
            <h1 class="page-title">Account Pending</h1>
            <p class="subtitle">Verify degrees. Prevent fraud. Build trust.</p>
            
            <div class="status-badge">
                <div class="status-icon"></div>
                Account Pending Approval
            </div>
        </div>

        <div class="info-card">
            <div class="info-title">University Registration Details</div>
            <div class="info-details">
                <div class="detail-item">
                    <div class="detail-label">University</div>
                    <div class="detail-value">{{ auth()->user()->university_name }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Email</div>
                    <div class="detail-value">{{ auth()->user()->email }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Registered</div>
                    <div class="detail-value">{{ auth()->user()->created_at->format('M d, Y') }}</div>
                </div>
            </div>
        </div>

        <div class="note-box">
            <div class="note-title">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Important Note
            </div>
            <div class="note-text">
                You will receive an email notification once your account has been approved by our admin team. 
                In the meantime, you can explore our platform and learn more about how EduChain is revolutionizing 
                degree verification and fraud prevention.
            </div>
        </div>

        <div class="progress-grid">
            <div class="progress-card">
                <div class="progress-icon complete">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="progress-title">Registration Complete</div>
                <div class="progress-desc">Your university has been successfully registered</div>
            </div>

            <div class="progress-card">
                <div class="progress-icon pending">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="progress-title">Under Review</div>
                <div class="progress-desc">Admin team is reviewing your verification request</div>
            </div>

            <div class="progress-card">
