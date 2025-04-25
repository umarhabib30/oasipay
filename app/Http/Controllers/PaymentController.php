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
        $payload = [
            "currency" => "EUR",
            "refno" => "Test-1234",
            "amount" => 1000,
            "paymentMethods" => ["VIS", "ECA", "PAP", "TWI"],
            "autoSettle" => true,
            "option" => [
                "createAlias" => true
            ],
            "redirect" => [
                "successUrl" => "https://oasipay.equestrianrc.com/payment/success",
                "cancelUrl" => "https://oasipay.equestrianrc.com/payment/cancel",
                "errorUrl" => "https://oasipay.equestrianrc.com/payment/error"
            ],
            "theme" => [
                "name" => "DT2015",
                "configuration" => [
                    "brandColor" => "#FFFFFF",
                    "logoBorderColor" => "#A1A1A1",
                    "brandButton" => "#A1A1A1",
                    "payButtonTextColor" => "#FFFFFF",
                    "logoSrc" => "{svg}",
                    "logoType" => "circle",
                    "initialView" => "list"
                ]
            ]
        ];

        $username = '1110019573';
        $password = 'boFPeNtfMfZfMn4X';

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => 'https://api.sandbox.datatrans.com/v1/transactions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($username . ':' . $password),
            ],
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return back()->with('error', 'Payment setup failed: ' . $error);
        }

        $data = json_decode($response, true);

        if (!isset($data['transactionId'])) {
            return back()->with('error', 'Transaction ID not received.');
        }


        $url = 'https://pay.sandbox.datatrans.com/v1/start/' . $data['transactionId'];

        // Send GET request
        return view('payment.form', ['url' => $url]);

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
