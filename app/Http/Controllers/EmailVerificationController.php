<?php

namespace App\Http\Controllers;

use App\Mail\ItemReceiveMail;
use App\Mail\VerifyEmailMail;
use App\Models\Transaction;
use App\Models\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
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

    public function verifyCode($email, $code)
    {
        $check = VerifyEmail::where('email', $email)->where('token', $code)->first();
        if ($check) {
            if (Carbon::now()->greaterThan($check->exp_at)) {
                return view('emails.verify-confirmation', ['error' => true, 'message' => 'Token has expired.']);
            } else {
                $check->update(['is_verified' => true]);
                return view('emails.verify-confirmation', ['error' => false, 'message' => 'Email verified',]);
            }
        } else {
            return view('emails.verify-confirmation', ['error' => true, 'message' => 'Incorrect verification code',]);
        }
    }

    public function verifySellerMail($email, $code, $name)
    {
        $check = VerifyEmail::where('email', $email)->where('token', $code)->first();
        if (Carbon::now()->greaterThan($check->exp_at)) {
            return view('emails.verify-confirmation', ['error' => true, 'message' => 'Token expired you have again verify your email']);
        } else {
            $check->update(['is_verified' => true]);
            $data = [
                'title' => 'Seller Code',
                'email' => $email,
                'name' => $name,
                'code' => $code
            ];
            return view('seller-code', $data);
        }
    }

    public function verifyPaymentReceive($email, $code, $name)
    {
        $check = VerifyEmail::where('email', $email)->where('token', $code)->first();
        if (Carbon::now()->greaterThan($check->exp_at)) {
            return view('emails.verify-confirmation', ['error' => true, 'message' => 'Token expired you have again verify your email']);
        } else {
            $check->update(['is_verified' => true]);
            $data = [
                'title' => 'Receive Payment',
                'email' => $email,
                'name' => $name,
                'code' => $code
            ];
            return view('receive-payment', $data);
        }
    }

    public function verifyMakePaymentMail($email, $code, $name){
        $check = VerifyEmail::where('email', $email)->where('token', $code)->first();
        if (Carbon::now()->greaterThan($check->exp_at)) {
            return view('emails.verify-confirmation', ['error' => true, 'message' => 'Token expired you have again verify your email']);
        } else {
            $check->update(['is_verified' => true]);
            $data = [
                'title' => 'Make Payment',
                'email' => $email,
                'name' => $name,
                'code' => $code
            ];
            return view('make-payment', $data);
        }
    }

    public function verifyMakePaymentMailFor($email, $code, $name,$seller_code){
        $check = VerifyEmail::where('email', $email)->where('token', $code)->first();
        if (Carbon::now()->greaterThan($check->exp_at)) {
            return view('emails.verify-confirmation', ['error' => true, 'message' => 'Token expired you have again verify your email']);
        } else {
            $check->update(['is_verified' => true]);
            $transaction = Transaction::where('seller_code',$seller_code)->first();
            $data = [
                'title' => 'Make Payment',
                'email' => $email,
                'name' => $name,
                'code' => $code,
                'transaction' => $transaction,
            ];
            return view('make-payment-for', $data);
        }
    }

    public function verifyItemReceiveMail($email, $code, $name,$seller_code){
        $check = VerifyEmail::where('email', $email)->where('token', $code)->first();
        if (Carbon::now()->greaterThan($check->exp_at)) {
            return view('emails.verify-confirmation', ['error' => true, 'message' => 'Token expired you have again verify your email']);
        } else {
            $check->update(['is_verified' => true]);
            $transaction = Transaction::where('seller_code',$seller_code)->first();
            $transaction->update([
                'item_recieved' => true,
                'tracking_status' => 'Item Delivered',
            ]);

            $data =[
                'name' => $transaction->receiver_name,
                'seller_code' => $transaction->seller_code,
            ];

            Mail::to($transaction->receiver_email)->send(new ItemReceiveMail($data));
            return redirect()->route('monitoring.transactions', ['id' => $transaction->seller_code])
                     ->with('success', 'Item received successfully');
        }
    }
}
