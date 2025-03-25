<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class MakePaymentController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Make Payment'
        ];
        return view('make-payment', $data);
    }

    public function paywithoutcode()
    {
        $data = [
            'title' => 'Make Payment'
        ];
        return view('pay-without-code', $data);
    }

    public function getTransaction(Request $request)
    {
        try {
            $transaction = Transaction::where('seller_code', $request->seller_code)->first();
            if (($transaction->receiver_email != $request->email) || ($transaction->receiver_name != $request->name)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Buyer name or email does not match',
                ]);
            }
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
}
