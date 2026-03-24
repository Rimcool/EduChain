<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>University Account Approved</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #22c55e; color: white; padding: 20px; text-align: center; }
        .content { background: #f8fafc; padding: 30px; }
        .footer { background: #1f2937; color: white; padding: 20px; text-align: center; font-size: 12px; }
        .btn { display: inline-block; padding: 12px 24px; background: #22c55e; color: white; text-decoration: none; border-radius: 4px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>EduChain</h1>
            <h2>University Account Approved</h2>
        </div>
        
        <div class="content">
            <p>Dear {{ $user->name }},</p>
            
            <p>We are pleased to inform you that your university account has been approved by our administrators.</p>
            
            <p>Your university, <strong>{{ $user->university_name }}</strong>, is now active on EduChain and you can start issuing degrees to your students.</p>
            
            <p><strong>Account Details:</strong></p>
            <ul>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>University:</strong> {{ $user->university_name }}</li>
                <li><strong>Role:</strong> University Admin</li>
            </ul>
            
            <p>You can now log in to your account and start using the university portal:</p>
            
            <a href="{{ url('/portal') }}" class="btn">Access University Portal</a>
            
            <p><strong>What you can do now:</strong></p>
            <ul>
                <li>Issue degrees to your students</li>
                <li>Upload degree records in bulk</li>
                <li>Monitor degree verifications</li>
                <li>Access verification reports</li>
            </ul>
            
            <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
            
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