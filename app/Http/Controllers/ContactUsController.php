<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function index(){
        $data=[
            'title' => 'Contact Us'
        ];
        return view('contact-us',$data);
    }
}
