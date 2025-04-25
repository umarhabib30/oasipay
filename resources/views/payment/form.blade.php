<!-- resources/views/payment/form.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Form</title>
    <script src="https://pay.sandbox.datatrans.com/upp/payment/js/secure-fields-2.0.0.min.js"></script>
</head>
<body>
    <h1>Complete Your Payment</h1>

    <script>
        const transactionId = "{{ $transactionId }}"; // Pass from controller
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
                // Redirect to 3D Secure URL
                window.location.href = data.redirect;
            } else {
                alert("Payment details submitted successfully. Proceed with authorization on server.");
                // Optionally: send transactionId to backend to authorize
            }
        });

        secureFields.on("error", function (event) {
            console.error("Secure Fields error:", event);
            alert("An error occurred while processing your payment.");
        });
    </script>
</body>
</html>
