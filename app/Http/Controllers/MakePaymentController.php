<?php

namespace App\Http\Controllers;

use App\Mail\PayWithoutCodeMail;
use App\Mail\TransactionConfirmMail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MakePaymentController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Make Payment'
        ];
        return view('make-payment', $data);
    }

    public function paywithoutcode(Request $request)
    {
        Transaction::create([
            'receiver_name' => $request->name,
            'receiver_email' => $request->email,
        ]);
        $data = [
            'title' => 'Make Payment',
            'name' => $request->name,
            'email' => $request->email,
        ];
        return view('pay-without-code', $data);
    }

    public function getTransaction(Request $request)
    {
        try {
            $transaction = Transaction::where('seller_code', $request->seller_code)->first();
            // if (($transaction->receiver_email != $request->email) || ($transaction->receiver_name != $request->name)) {
            //     return response()->json([
            //         'error' => true,
            //         'message' => 'Buyer name or email does not match',
            //     ]);
            // }
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

                if ($transaction->item_recieved) {
                    return response()->json([
                        'error' => true,
                        'message' => 'Item already received',
                    ]);
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

    public function makePaymentFor($code)
    {
        $transaction = Transaction::where('seller_code', $code)->first();
        if ($transaction->is_cancelled) {
            return redirect('/')->with('error', 'Transaction is cancelled');
        }
        $data = [
            'title' => 'Make Payment',
            'transaction' => $transaction
        ];
        return view('make-payment-for', $data);
    }

    public function pay(Request $request)
    {
        try {
            $transaction = Transaction::where('seller_code', $request->seller_code)->first();
            $transaction->update([
                'receiver_name' => $request->name,
                'receiver_email' => $request->email,
                'transaction_status' => 'Payment in charge of Oasipay',
            ]);

            return redirect()->route('payment.initialize', ['seller_code' => $transaction->seller_code, 'type' => 'with_code']);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function paywithoutcodeSubmit(Request $request)
    {

        $code = rand(100000, 999999);
        $price =  number_format((float) str_replace(',', '', $request->price), 2, '.', ',');

        Transaction::create([
            'receiver_name' => $request->receiver_name,
            'receiver_email' => $request->receiver_email,
            'seller_code' => $code,
            'price' => $price,
            'total' => $request->total_price,
            'fee_price' => $request->fee_price,
            'currency' => $request->currency,
            'currency_symbol' => $request->currency_symbol,
            'words' => $request->words,
            'title' => $request->title,
            'without_code' => true,
            'transaction_status' => 'Payment in charge of Oasipay',
        ]);

        return redirect()->route('payment.initialize', ['seller_code' => $code, 'type' => 'without_code']);
    }
}
