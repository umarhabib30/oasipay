<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body>
    <h2>Hello {{ $data['receiver_name'] }},</h2>

    <p>Your payment details have been successfully updated.</p>

    <h3>Payment Details:</h3>
    <ul>
        <li><strong>Payment Method:</strong> {{ $data['bank_type'] }}</li>

        @if ($data['bank_type'] == 'Paypal')
            <li><strong>PayPal Link:</strong> <a href="{{ $data['paypal_link'] }}">{{ $data['paypal_link'] }}</a></li>
        @else
            <li><strong>Account Holder Name:</strong> {{ $data['account_holder_name'] }}</li>
            <li><strong>BIC/SWIFT Code:</strong> {{ $data['bic_swift'] }}</li>
            <li><strong>IBAN:</strong> {{ $data['iban'] }}</li>
        @endif
    </ul>

    <p>If you have any questions, feel free to contact us.</p>

    <p>Best Regards, <br> Your Company Team</p>
</body>
</html>
