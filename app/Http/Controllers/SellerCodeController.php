<?php

namespace App\Http\Controllers;

use App\Mail\SellerCodeMail;
use App\Mail\VerifyEmailMail;
use App\Models\SellerCode;
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
                'exp_at' =>  Carbon::now()->addMinutes(15),
            ]);

            Mail::to($request->email)->send(new VerifyEmailMail($code));
            return response()->json([
                'error' => false,
                'message' => 'Verification code is sent to your mail please check',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function verifyCode(Request $request)
    {
        $check = VerifyEmail::where('email', $request->email)->where('token', $request->code)->first();
        if ($check) {
            if (Carbon::now()->greaterThan($check->exp_at)) {
                return response()->json(['error' => true, 'message' => 'Token has expired.']);
            }
            return response()->json([
                'error' => false,
                'message' => 'Email verified',
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Incorrect verification code',
            ]);
        }
    }

    public function submitCode(Request $request){
        $code = rand(100000, 999999);
        SellerCode::create([
            'name' => $request->name,
            'email' => $request->email,
            'code' => $request->seller_code,
            'price' => $request->price,
            'currency' => 'euro',
            'words' => $request->words,
            'rand_code' => $code,
        ]);

        Mail::to($request->email)->send(new SellerCodeMail($code));

        return redirect()->back()->with('success','Seller code sent successfully');
    }
}
