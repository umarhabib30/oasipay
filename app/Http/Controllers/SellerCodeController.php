<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\VerifyEmail as ModelsVerifyEmail;
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
            ModelsVerifyEmail::create([
                'email' => $request->email,
                'token' => $code,
                'exp_at' =>  Carbon::now()->addMinutes(15),
            ]);

            Mail::to($request->email)->send(new VerifyEmail($code));
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

    public function verifyCode(Request $request){
        $check = VerifyEmail::where('email',$request->email)->where('token',$request->token)->first();
        if($check){
            return response()->json([
                'error' => false,
                'message' => 'Email verified',
            ]);
        }else{
            return response()->json([
                'error' => true,
                'message' => 'Incorrect verification code',
            ]);
        }
    }

}
