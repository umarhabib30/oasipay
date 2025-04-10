<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Contact Us'
        ];
        return view('contact-us', $data);
    }

    public function store(Request $request)
    {
        try{
            $validation = Validator::make($request->all(), [
                'email' => 'required',
                'message' => 'required'
            ]);

            if ($validation->fails()) {
                return redirect()->back()->with('error', $validation->errors()->first());
            }

            Contact::create([
                'email' => $request->email,
                'message' => $request->message,
            ]);

            Mail::to($request->email)->send(new ContactUsMail);
            return redirect()->back()->with('success', 'Thank you for contacting us');
        }catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
