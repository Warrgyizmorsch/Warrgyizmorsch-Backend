<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login OTP Verification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f9; padding: 20px; color: #333;">
    <div style="max-width: 500px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #0d47a1; margin-top: 0;">Login Security OTP</h2>
        <p>Hello,</p>
        <p>A login attempt was made for account: <strong>{{ $userName }}</strong> ({{ $userEmail }}).</p>
        <p>Your 6-digit One-Time Password (OTP) for verification is:</p>
        <div style="text-align: center; margin: 25px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 6px; color: #1e88e5; background: #e3f2fd; padding: 10px 25px; border-radius: 6px; border: 1px dashed #2196f3;">{{ $otp }}</span>
        </div>
        <p style="font-size: 13px; color: #666;">This OTP is valid for 10 minutes. If you did not request this login, please ignore this email or secure your account.</p>
        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #999; text-align: center;">Warrgyizmorsch CRM Security System</p>
    </div>
</body>
</html>
