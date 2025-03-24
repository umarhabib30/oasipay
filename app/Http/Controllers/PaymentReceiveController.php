<?php

namespace App\Http\Controllers;

use App\Mail\ReceivePaymentMail;
use App\Models\Transaction;
use App\Models\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PaymentReceiveController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Receive Payment'
        ];
        return view('receive-payment', $data);
    }

    public function getTransaction(Request $request)
    {
        try {
            $transaction = Transaction::where('seller_code', $request->seller_code)->first();
            if ($transaction) {
                return response()->json([
                    'error' => false,
                    'message' => 'Transaction found successfully',
                    'transaction' => $transaction
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Your buyer code is not valid',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function store(Request $request)
    {
        $verification = VerifyEmail::where('email', $request->email)
            ->where('token', $request->verification_code)
            ->first();

        if (!$verification || !$verification->is_verified) {
            return response()->json([
                'error' => true,
                'message' => 'Please check your inbox to verify email',
            ]);
        }

        $transaction = Transaction::where('seller_code', $request->seller_code)->first();

        if (!$transaction) {
            return response()->json([
                'error' => true,
                'message' => 'Please check your buyer code is incorrect',
            ]);
        }

        $paymentDetails = [
            'receiver_name' => $request->name,
            'receiver_email' => $request->email,
        ];

        if ($request->receive_payment == 'paypal') {
            $paymentDetails += [
                'bank_type' => 'Paypal',
                'paypal_link' => $request->paypal_link,
            ];
        } else {
            $paymentDetails += [
                'bank_type' => 'Bank Transfer',
                'account_holder_name' => $request->account_holder_name,
                'bic_swift' => $request->bic_swift,
                'iban' => $request->iban,
            ];
        }

        // Update Transaction
        $transaction->update($paymentDetails);

        // Send Email Notification
        Mail::to($request->email)->send(new ReceivePaymentMail($paymentDetails));

        return response()->json([
            'error' => false,
            'message' => 'Data confirmed successfully and email sent',
        ]);
    }
}
