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
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $amount = (int) ($request->input('amount') * 100); // Convert to minor units (e.g., cents)

        $auth = base64_encode('1110019573:boFPeNtfMfZfMn4X');

        $payload = [
            'currency' => 'EUR', // Double-check if your account supports EUR
            'refno' => 'Order-' . uniqid(),
            'amount' => $amount,
            'paymentMethods' => ['VIS', 'ECA', 'PAP', 'TWI'],
            'autoSettle' => true,
            'option' => [
                'createAlias' => true,
            ],
            'redirect' => [
                'successUrl' => route('payment.success'),
                'cancelUrl' => route('payment.cancel'),
                'errorUrl' => route('payment.error'),
            ],
            // Optional theme settings (can comment out to debug issues)
            'theme' => [
                'name' => 'DT2015',
                'configuration' => [
                    'brandColor' => '#FFFFFF',
                    'logoBorderColor' => '#A1A1A1',
                    'brandButton' => '#A1A1A1',
                    'payButtonTextColor' => '#FFFFFF',
                    'logoSrc' => asset('images/logo.svg'), // ensure this resolves to a full public URL
                    'logoType' => 'circle',
                    'initialView' => 'list',
                ],
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $auth,
                'Content-Type' => 'application/json',
            ])->post('https://api.sandbox.datatrans.com/v1/transactions', $payload);

            if ($response->successful()) {
                $data = $response->json();
                Log::info('Datatrans API success response:', $data);

                if (!empty($data['redirect']['url'])) {
                    return redirect()->away($data['redirect']['url']);
                } else {
                    Log::warning('Missing redirect URL in Datatrans response:', $data);
                    return redirect()->route('payment.start')->with('error', $data);
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
        // Optionally verify payment here
        return view('payment.status', ['message' => '✅ Payment successful!', 'status' => 'success']);
    }

    public function handleCancel()
    {
        return view('payment.status', ['message' => '❌ Payment was cancelled.', 'status' => 'cancel']);
    }

    public function handleError()
    {
        return view('payment.status', ['message' => '⚠️ An error occurred during payment.', 'status' => 'error']);
    }
}
