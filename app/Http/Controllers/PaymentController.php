<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // DataTrans credentials (sandbox)
    private $merchantId = '1110019573';
    private $username   = '1110019573';
    private $password   = 'boFPeNtfMfZfMn4X';

    // Step 1: Initialize the transaction
    public function initializeTransaction(Request $request)
    {
        $apiUrl = 'https://api.sandbox.datatrans.com/v1/transactions';

        $payload = [
            'merchantId'   => $this->merchantId,
            'amount'       => 1000, // in cents (10.00 EUR)
            'currency'     => 'EUR',
            'captureMode'  => 'AUTOMATIC',
        ];

        $response = Http::withBasicAuth($this->username, $this->password)
            ->post($apiUrl, $payload);

        if ($response->successful()) {
            $data = $response->json();
dd($data);
            // Store transaction ID in session
            session(['transactionId' => $data['transactionId']]);

            // Redirect to form with secureToken
            return redirect()->route('payment.form', ['secureToken' => $data['secureToken']]);
        } else {
            Log::error('Transaction Init Failed: ' . $response->body());
            return redirect()->route('payment.failed')->with('error', 'Transaction initialization failed.');
        }
    }

    // Step 2: Load the SecureFields form
    public function loadSecureFieldsForm($secureToken)
    {
        $secureFieldsUrl = 'https://pay.sandbox.datatrans.com/v1/secureFields/' . $secureToken;
        return view('payment.form', ['secureFieldsUrl' => $secureFieldsUrl]);
    }

    // Step 3: Authorize payment after card form submission
    public function processPayment(Request $request)
    {
        $transactionId = session('transactionId');

        if (!$transactionId) {
            return redirect()->route('payment.failed')->with('error', 'Missing transaction ID.');
        }

        $authorizeUrl = "https://api.sandbox.datatrans.com/v1/transactions/{$transactionId}/authorize";

        $response = Http::withBasicAuth($this->username, $this->password)
            ->post($authorizeUrl, [
                'merchantId' => $this->merchantId
            ]);

        if ($response->successful()) {
            return redirect()->route('payment.success');
        } else {
            Log::error('Authorize Failed: ' . $response->body());
            return redirect()->route('payment.failed')->with('error', 'Authorization failed.');
        }
    }

    // Step 4: Show payment success
    public function paymentSuccess()
    {
        return view('payment.success');
    }

    // Step 5: Show payment failure
    public function paymentFailed()
    {
        return view('payment.failed');
    }
}
// Compare this snippet from resources/views/payment/form.blade.php:
