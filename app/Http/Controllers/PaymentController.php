<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // Step 1: Initialize the transaction
    public function initializeTransaction(Request $request)
    {
        // Prepare the API endpoint and credentials
        $apiUrl = env('DATATRANS_API_URL');
        $merchantId = env('DATATRANS_MERCHANT_ID');
        $username = env('DATATRANS_USERNAME');
        $password = env('DATATRANS_PASSWORD');

        // Prepare the payload for the API call
        $payload = [
            'merchantId' => $merchantId,
            'amount' => 1000, // Amount in cents (1000 = 10.00 USD)
            'currency' => 'USD',
            'captureMode' => 'AUTOMATIC'
        ];

        // Call the API using Guzzle HTTP client
        $response = Http::withBasicAuth($username, $password)
            ->post($apiUrl, $payload);

        // Check if the API call was successful
        if ($response->successful()) {
            $data = $response->json();
            return redirect()->route('payment.form', ['secureToken' => $data['secureToken']]);
        } else {
            return redirect()->back()->with('error', 'Transaction initialization failed.');
        }
    }

    // Step 2: Load the SecureFields form
    public function loadSecureFieldsForm($secureToken)
    {
        // Use the secureToken to generate the URL
        $secureFieldsUrl = env('DATATRANS_SECUREFIELDS_URL') . $secureToken;

        // Return a view with the form embedded (you can embed in an iframe)
        return view('payment.form', ['secureFieldsUrl' => $secureFieldsUrl]);
    }

    // Step 3: Process the payment after form submission
    public function processPayment(Request $request)
    {
        // Get the form data (you might have form data returned from the callback)
        $secureToken = $request->input('secureToken');
        $transactionId = $request->input('transactionId'); // Get the transaction ID from the form

        // Call the authorize API
        $authorizeUrl = env('DATATRANS_API_URL') . '/authorize';
        $apiResponse = Http::withBasicAuth(env('DATATRANS_USERNAME'), env('DATATRANS_PASSWORD'))
            ->post($authorizeUrl, [
                'merchantId' => env('DATATRANS_MERCHANT_ID'),
                'transactionId' => $transactionId
            ]);

        // Check for successful authorization
        if ($apiResponse->successful()) {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('payment.failed');
        }
    }

    // Step 4: Show Success page
    public function paymentSuccess()
    {
        return view('payment.success');
    }

    // Step 5: Show Failed page
    public function paymentFailed()
    {
        return view('payment.failed');
    }
}
