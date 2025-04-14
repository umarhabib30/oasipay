<?php

namespace App\Http\Controllers;

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

    public function makePaymentFor($code){
        $transaction = Transaction::where('seller_code', $code)->first();
        $data = [
            'title' => 'Make Payment',
            'transaction' => $transaction
        ];
        return view('make-payment-for', $data);
    }

    public function pay(Request $request){
        try{
            $transaction = Transaction::where('seller_code',$request->seller_code)->first();
            $transaction->update([
                'receiver_name' => $request->name,
                'receiver_email' => $request->email,
            ]);

            $data=[
                'receiver_name' => $transaction->receiver_name,
                'receiver_email' => $transaction->receiver_email,
                'seller_code' => $transaction->seller_code,
                'price' => $transaction->price,
                'fee_price' => $transaction->fee_price,
                'currency' => $transaction->currency,
                'currency_symbol' => $transaction->currency_symbol,
                'words' => $transaction->words,
                'title' => $transaction->title,
            ];

            Mail::to($transaction->receiver_email)->send(new TransactionConfirmMail($data));

            return redirect('/')->with('success','Transaction made successfully');
        }catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    public function paywithoutcodeSubmit(Request $request){
        dd($request);
    }
}
