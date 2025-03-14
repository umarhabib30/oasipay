<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\VerifyEmail;
use Illuminate\Http\Request;

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
        $verification = VerifyEmail::where('email', $request->email)->where('token', $request->verification_code)->first();
        if ($verification->is_verified) {
            $transaction = Transaction::where('seller_code', $request->seller_code)->first();
            if ($transaction) {
                if ($request->receive_payment == 'paypal') {
                    $transaction->update([
                        'receiver_name' => $request->name,
                        'receiver_email' => $request->email,
                        'bank_type' => 'Paypal',
                        'paypal_link' => $request->paypal_link,
                    ]);
                } else {
                    $transaction->update([
                        'receiver_name' => $request->name,
                        'receiver_email' => $request->email,
                        'bank_type' => 'Bank Transfer',
                        'account_holder_name' => $request->account_holder_name,
                        'bic_swift' => $request->bic_swift,
                        'iban' => $request->iban,
                    ]);
                }

                return response()->json([
                    'error' => false,
                    'message' => 'Data confirm successfully',
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'Please check your buyer code is incorrect',
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Please check your inbox to verify email',
            ]);
        }
    }
}
