<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index(){
        $data=[
            'title' => 'Fee'
        ];
        return view('fee',$data);
    }
}
