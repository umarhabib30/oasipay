<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('seller_name')->nullable();
            $table->string('seller_email')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('receiver_email')->nullable();
            $table->string('title')->nullable();
            $table->string('price')->nullable();
            $table->string('fee_price')->nullable();
            $table->string('total')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_symbol')->nullable();
            $table->string('words')->nullable();
            $table->string('seller_code')->nullable();
            $table->string('bank_type')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('iban')->nullable();
            $table->string('bic_swift')->nullable();
            $table->string('paypal_link')->nullable();
            $table->string('shipping_code')->nullable();
            $table->boolean('is_cancelled')->default(false);
            $table->string('cancel_by_name')->nullable();
            $table->string('cancel_by_email')->nullable();
            $table->boolean('item_recieved')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
