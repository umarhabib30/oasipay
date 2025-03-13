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
        if ($verification->is_verified) {

            $code = rand(100000, 999999);
            Transaction::create([
                'seller_name' => $request->name,
                'seller_email' => $request->email,
                'seller_code' => $code,
                'price' => $request->price,
                'currency' => $request->currency,
                'words' => $request->words,
                'title' => $request->title,
            ]);

            Mail::to($request->email)->send(new SellerCodeMail($code));
            return response()->json([
                'error' => false,
                'message' => 'Seller code is sent your email successfully',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Please check your inbox to verify email',
            ]);
        }
    }
}
