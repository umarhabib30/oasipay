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
            if(($transaction->seller_email != $request->email) || ($transaction->seller_name != $request->name) ){
                return response()->json([
                    'error' => true,
                    'message' => 'Seller name or email does not match',
                ]);
            }
            if ($transaction) {



                if ($transaction->is_cancelled) {
                    $message = 'Transaction is cancelled';

                    if ($request->ajax()) {
                        return response()->json([
                            'error' => true,
                            'message' => $message,
                        ]);
                    }

                    return redirect('/')->with('error', $message);
                }

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
        if($request->from_recieve_payment_for == 'no'){
            $verification = VerifyEmail::where('email', $request->email)
                ->where('token', $request->verification_code)
                ->first();

            if (!$verification || !$verification->is_verified) {
                return response()->json([
                    'error' => true,
                    'message' => 'Please check your inbox to verify email',
                ]);
            }
        }

        $transaction = Transaction::where('seller_code', $request->seller_code)->first();

        if (!$transaction) {
            return response()->json([
                'error' => true,
                'message' => 'Please check your buyer code is incorrect',
            ]);
        }

        $paymentDetails = [
            'seller_name' => $transaction->seller_name,
            'seller_email' => $transaction->seller_email,
            'seller_code' => $request->seller_code,
            'words' => $transaction->words,
            'title' => $transaction->title,
            'price' => $transaction->price,
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

    public function receivePaymentFor($code){
        $transaction = Transaction::where('seller_code',$code)->first();
        if ($transaction->is_cancelled) {
            return redirect('/')->with('error', 'Transaction is cancelled');
        }
        $data = [
            'title' => 'Receive Payment',
            'transaction' => $transaction,
        ];
        return view('receive-payment-for', $data);
    }
}
