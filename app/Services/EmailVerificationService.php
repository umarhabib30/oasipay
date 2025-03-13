<?php
namespace App\Services;

use App\Models\VerifyEmail;
use App\Mail\VerifyEmailMail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailVerificationService
{
    public function sendVerificationMail($email)
    {
        try {
            $code = rand(100000, 999999);
            VerifyEmail::create([
                'email' => $email,
                'token' => $code,
                'is_verified' => false,
                'exp_at' => Carbon::now()->addMinutes(15),
            ]);

            $data = [
                'code' => $code,
                'email' => $email,
            ];

            Mail::to($email)->send(new VerifyEmailMail($data));

            return [
                'error' => false,
                'message' => 'Please check your email for verification',
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function verifyCode($email, $code)
    {
        $check = VerifyEmail::where('email', $email)->where('token', $code)->first();

        if ($check) {
            if (Carbon::now()->greaterThan($check->exp_at)) {
                return ['error' => true, 'message' => 'Token has expired.'];
            }

            $check->update(['is_verified' => true]);
            return ['error' => false, 'message' => 'Email verified'];
        }

        return ['error' => true, 'message' => 'Incorrect verification code'];
    }
}
