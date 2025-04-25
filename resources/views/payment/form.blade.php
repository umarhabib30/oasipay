<!-- resources/views/payment/form.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Form</title>
    <script src="https://pay.sandbox.datatrans.com/upp/payment/js/secure-fields-2.0.0.min.js"></script>
    <style>
        .secure-field {
            width: 100%;
            height: 40px;
            border: 1px solid #ccc;
            padding: 8px;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        #payButton {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Complete Your Payment</h1>

    <div class="form-group">
        <label for="cardholderName">Cardholder Name</label>
        <input type="text" id="cardholderName" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" required>
    </div>

    <div class="form-group">
        <label for="phone">Phone (+CCXXXXXXXXX)</label>
        <input type="tel" id="phone" required>
    </div>

    <div class="form-group">
        <label for="cardNumber">Card Number</label>
        <div id="cardNumberPlaceholder" class="secure-field"></div>
    </div>

    <div class="form-group">
        <label for="cvv">CVV</label>
        <div id="cvvPlaceholder" class="secure-field"></div>
    </div>

    <div class="form-group">
        <label for="expm">Expiry Month (MM)</label>
        <input type="text" id="expm" maxlength="2" required>
    </div>

    <div class="form-group">
        <label for="expy">Expiry Year (YYYY)</label>
        <input type="text" id="expy" maxlength="4" required>
    </div>

    <button id="payButton">Pay Now</button>

    <script>
        const transactionId = "{{ $transactionId }}"; // Passed from controller
        const secureFields = new SecureFields();

        secureFields.init(transactionId, {
            cardNumber: "cardNumberPlaceholder",
            cvv: "cvvPlaceholder",
        });

        document.getElementById("payButton").addEventListener("click", function () {
            const expm = document.getElementById("expm").value;
            const expy = document.getElementById("expy").value;
            const cardholderName = document.getElementById("cardholderName").value;
            const email = document.getElementById("email").value;
            const phone = document.getElementById("phone").value;

            const ccMatch = phone.match(/^\+?(\d{2})(\d{7,})$/);

            secureFields.submit({
                expm: parseInt(expm),
                expy: parseInt(expy),
                "3D": {
                    cardholder: {
                        cardholderName: cardholderName,
                        email: email,
                        homePhone: {
                            cc: ccMatch ? ccMatch[1] : "41",
                            subscriber: ccMatch ? ccMatch[2] : "000000000"
                        }
                    }
                }
            });
        });

        secureFields.on("success", function (event) {
            const data = event.data;

            if (data.redirect) {
                window.location.href = data.redirect; // Redirect to 3D Secure
            } else {
                alert("Payment details submitted successfully.");
                // You can now call your backend to authorize the transaction with the transactionId
            }
        });

        secureFields.on("error", function (event) {
            console.error("Secure Fields error:", event);
            alert("An error occurred while processing your payment.");
        });
    </script>
</body>
</html>
