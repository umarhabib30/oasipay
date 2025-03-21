<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

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
            $transaction->update([
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
}
