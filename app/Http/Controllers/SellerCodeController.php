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

    public function SendVerifyMail(Request $request)
    {
        try {
            $code = rand(100000, 999999);
            VerifyEmail::create([
                'email' => $request->email,
                'token' => $code,
                'is_verified' => false,
                'exp_at' =>  Carbon::now()->addMinutes(15),
            ]);

            $data =[
                'code' => $code,
                'email' => $request->email,
            ];

            Mail::to($request->email)->send(new VerifyEmailMail($data));
            return response()->json([
                'error' => false,
                'message' => 'Please check your email for verification',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function verifyCode($email, $code)
    {
        $check = VerifyEmail::where('email', $email)->where('token', $code)->first();
        if ($check) {
            if (Carbon::now()->greaterThan($check->exp_at)) {
                return view('emails.verify-confirmation',['error' => true, 'message' => 'Token has expired.']);
            }else{
                $check->update(['is_verified' => true]);
                return view('emails.verify-confirmation',[ 'error' => false, 'message' => 'Email verified', ]);
            }
        } else {
            return view('emails.verify-confirmation',[ 'error' => true, 'message' => 'Incorrect verification code', ]);
        }
    }

    public function submitCode(Request $request){
        $code = rand(100000, 999999);
        Transaction::create([
            'seller_name' => $request->name,
            'seller_email' => $request->email,
            'seller_code' => $code,
            'price' => $request->price,
            'currency' => 'euro',
            'words' => $request->words,
            'title' => $request->title,
        ]);

        Mail::to($request->email)->send(new SellerCodeMail($code));

        return redirect()->back()->with('success','Seller code sent successfully');
    }
}
