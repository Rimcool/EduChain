<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $credential->student_name }} - {{ $credential->degree_name }}</title>
    <meta name="description" content="Verified digital credential for {{ $credential->student_name }} from {{ $credential->university_name }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $credential->student_name }} - {{ $credential->degree_name }}">
    <meta property="og:description" content="Blockchain-verified digital credential from {{ $credential->university_name }}">
    <meta property="og:image" content="{{ asset('images/credential-preview.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $credential->student_name }} - {{ $credential->degree_name }}">
    <meta property="twitter:description" content="Blockchain-verified digital credential from {{ $credential->university_name }}">
    <meta property="twitter:image" content="{{ asset('images/credential-preview.jpg') }}">

    <style>
        :root {
            --primary: #7c3aed;
            --primary-dark: #6d28d9;
            --secondary: #10b981;
            --background: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --border: #e5e7eb;
            --card: #f9fafb;
        }

        .dark {
            --primary: #a78bfa;
            --primary-dark: #8b5cf6;
            --secondary: #34d399;
            --background: #0f172a;
            --text: #f1f5f9;
            --muted: #94a3b8;
            --border: #1f2937;
            --card: #111827;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: var(--background);
            color: var(--text);
            line-height: 1.6;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }

        .credential-card {
            background: linear-gradient(135deg, var(--card), #ffffff);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .credential-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .university-info h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .university-info p {
            color: var(--muted);
            font-size: 0.9rem;
        }

        .verified-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(16, 185, 129, 0.1);
            color: var(--secondary);
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.875rem;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .student-info h2 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, var(--primary), var(--text));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .student-info p {
            color: var(--muted);
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .degree-details {
            background: var(--card);
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px solid var(--border);
        }

        .degree-details h3 {
            margin-bottom: 1rem;
            font-size: 1.1rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border);
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-label {
            color: var(--muted);
            font-size: 0.9rem;
        }

        .detail-value {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .qr-section {
            grid-column: 1 / -1;
            background: var(--card);
            padding: 1.5rem;
            border-radius: 12px;
            border: 1px solid var(--border);
            text-align: center;
        }

        .qr-section h3 {
            margin-bottom: 1rem;
            font-size: 1.1rem;
            color: var(--muted);
        }

        .qr-code {
            background: white;
            padding: 1rem;
            border-radius: 8px;
            display: inline-block;
            margin: 1rem 0;
        }

        .actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid var(--border);
            background: var(--card);
            color: var(--text);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .footer {
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
            text-align: center;
            color: var(--muted);
            font-size: 0.875rem;
        }

        .blockchain-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .blockchain-dot {
            width: 8px;
            height: 8px;
            background: var(--secondary);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.7; }
            100% { transform: scale(1); opacity: 1; }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }
            
            .credential-card {
                padding: 1.5rem;
            }
            
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .student-info h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="credential-card">
            <!-- Header -->
            <div class="header">
                <div class="logo">
                    <div class="logo-icon">🎓</div>
                    <div>
                        <div class="university-info">
                            <h1>{{ $credential->university_name }}</h1>
                            <p>Blockchain Verified Credential</p>
                        </div>
                    </div>
                </div>
                <div class="verified-badge">
                    <span>✅</span>
                    Verified
                </div>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Student Information -->
                <div class="student-info">
                    <h2>{{ $credential->student_name }}</h2>
                    <p>{{ $credential->degree_name }}</p>
                    <div style="margin-top: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
                        <span style="background: var(--card); padding: 0.5rem 1rem; border-radius: 999px; border: 1px solid var(--border); font-size: 0.875rem;">
                            Graduated: {{ $credential->graduation_date->format('F Y') }}
                        </span>
                        <span style="background: var(--card); padding: 0.5rem 1rem; border-radius: 999px; border: 1px solid var(--border); font-size: 0.875rem;">
                            CGPA: {{ $credential->cgpa }}
                        </span>
                        <span style="background: var(--card); padding: 0.5rem 1rem; border-radius: 999px; border: 1px solid var(--border); font-size: 0.875rem;">
                            ID: {{ $credential->student_id }}
                        </span>
                    </div>
                </div>

                <!-- Degree Details -->
                <div class="degree-details">
                    <h3>Degree Information</h3>
                    <div class="detail-item">
                        <span class="detail-label">Program</span>
                        <span class="detail-value">{{ $credential->degree_name }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">University</span>
                        <span class="detail-value">{{ $credential->university_name }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Graduation Date</span>
                        <span class="detail-value">{{ $credential->graduation_date->format('F j, Y') }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Student ID</span>
                        <span class="detail-value">{{ $credential->student_id }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">CGPA</span>
                        <span class="detail-value">{{ $credential->cgpa }}</span>
                    </div>
                </div>

                <!-- QR Code Section -->
                <div class="qr-section">
                    <h3>Blockchain Verification</h3>
                    <div class="blockchain-info">
                        <div class="blockchain-dot"></div>
                        <span>Immutable blockchain record</span>
                    </div>
                    <div class="qr-code">
                        {!! $qrCode !!}
                    </div>
                    <p style="margin-bottom: 1rem; color: var(--muted); font-size: 0.9rem;">
                        Scan this QR code to verify the authenticity of this credential on the blockchain
                    </p>
                    <div class="actions">
                        <a href="{{ route('student.badge', $credential->id) }}" class="btn btn-primary">
                            View Full Credential
                        </a>
                        <a href="#" onclick="window.print()" class="btn">
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>This credential is verified using blockchain technology and cannot be altered.</p>
                <p style="margin-top: 0.5rem;">Verification URL: {{ url()->current() }}</p>
                <p style="margin-top: 1rem; font-size: 0.8rem; opacity: 0.7;">
                    © {{ date('Y') }} {{ $credential->university_name }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const card = document.querySelector('.credential-card');
            
            // Add hover effect
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 20px 40px -10px rgba(0, 0, 0, 0.2)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1)';
            });
        });
    </script>
</body>
</html>