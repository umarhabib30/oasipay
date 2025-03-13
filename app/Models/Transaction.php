<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable=[
        'seller_name',
        'seller_email',
        'receiver_name',
        'receiver_email',
        'title',
        'price',
        'fee_price',
        'currency',
        'words',
        'seller_code',
        'bank_type',
        'account_holder_name',
        'iban',
        'bic_swift',
        'paypal_link',
    ];
}
