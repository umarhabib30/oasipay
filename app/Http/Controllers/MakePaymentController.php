<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MakePaymentController extends Controller
{
    public function index(){
        $data=[
            'title' => 'Make Payment'
        ];
        return view('make-payment',$data);
    }

    public function paywithoutcode(){
        $data=[
            'title' => 'Make Payment'
        ];
        return view('pay-without-code',$data);
    }
}
