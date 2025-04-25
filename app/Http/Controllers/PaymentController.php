<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment.start');
    }

    public function initiatePayment(Request $request)
    {
        // Validate the amount being paid
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $amount = (int) ($request->input('amount') * 100); // Convert to minor units (e.g., cents)

        // Prepare the URL and Merchant ID for DataTrans API
        $auth = base64_encode('1110019573:boFPeNtfMfZfMn4X');  // Merchant authentication credentials

        // Prepare data for the request in x-www-form-urlencoded format
        $payload = [
            'currency' => 'EUR', // Specify the currency
            'amount' => $amount,
            'refno' => 'Order-' . uniqid(),  // Unique reference for the transaction
            'paymentMethods' => 'VIS,ECA,PAP,TWI', // List of accepted payment methods
            'autoSettle' => 'true',  // Enable automatic settlement
            'option' => [
                'createAlias' => 'true',
            ],
            'redirect' => [
                'successUrl' => 'https://oasipay.equestrianrc.com/payment/success',
                'cancelUrl' => 'https://oasipay.equestrianrc.com/payment/cancel',
                'errorUrl' => 'https://oasipay.equestrianrc.com/payment/error',
            ],
        ];

        // Convert data to URL encoded form
        $form_data = http_build_query($payload);

        try {
            // Send request to DataTrans API endpoint (UPP) for payment initiation
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $auth,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])->post('https://pay.sandbox.datatrans.com/upp/jsp/upStart.jsp', $form_data);

            // Check if the response is successful
            if ($response->successful()) {
                $data = $response->json();
                Log::info('Payment initiation success response:', $data);

                // Assuming response contains a redirect URL (this depends on the response format)
                if (!empty($data['redirectUrl'])) {
                    return redirect()->away($data['redirectUrl']);
                } else {
                    Log::warning('Missing redirect URL in Datatrans response:', $data);
                    return redirect()->route('payment.start')->with('error', 'No redirect URL in response.');
                }
            } else {
                Log::error('Datatrans error response: ' . $response->body());
                return redirect()->route('payment.start')->with('error', 'Payment initiation failed.');
            }

        } catch (\Exception $e) {
            Log::error('Datatrans exception: ' . $e->getMessage());
            return redirect()->route('payment.start')->with('error', 'An error occurred while initiating payment.');
        }
    }

    public function handleSuccess(Request $request)
    {
        // Handle success after a successful payment
        return view('payment.status', ['message' => '✅ Payment successful!', 'status' => 'success']);
    }

    public function handleCancel()
    {
        // Handle cancel after user cancels the payment
        return view('payment.status', ['message' => '❌ Payment was cancelled.', 'status' => 'cancel']);
    }

    public function handleError()
    {
        // Handle error if something goes wrong during payment
        return view('payment.status', ['message' => '⚠️ An error occurred during payment.', 'status' => 'error']);
    }
}
