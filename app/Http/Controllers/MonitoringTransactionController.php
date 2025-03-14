<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class MonitoringTransactionController extends Controller
{
    public function index($id){
       $transaction =  Transaction::where('seller_code',$id)->first();
        $data=[
            'title' => 'Monitoring Transaction',
            'transaction' => $transaction,
        ];
        return view('monitoring-transaction',$data);
    }
}
