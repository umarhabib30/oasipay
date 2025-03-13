<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MakePaymentController;
use App\Http\Controllers\PaymentReceiveController;
use App\Http\Controllers\SellerCodeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class, 'index'])->name('home');

// ----- email verification routes ---------
Route::post('email-verification/send',[SellerCodeController::class, 'SendVerifyMail'])->name('send.code');
Route::get('email/verify/{email}/{code}',[SellerCodeController::class, 'verifyCode'])->name('verify.code');

Route::get('seller-code',[SellerCodeController::class, 'index'])->name('seller.code');
Route::post('sellercode/save',[SellerCodeController::class, 'submitCode'])->name('save.sellercode');


Route::get('receive-payment',[PaymentReceiveController::class, 'index'])->name('receive-payment');
Route::get('make-payment',[MakePaymentController::class, 'index'])->name('make.payment');
