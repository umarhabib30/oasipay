<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentReceiveController extends Controller
{
    public function index(){
        $data=[
            'title' => 'Receive Payment'
        ];
        return view('receive-payment',$data);
    }
}
