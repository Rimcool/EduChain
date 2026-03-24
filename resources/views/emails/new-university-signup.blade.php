<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New University Registration</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f59e0b; color: white; padding: 20px; text-align: center; }
        .content { background: #f8fafc; padding: 30px; }
        .footer { background: #1f2937; color: white; padding: 20px; text-align: center; font-size: 12px; }
        .btn { display: inline-block; padding: 12px 24px; background: #f59e0b; color: white; text-decoration: none; border-radius: 4px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>EduChain</h1>
            <h2>New University Registration</h2>
        </div>
        
        <div class="content">
            <p>Dear Admin,</p>
            
            <p>A new university has registered on EduChain and is pending approval.</p>
            
            <p><strong>University Details:</strong></p>
            <ul>
                <li><strong>University Name:</strong> {{ $user->university_name }}</li>
                <li><strong>Contact Person:</strong> {{ $user->name }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Phone:</strong> {{ $user->phone ?? 'Not provided' }}</li>
                <li><strong>Registration Date:</strong> {{ $user->created_at->format('M d, Y H:i') }}</li>
            </ul>
            
            <p>Please review this registration and approve or reject the account through the admin panel.</p>
            
            <a href="{{ url('/admin/pending') }}" class="btn">Review Pending Universities</a>
            
            <p><strong>Next Steps:</strong></p>
            <ol>
                <li>Verify the university's credentials and HEC recognition</li>
                <li>Check the contact information provided</li>
                <li>Approve the account if everything is in order</li>
                <li>Notify the university of their account status</li>
            </ol>
            
            <p>This is an automated notification. Please take appropriate action to review this registration.</p>
            
            <p>Best regards,<br>
            EduChain System</p>
        </div>
        
        <div class="footer">
            <p>This is an automated message from EduChain. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} EduChain. All rights reserved.</p>
        </div>
    </div>
</body>
</html>