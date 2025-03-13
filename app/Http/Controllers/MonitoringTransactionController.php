<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringTransactionController extends Controller
{
    public function index(){
        $data=[
            'title' => 'Monitoring Transaction'
        ];
        return view('monitoring-transaction',$data);
    }
}
