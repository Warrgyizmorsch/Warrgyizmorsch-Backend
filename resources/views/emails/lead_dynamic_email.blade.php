<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $emailSubject ?? 'Notification' }}</title>
    <style>
        /* Reset */
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; background-color: #f1f5f9; font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif; color: #334155; }
        
        /* Mobile styles */
        @media screen and (max-width: 600px) {
            .email-container { width: 100% !important; margin: auto !important; }
            .padding-mobile { padding: 24px 18px !important; }
            .header-title { font-size: 22px !important; }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, Roboto, Helvetica, Arial, sans-serif;">

    <!-- Email Outer Wrapper -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f1f5f9; padding: 30px 10px;">
        <tr>
            <td align="center">
                <!-- Main Container Card -->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" class="email-container" style="max-width: 640px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.06); border: 1px solid #e2e8f0;">
                    
                    <!-- Header Banner -->
                    <tr>
                        <td align="center" style="background: linear-gradient(135deg, #006FC9 0%, #004b8a 100%); padding: 32px 24px; text-align: center;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center">
                                        <h1 class="header-title" style="margin: 0; font-size: 26px; font-weight: 800; color: #ffffff; letter-spacing: -0.5px; text-transform: uppercase; font-family: 'Segoe UI', sans-serif;">
                                            Warrgyizmorsch
                                        </h1>
                                        <div style="font-size: 11px; color: rgba(255,255,255,0.85); margin-top: 6px; letter-spacing: 1.2px; text-transform: uppercase; font-weight: 600;">
                                            Official Client Communication
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Body Content Area -->
                    <tr>
                        <td class="padding-mobile" style="padding: 36px 32px; background-color: #ffffff; color: #334155; font-size: 15px; line-height: 1.7;">
                            {!! $bodyContent !!}
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding: 0 32px;">
                            <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 0;">
                        </td>
                    </tr>

                    <!-- Footer Area -->
                    <tr>
                        <td class="padding-mobile" style="padding: 28px 32px; background-color: #f8fafc; text-align: center; color: #64748b; font-size: 12px; line-height: 1.6;">
                            <p style="margin: 0 0 6px 0; font-weight: 700; color: #1e293b; font-size: 13px;">
                                Warrgyizmorsch Pvt Ltd
                            </p>
                            <p style="margin: 0 0 10px 0; color: #64748b;">
                                Professional Web & Software Consultancy
                            </p>
                            <div style="margin: 12px 0; font-size: 11px; color: #94a3b8;">
                                <span>This is an automated communication sent from Warrgyizmorsch Lead CRM.</span>
                            </div>
                            <p style="margin: 0; font-size: 11px; color: #94a3b8;">
                                &copy; {{ date('Y') }} Warrgyizmorsch. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
