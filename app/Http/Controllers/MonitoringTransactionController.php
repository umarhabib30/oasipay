<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmailMail;
use App\Models\Transaction;
use App\Models\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MonitoringTransactionController extends Controller
{
    public function index($id)
    {
        $transaction =  Transaction::where('seller_code', $id)->first();
        if ($transaction) {
            if($transaction->is_cancelled){
                return redirect()->back()->with('error', 'Transaction has been cancelled');
            }
            $data = [
                'title' => 'Monitoring Transaction',
                'transaction' => $transaction,
            ];
            return view('monitoring-transaction', $data);
        } else {
            return redirect()->back()->with('error', 'No record found');
        }
    }

    public function cancel($seller_code)
    {
        $transaction = Transaction::where('seller_code', $seller_code)->first();
        $data = [
            'title' => 'Cancel Transaction',
            'transaction' => $transaction,
        ];
        return view('cancel-transaction', $data);
    }

    public function cancelStore(Request $request)
    {
        try {
            $transaction = Transaction::where('seller_code', $request->seller_code)->first();
            if($transaction->shipping_code){
                return response()->json([
                    'error' => true,
                    'message' => 'Transaction cannot be cancelled now',
                ]);
            }
            $transaction->update([
                'cancel_by_name' => $request->name,
                'cancel_by_email' => $request->email,
                'is_cancelled' => true
            ]);
            return response()->json([
                'error' => false,
                'message' => 'Transaction cancelled successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function confirmCode(Request $request)
    {
        $transaction = Transaction::where('seller_code', $request->seller_code)->where('seller_email', $request->email)->first();
        if ($transaction) {
            return response()->json([
                'error' => false,
                'message' => 'Transaction code confirmed',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Invalid Transaction code',
            ]);
        }
    }

    public function shippingCode(Request $request)
    {
        $transaction = Transaction::where('seller_code', $request->seller_code)->first();
        if ($transaction->seller_email == $request->email) {
            $transaction->update([
                'shipping_code' => $request->shipping_code
            ]);
            return response()->json([
                'error' => false,
                'message' => 'Shipping code added successfully',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'You must enter seller email to insert the shipping code',
            ]);
        }
    }

    public function sendVerificationMail(Request $request){
        try {
            $transaction = Transaction::where('seller_code', $request->seller_code)->first();
            if (($transaction->receiver_email != $request->email) || ($transaction->receiver_name != $request->name)) {
                return response()->json([
                    'error' => true,
                    'message' => 'Buyer name or email does not match',
                ]);
            }


            $code = rand(100000, 999999);
            VerifyEmail::create([
                'email' => $request->email,
                'token' => $code,
                'is_verified' => false,
                'exp_at' =>  Carbon::now()->addMinutes(15),
            ]);

            $data = [
                'code' => $code,
                'email' => $request->email,
                'name' => $request->name,
                'source' => $request->source ?? 'other',
                'seller_code' => $request->seller_code ?? '0',
            ];

            Mail::to($request->email)->send(new VerifyEmailMail($data));
            return response()->json([
                'error' => false,
                'message' => 'Please check your email for verification',
                'code' => $code,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
