<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment.start'); // View to enter card details
    }

    public function initiatePayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'card_number' => 'required|digits_between:13,19',
            'expiry_month' => 'required|integer|between:1,12',
            'expiry_year' => 'required|integer|min:' . date('y'),
            'cvv' => 'required|digits_between:3,4',
        ]);

        $auth = base64_encode('1110019573:boFPeNtfMfZfMn4X');
        $amount = (int) ($request->input('amount') * 100); // in cents

        $payload = [
            'currency' => 'EUR',
            'refno' => 'Order-' . uniqid(),
            'amount' => $amount,
            'card' => [
                'number' => $request->input('card_number'),
                'expiryMonth' => (int) $request->input('expiry_month'),
                'expiryYear' => (int) $request->input('expiry_year'),
                'cvv' => $request->input('cvv'),
            ],
            'autoSettle' => true,
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $auth,
                'Content-Type' => 'application/json',
            ])->post('https://api.sandbox.datatrans.com/v1/transactions/authorize', $payload);

            if ($response->successful()) {
                $data = $response->json();
                Log::info('Datatrans payment authorized:', $data);
                return view('payment.status', ['message' => '✅ Payment successful!', 'status' => 'success']);
            } else {
                Log::error('Datatrans error response: ' . $response->body());
                return redirect()->back()->withInput()->withErrors(['payment' => 'Payment failed: ' . $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('Datatrans exception: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['payment' => 'An error occurred: ' . $e->getMessage()]);
        }
    }
}
