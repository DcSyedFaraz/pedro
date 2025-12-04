<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Deletion Verification Code</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #002C3E; padding: 20px; text-align: center; border-radius: 5px 5px 0 0;">
        <h1 style="color: #fff; margin: 0;">Facilit8 System</h1>
    </div>
    
    <div style="background: #f9f9f9; padding: 30px; border: 1px solid #ddd; border-top: none; border-radius: 0 0 5px 5px;">
        <h2 style="color: #002C3E; margin-top: 0;">Data Deletion Verification Code</h2>
        
        <p>Hello {{ $user->name }},</p>
        
        <p>You have requested to permanently delete your account and all associated data from our system.</p>
        
        <div style="background: #fff; border: 2px solid #dc3545; border-radius: 5px; padding: 20px; margin: 25px 0; text-align: center;">
            <p style="margin: 0 0 10px 0; font-size: 14px; color: #666;">Your verification code is:</p>
            <p style="font-size: 32px; font-weight: bold; letter-spacing: 5px; margin: 0; color: #002C3E;">{{ $code }}</p>
        </div>
        
        <div style="background: #fff3cd; border: 1px solid #ffc107; border-radius: 5px; padding: 15px; margin: 20px 0;">
            <p style="margin: 0; color: #856404;"><strong>⚠️ Important:</strong></p>
            <ul style="margin: 10px 0; color: #856404;">
                <li>This code will expire in 15 minutes</li>
                <li>This action is permanent and cannot be undone</li>
                <li>All your data will be permanently deleted</li>
            </ul>
        </div>
        
        <p><strong>If you did not request this deletion, please:</strong></p>
        <ul>
            <li>Do not share this code with anyone</li>
            <li>Ignore this email - your account will remain active</li>
            <li>Consider changing your password immediately</li>
            <li>Contact us at <a href="mailto:info@facilit8system.com">info@facilit8system.com</a></li>
        </ul>
        
        <hr style="border: none; border-top: 1px solid #ddd; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #666; margin-bottom: 0;">
            This is an automated email from Facilit8 System. Please do not reply to this email.
        </p>
        
        <p style="font-size: 12px; color: #666; margin-top: 10px;">
            <strong>Contact Us:</strong><br>
            Email: info@facilit8system.com<br>
            Phone: 407-978-0288
        </p>
    </div>
</body>
</html>

