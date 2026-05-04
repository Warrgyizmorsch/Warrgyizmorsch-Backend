<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visa Assistance Form Submission</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ECF0F1;
            color: #fff;
        }
        .container {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #2C3E50;
            color: #ffffff;
            padding: 40px;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            font-size: 28px;
        }
        
        .content {
            padding: 30px;
            font-size: 16px;
            line-height: 1.6;
            color: #2C3E50;
        }
        .content p {
            margin-bottom: 12px;
        }
        .content p strong {
            color: #000;
        }
        .footer {
            background-color: #2C3E50;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #888888;
        }
        .footer a {
            color: #ffb400;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .footer p {
            color: #fff;
        }
        .button {
            display: inline-block;
            background-color:#2C3E50;
            color: #ffffff;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Visa Assistance Contact Form Submission</h2>
        </div>

        <div class="content">
            <p><strong>Name:</strong> {{ $formData['name'] }}</p>
            <p><strong>Email:</strong> {{ $formData['email'] }}</p>
            <p><strong>Phone:</strong> {{ $formData['country_code'] }} {{ $formData['phone_number_main'] }}</p>
            <p><strong>Message:</strong> {{ $formData['message'] }}</p>

            <a style="color: #ffb400" href="https://www.wtsvisa.com" class="button">Visit wtsvisa.com</a>
        </div>

        <div class="footer">
            <p>&copy; 2025 <a href="https://www.wtsvisa.com" target="_blank">wtsvisa.com</a>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
