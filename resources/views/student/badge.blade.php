<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $credential->student_name }} - Verified Degree</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .badge-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 40px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            position: relative;
            overflow: hidden;
        }
        
        .badge-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #10b981, #3b82f6);
        }
        
        .verified-badge {
            width: 80px;
            height: 80px;
            background: #10b981;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }
        
        .verified-badge svg {
            width: 40px;
            height: 40px;
            fill: white;
        }
        
        h1 {
            color: #1f2937;
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: 700;
        }
        
        .degree-title {
            color: #6b7280;
            font-size: 16px;
            margin-bottom: 30px;
            font-weight: 500;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin: 30px 0;
            text-align: left;
        }
        
        .info-item {
            background: #f3f4f6;
            padding: 15px;
            border-radius: 12px;
        }
        
        .info-label {
            font-size: 12px;
            color: #6b7280;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 0.05em;
        }
        
        .info-value {
            font-size: 16px;
            color: #1f2937;
            font-weight: 600;
            margin-top: 5px;
        }
        
        .qr-section {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #e5e7eb;
        }
        
        .qr-code {
            background: #f9fafb;
            padding: 20px;
            border-radius: 12px;
            display: inline-block;
            margin-bottom: 15px;
        }
        
        .qr-code img {
            width: 150px;
            height: 150px;
        }
        
        .share-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .btn-primary {
            background: #3b82f6;
            color: white;
        }
        
        .btn-secondary {
            background: #ef4444;
            color: white;
        }
        
        .view-count {
            margin-top: 20px;
            color: #6b7280;
            font-size: 14px;
        }
        
        @media (max-width: 600px) {
            .badge-container {
                padding: 30px 20px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="badge-container">
        <div class="verified-badge">
            <svg viewBox="0 0 24 24">
                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
            </svg>
        </div>
        
        <h1>{{ $credential->student_name }}</h1>
        <div class="degree-title">{{ $credential->degree_title }}</div>
        
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Roll Number</div>
                <div class="info-value">{{ $credential->roll_number }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">University</div>
                <div class="info-value">{{ $credential->university_name }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Graduation Year</div>
                <div class="info-value">{{ $credential->graduation_year }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Status</div>
                <div class="info-value" style="color: #10b981;">VERIFIED</div>
            </div>
        </div>
        
        <div class="qr-section">
            <div class="qr-code">
                {!! QrCode::size(150)->generate(url('/badge/' . $credential->public_slug)) !!}
            </div>
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 20px;">
                Scan to verify this degree
            </p>
            
            <div class="share-buttons">
                <a href="{{ url('/badge/' . $credential->public_slug) }}" class="btn btn-primary">
                    View Full Verification
                </a>
                <button onclick="shareBadge()" class="btn btn-secondary">
                    Share Badge
                </button>
            </div>
        </div>
        
        <div class="view-count">
            This badge has been viewed {{ $credential->view_count }} times
        </div>
    </div>

    <script>
        function shareBadge() {
            const url = window.location.href;
            if (navigator.share) {
                navigator.share({
                    title: '{{ $credential->student_name }} - Verified Degree',
                    text: 'Check out my verified degree from EduChain!',
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url).then(() => {
                    alert('Badge link copied to clipboard!');
                });
            }
        }
    </script>
</body>
</html>