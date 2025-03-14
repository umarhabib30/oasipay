<?php

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MakePaymentController;
use App\Http\Controllers\MonitoringTransactionController;
use App\Http\Controllers\OpenPositionController;
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
Route::post('email-verification/send',[EmailVerificationController::class, 'SendVerifyMail'])->name('send.code');
Route::get('email/verify/{email}/{code}',[EmailVerificationController::class, 'verifyCode'])->name('verify.code');

Route::get('seller-code',[SellerCodeController::class, 'index'])->name('seller.code');
Route::post('sellercode/save',[SellerCodeController::class, 'submitCode'])->name('save.sellercode');


Route::get('receive-payment',[PaymentReceiveController::class, 'index'])->name('receive-payment');
Route::post('receive/payment/store',[PaymentReceiveController::class, 'store'])->name('receivepayment.store');
Route::post('get/transaction',[PaymentReceiveController::class, 'getTransaction'])->name('get.transaction');

Route::get('monitoring-transactions/{id}',[MonitoringTransactionController::class, 'index'])->name('monitoring.transactions');

Route::get('make-payment',[MakePaymentController::class, 'index'])->name('make.payment');

Route::get('fee',[FeeController::class, 'index'])->name('fee.index');
Route::get('faq',[FaqController::class,'index'])->name('faq');
Route::get('contact-us',[ContactUsController::class, 'index'])->name('contact-us');
Route::get('open-positions',[OpenPositionController::class, 'index'])->name('jobs');
