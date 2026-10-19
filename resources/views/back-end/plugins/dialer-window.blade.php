<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Twilio WebRTC Dialer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { background: #151521; color: #fff; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100 p-3">
    @include('partials.twilio-softphone-widget')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                if (window.twilioSoftphone) {
                    window.twilioSoftphone.toggleWidget();
                }
            }, 300);
        });
    </script>
</body>
</html>
