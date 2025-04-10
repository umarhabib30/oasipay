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
use App\Http\Controllers\TellUsController;
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
Route::get('email/verify/{email}/{code}/{name}',[EmailVerificationController::class, 'verifySellerMail'])->name('verify.code.seller');
Route::get('email/verify/receivepayment/{email}/{code}/{name}',[EmailVerificationController::class, 'verifyPaymentReceive'])->name('verify.code.receivepayment');
Route::get('email/verify/makepayment/{email}/{code}/{name}',[EmailVerificationController::class, 'verifyMakePaymentMail'])->name('verify.code.makepayment');

Route::get('seller-code',[SellerCodeController::class, 'index'])->name('seller.code');
Route::post('sellercode/save',[SellerCodeController::class, 'submitCode'])->name('save.sellercode');


Route::get('receive-payment',[PaymentReceiveController::class, 'index'])->name('receive-payment');
Route::post('receive/payment/store',[PaymentReceiveController::class, 'store'])->name('receivepayment.store');
Route::post('get/transaction',[PaymentReceiveController::class, 'getTransaction'])->name('get.transaction');

Route::get('monitoring-transactions/{id}',[MonitoringTransactionController::class, 'index'])->name('monitoring.transactions');
Route::get('cancel-transaction/{seller_code}',[MonitoringTransactionController::class, 'cancel'])->name('transaction.cancel');
Route::post('cancel-transaction/store',[MonitoringTransactionController::class, 'cancelStore'])->name('transaction.cancel.store');
Route::post('transaction/confirm-code',[MonitoringTransactionController::class,'confirmCode'])->name('transaction.confirm.code');
Route::post('transaction/shipping-code/store',[MonitoringTransactionController::class, 'shippingCode'])->name('transaction.shipping.store');

Route::get('tell-us/{seller_code}',[TellUsController::class,'index'])->name('tellus');
Route::post('tell-us/store',[TellUsController::class, 'store'])->name('tell-us.store');

Route::get('make-payment',[MakePaymentController::class, 'index'])->name('make.payment');
Route::post('pay-without-code',[MakePaymentController::class, 'paywithoutcode'])->name('make.payment.withoutcode');
Route::post('get/transaction/make',[MakePaymentController::class, 'getTransaction'])->name('get.transaction.make');


Route::get('fee',[FeeController::class, 'index'])->name('fee.index');
Route::get('faq',[FaqController::class,'index'])->name('faq');
Route::get('open-positions',[OpenPositionController::class, 'index'])->name('jobs');

Route::get('contact-us',[ContactUsController::class, 'index'])->name('contact-us');
Route::post('contact-us/store',[ContactUsController::class, 'store'])->name('contact-us.store');

