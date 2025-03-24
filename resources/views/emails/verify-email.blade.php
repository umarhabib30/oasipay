<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .header {
            font-size: 24px;
            color: #333;
            font-weight: bold;
        }

        .button {
            font-size: 18px;
            font-weight: bold;
            color: #ffffff;
            background: #007bff;
            display: inline-block;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            margin: 20px 0;
        }

        .footer {
            font-size: 14px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">Email Verification</div>
        <p>Click the button below to verify your email address:</p>
        @if ($source == 'other')
            <a href="{{ route('verify.code', ['email' => $email, 'code' => $code]) }}" class="button"
                style="color: white !important;">Verify Email</a>
        @elseif ($source == 'receive_payment')
            <a href="{{ url('email/verify/receivepayment', ['email' => $email, 'code' => $code, 'name' => $name]) }}"
                class="button" style="color: white !important;">Verify Email</a>
        @elseif ($source == 'make_payment')
            <a href="{{ url('email/verify/makepayment', ['email' => $email, 'code' => $code, 'name' => $name]) }}"
                class="button" style="color: white !important;">Verify Email</a>
        @else
            <a href="{{ route('verify.code.seller', ['email' => $email, 'code' => $code, 'name' => $name]) }}"
                class="button" style="color: white !important;">Verify Email</a>
        @endif
        <p>If you didn't request this, you can ignore this email.</p>
        <div class="footer">&copy; 2025 oasipay. All rights reserved.</div>
    </div>
</body>

</html>
