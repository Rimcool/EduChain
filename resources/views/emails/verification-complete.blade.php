<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Degree Verification Complete</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #3b82f6; color: white; padding: 20px; text-align: center; }
        .content { background: #f8fafc; padding: 30px; }
        .footer { background: #1f2937; color: white; padding: 20px; text-align: center; font-size: 12px; }
        .btn { display: inline-block; padding: 12px 24px; background: #3b82f6; color: white; text-decoration: none; border-radius: 4px; margin: 20px 0; }
        .result-box { text-align: center; margin: 20px 0; }
        .status { font-size: 24px; font-weight: bold; margin-bottom: 10px; }
        .real { color: #16a34a; }
        .fake { color: #dc2626; }
        .unconfirmed { color: #f59e0b; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>EduChain</h1>
            <h2>Degree Verification Complete</h2>
        </div>
        
        <div class="content">
            <p>Dear {{ $verification->user?->name ?? 'User' }},</p>
            
            <p>Your degree verification request has been completed successfully.</p>
            
            <div class="result-box">
                @php
                    $statusClass = '';
                    $statusText = '';
                    
                    switch($verification->result) {
                        case 'real':
                            $statusClass = 'real';
                            $statusText = 'VERIFIED';
                            break;
                        case 'fake':
                            $statusClass = 'fake';
                            $statusText = 'FAKE';
                            break;
                        case 'unconfirmed':
                            $statusClass = 'unconfirmed';
                            $statusText = 'UNCONFIRMED';
                            break;
                    }
                @endphp
                
                <div class="status {{ $statusClass }}">{{ $statusText }}</div>
                <p>Verification Score: {{ $verification->score }}/100</p>
                <p>Verification Code: {{ $verification->code }}</p>
            </div>
            
            <p><strong>Verification Details:</strong></p>
            <ul>
                <li><strong>Student Name:</strong> {{ $verification->student_name }}</li>
                <li><strong>Degree:</strong> {{ $verification->degree_title }}</li>
                <li><strong>University:</strong> {{ $verification->university_name }}</li>
                <li><strong>Roll Number:</strong> {{ $verification->roll_number }}</li>
                <li><strong>Year:</strong> {{ $verification->graduation_year }}</li>
                <li><strong>Reason:</strong> {{ $verification->reason }}</li>
            </ul>
            
            <p>You can view the complete verification result and download the certificate:</p>
            
            <a href="{{ url('/verify/' . $verification->code) }}" class="btn">View Verification Result</a>
            
            <p><strong>Share this verification:</strong></p>
            <p>Verification Link: {{ url('/check/' . $verification->code) }}</p>
            <p>Verification Code: {{ $verification->code }}</p>
            
            <p>This verification is valid and can be independently verified by anyone using the above link or code.</p>
            
            <p>Best regards,<br>
            The EduChain Team</p>
        </div>
        
        <div class="footer">
            <p>This is an automated message from EduChain. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} EduChain. All rights reserved.</p>
        </div>
    </div>
</body>
</html>