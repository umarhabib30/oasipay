<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerCode extends Model
{
    use HasFactory;

    protected $fillable=[
        'name','email','code','price','currency','words','rand_code'
    ];
}
