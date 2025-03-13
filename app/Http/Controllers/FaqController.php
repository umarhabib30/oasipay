<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        $data=[
            'title' => 'Faqs'
        ];
        return view('faq',$data);
    }
}
