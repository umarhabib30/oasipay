<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pay with Card</title>
</head>
<body>
    <h2>Pay with Card</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Payment Form -->
    <form action="{{ route('payment.initiate') }}" method="POST">
        @csrf
        <label>Amount (EUR)</label>
        <input type="number" name="amount" step="0.01" required><br>

        <!-- Card Details will be handled by Secure Fields (not entered directly) -->

        <div id="secureFields"></div> <!-- Placeholder for Secure Fields -->

        <!-- Hidden Fields for handling DataTrans-specific values -->
        <input type="hidden" name="currency" value="EUR">
        <input type="hidden" name="paymentMethods" value="VIS,ECA,PAP,TWI">
        <input type="hidden" name="autoSettle" value="true">
        <input type="hidden" name="option[createAlias]" value="true">

        <button type="submit">Pay Now</button>
    </form>

    <!-- DataTrans Secure Fields Script Integration -->
    <script src="https://pay.sandbox.datatrans.com/v1/secureFields.js"></script>
    <script>
        var secureFields = new SecureFields({
            containerId: 'secureFields',  // ID of the div where Secure Fields should be rendered
            returnUrl: 'https://oasipay.equestrianrc.com/payment/success',  // Redirect URL after 3D Secure authentication
            cancelUrl: 'https://oasipay.equestrianrc.com/payment/cancel',  // Redirect URL on payment cancel
            errorUrl: 'https://oasipay.equestrianrc.com/payment/error',  // Redirect URL on error
        });

        secureFields.create(); // Initialize Secure Fields (this will embed the payment form in the specified container)
    </script>
</body>
</html>
