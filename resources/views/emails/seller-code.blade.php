<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Code</title>
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
        .code {
            font-size: 32px;
            font-weight: bold;
            color: #007bff;
            background: #f8f9fa;
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
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
        <div class="header">Seller Code</div>
        <p>Use the following seller code for your transaction:</p>
        <div class="code">{{ $code }}</div>
        <p>If you didn't request this, you can ignore this email.</p>
        <div class="footer">&copy; 2025 oasipay. All rights reserved.</div>
    </div>
</body>
</html>
