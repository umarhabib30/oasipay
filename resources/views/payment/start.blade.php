<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <form id="paymentForm">
        @csrf
        <label>Amount (EUR)</label>
        <input type="number" name="amount" id="amount" step="0.01" required><br>
        <button type="submit">Pay Now</button>
    </form>

    <!-- Datatrans Lightbox Script -->
    <script src="https://pay.sandbox.datatrans.com/upp/payment/js/datatrans-2.0.0.js"></script>
    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const amount = document.getElementById('amount').value;
            const amountInCents = Math.round(parseFloat(amount) * 100);

            var paymentConfig = {
                merchantId: '1110019573',
                amount: amountInCents,
                currency: 'EUR',
                refno: 'Order-' + Date.now(),
                paymentMethods: ['VIS', 'ECA', 'PAP', 'TWI'],
                autoSettle: true,
                language: 'en',
                success: {
                    url: 'https://oasipay.equestrianrc.com/payment/success'
                },
                error: {
                    url: 'https://oasipay.equestrianrc.com/payment/error'
                },
                cancel: {
                    url: 'https://oasipay.equestrianrc.com/payment/cancel'
                }
            };

            // Initialize Datatrans Lightbox
            Datatrans.startPayment(paymentConfig);
        });
    </script>
</body>
</html>
