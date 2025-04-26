<?php

namespace App\Http\Controllers;

use App\Mail\PayWithoutCodeMail;
use App\Mail\TransactionConfirmMail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    // DataTrans credentials (sandbox)
    private $merchantId = '1110019573';
    private $username   = '1110019573';
    private $password   = 'boFPeNtfMfZfMn4X';

    // Step 1: Initialize the transaction

    public function initializeTransaction($seller_code, $type)
    {
        $transaction = Transaction::where('seller_code', $seller_code)->first();
        $payload = [
            "currency" => $transaction->currency,
            "refno" => "Test-1234",
            "amount" => $transaction->total * 100,
            "paymentMethods" => ["VIS", "ECA", "PAP", "TWI"],
            "autoSettle" => true,
            "option" => [
                "createAlias" => true
            ],
            "redirect" => [
                "successUrl" => "https://oasipay.equestrianrc.com/payment/success/$seller_code/$type",
                "cancelUrl" => "https://oasipay.equestrianrc.com/payment/cancel/$seller_code/$type",
                "errorUrl" => "https://oasipay.equestrianrc.com/payment/failed/$seller_code/$type",
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
                    "initialView" => "list",
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

        $data = [
            'title' => 'Seller Code',
            'url' => $url
        ];

        return redirect()->away($url);
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
    public function paymentSuccess($seller_code, $type)
    {
        $transaction = Transaction::where('seller_code', $seller_code)->first();
        $transaction->update([
            'is_paid' => true,
        ]);
        if ($type == 'without_code') {
            $data = [
                'receiver_name' => $transaction->receiver_name,
                'receiver_email' => $transaction->receiver_email,
                'seller_code' => $transaction->seller_code,
                'price' => $transaction->price,
                'fee_price' => $transaction->fee_price,
                'total' => $transaction->total_price,
                'currency' => $transaction->currency,
                'currency_symbol' => $transaction->currency_symbol,
                'words' => $transaction->words,
                'title' => $transaction->title,
            ];

            Mail::to($transaction->receiver_email)->send(new PayWithoutCodeMail($data));
        } else {
            $data = [
                'receiver_name' => $transaction->receiver_name,
                'receiver_email' => $transaction->receiver_email,
                'seller_code' => $transaction->seller_code,
                'price' => $transaction->price,
                'fee_price' => $transaction->fee_price,
                'total' => $transaction->total,
                'currency' => $transaction->currency,
                'currency_symbol' => $transaction->currency_symbol,
                'words' => $transaction->words,
                'title' => $transaction->title,
            ];

            Mail::to($transaction->receiver_email)->send(new TransactionConfirmMail($data));
        }

        return redirect('/')->with('success', "Payment made successfully");
    }

    // Step 5: Show payment failure
    public function paymentFailed($seller_code, $type)
    {

       return redirect('/')->with('error' ,'Payment failed please try again!');
    }

    public function paymentCancel($seller_code, $type)
    {
        return redirect('/')->with('success', 'Transaction cancelled successfully');
    }
}
// Compare this snippet from resources/views/payment/form.blade.php:
