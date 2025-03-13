<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyEmail extends Model
{
    use HasFactory;

    protected $fillable=[
        'email',
        'token',
        'exp_at',
        'is_verified',
    ];
}
