<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Mail\TellUsMail;
use App\Models\Complain;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TellUsController extends Controller
{
    public function index($seller_code)
    {
        $transaction = Transaction::where('seller_code', $seller_code)->first();
        $data = [
            'title' => 'Tell Us',
            'transaction' => $transaction,
        ];
        return view('tell-us', $data);
    }

    public function store(Request $request)
    {
        $path = "";
        if ($request->hasFile('custom_file')) {
            $path = FileHelper::save($request->custom_file, 'complains');
        }

        $complain = Complain::create([
            'reason' => $request->reason,
            'email' => $request->email,
            'description' => $request->description,
            'image' => $path,
        ]);

        // Prepare data for the email
        $emailData = [
            'reason' => $request->reason,
            'email' => $request->email,
            'description' => $request->description,
            'image' => $path ? asset($path) : null, // Generate a public URL if an image is uploaded
        ];

        // Send Email Notification
        Mail::to($request->email)->send(new TellUsMail($emailData));

        return redirect()->route('monitoring.transactions', $request->seller_code)
            ->with('success', 'Your request has been sent successfully.');
    }
}
