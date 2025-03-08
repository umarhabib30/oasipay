<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
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

}
