<?php

namespace App\Http\Controllers;

use App\Mail\SellerCodeMail;
use App\Mail\VerifyEmailMail;
use App\Models\SellerCode;
use App\Models\Transaction;
use App\Models\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SellerCodeController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Seller Code'
        ];
        return view('seller-code', $data);
    }

    public function submitCode(Request $request)
    {

        $verification = VerifyEmail::where('email', $request->email)->where('token', $request->code)->first();

        if ($verification && $verification->is_verified) {
            // Sanitize price input
            $raw_price = str_replace(',', '', $request->price); // Remove commas
            $price = is_numeric($raw_price) ? floatval($raw_price) : 0;

            // Determine fee
            if ($price <= 10) {
                $fee_price = 0.5;
            } else if ($price > 10 && $price <= 1500) {
                $fee_price = $price * 0.05;
            } else {
                $fee_price = 100;
            }

            $total = $price + $fee_price;
            $total = number_format($total, 2, '.', ',');
            $fee_price = number_format($fee_price, 2, '.', ',');
            $price = number_format($price, 2, '.', ',');
            $code = rand(100000, 999999);

            Transaction::create([
                'seller_name' => $request->name,
                'seller_email' => $request->email,
                'seller_code' => $code,
                'price' => $price,
                'fee_price' =>  $fee_price,
                'total' => $total,
                'currency' => $request->currency,
                'currency_symbol' => $request->currency_symbol,
                'words' => $request->words,
                'title' => $request->title,
            ]);

            $data = [
                'seller_name' => $request->name,
                'seller_email' => $request->email,
                'seller_code' => $code,
                'price' => $price,
                'fee_price' => $fee_price,
                'total' => $total,
                'currency' => $request->currency,
                'currency_symbol' => $request->currency_symbol,
                'words' => $request->words,
                'title' => $request->title,
            ];

            // Mail::to($request->email)->send(new SellerCodeMail($data));

            return response()->json([
                'error' => false,
                'message' => 'Seller code generated successfully',
                'redirect_url' => route('receive-payment-for', ['code' => $code]),
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Please check your inbox to verify your email',
            ]);
        }

    }
}
