@extends('layouts.app')
@section('style')
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endsection
@section('content')
    <main>
        <section class="pay-without-code-container">
            <form action="{{ url('pay-without-code/submit') }}" method="POST" id="submit-withoutcode-form">
                @csrf
                <input type="hidden" name="receiver_name" id="receiver_name" value="{{ $name }}">
                <input type="hidden" name="receiver_email" id="receiver_email" value="{{ $email }}">
                <input type="hidden" name="price" id="price">
                <input type="hidden" name="fee_price" id="fee_price">
                <input type="hidden" name="total_price" id="total_price">
                <input type="hidden" name="currency" id="currency">
                <input type="hidden" name="currency_symbol" id="currency_symbol">
                <input type="hidden" name="words" id="words">
                <input type="hidden" name="title" id="title">
            </form>

            <h1>I want to pay without code</h1>
            <form class="pay-without-code-form" action="">
                <div class="pay-without-code-column">
                    <div class="pay-without-code-form-main">
                        <div class="pay-without-code-form-left">


                            <div class="form-group">
                                <label for="email-input">E-mail</label>
                            <input type="email" id="email-input" class="form-control" name="email" value="{{ $email }}" required />
                            </div>
                        </div>
                        <div class="pay-without-code-form-right">
                            <a href="#"><img src="/assets/images/confirm.png" /></a>
                        </div>
                    </div>
                    <div class="form-group form-group-seller-code-input">
                        <label for="seller-code-input">The payment is for...</label>
                        <input type="text" id="title-input" class="form-control" name="seller_code"
                            placeholder="item for which you pay " required />
                    </div>
                    <div class="form-group form-group-In-two-words">
                        <label for="In-two-words">In two words...</label>
                        <textarea type="text" id="In-two-words" class="form-control" name="In-two-words" required
                            placeholder="small descripption of item"></textarea>
                    </div>
                    <p class="pay-without-code-seller-price">
                        Enter the sales price
                    </p>
                    <p class="pay-without-code-text">
                        remember that this price does not include shipping, contact the
                        seller to make an agreement!
                    </p>
                    <div style="display: flex; align-items: center; ">
                        <input type="text" class="pay-without-code-price make-a-payment-price01" name="price"
                            value="0" style="height: 45px; width: 67%" id="price_input">
                        <select class="generate-seller-code-price make-a-payment-price01"
                            style="width: 23%;height: 45px;font-size: 25px;" id="currency_input">
                            <option value="EUR" selected>€</option>
                            <option value="USD">$</option>
                            <option value="GBP">£</option>
                            <option value="CHF">CHF</option>
                            <option value="JPY">¥</option>
                        </select>

                    </div>
                    <p class="pay-without-code-text">
                        In this case OasiPay only takes care of the transaction, not the
                        shipping!
                    </p>
                    <div class="buy-follow-receive__payments">
                        <img src="{{ asset('assets/images/apple-pay.png') }}" alt="apple-pay" />
                        <img src="{{ asset('assets/images/ame.png') }}" alt="apple-pay" />
                        <img src="{{ asset('assets/images/google-pay.png') }}" alt="google-pay" />
                        <img src="{{ asset('assets/images/paypal.png') }}" alt="paypal" />
                        <img src="{{ asset('assets/images/Master.png') }}" />
                    </div>
                </div>

                <div class="pay-without-code-column">
                    <p class="pay-without-code-seller-price">The fees amount</p>
                    <p class="pay-without-code-price make-a-payment-price01" id="the_fee_amount">0€</p>
                    <p class="pay-without-code-seller-price pay-without-code-seller-price01">You will pay</p>
                    <p class="pay-without-code-price" id="you_will_pay">0€</p>

                    <p class="pay-without-code-fee-text">
                        The price shown includes OasiPay 5% fees to insure the transaction
                    </p>
                    <br />
                    <p class="pay-without-code-fee-text">
                        Remember that by requesting the OasiPay code it only and
                        exclusively ensures the transaction but does not take care of the
                        shipping, therefore you are invited to contact the seller to
                        provide him with the code issued by us in order to confirm the
                        payment and find an agreement with the shipping. the unique code
                        will be forwarded, together with a detailed summary of the item
                        ordered and the amount paid, to the email indicated in the form...
                    </p>

                    <div class="buy-follow-receive__buttons">
                        <div class="btn-box1">
                            <button class="buy-follow-receive__btn">
                                <p>PROCEED TO PAY</p>
                                <img src="{{ asset('assets/images/fav.png') }}" alt="" />
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
@section('script')
    <script>
        document.getElementById("price_input").addEventListener("input", function() {
            let price = parseFloat(this.value.replace(/,/g, "")) || 0;

            let fee_price = 0;

            if (price <= 10) {
                fee_price = 0.5;
            } else if (price > 10 && price <= 1500) {
                fee_price = price * 0.05;
            } else {
                fee_price = 100;
            }

            let total = price + fee_price;

            // Format numbers with thousands separator and two decimal places
            function formatCurrency(value) {
                return value.toLocaleString("en-US", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }) + "€";
            }


            document.getElementById("the_fee_amount").innerText = formatCurrency(fee_price);
            document.getElementById("you_will_pay").innerText = formatCurrency(total);
        });

        $(document).ready(function(){

            $('#price_input').on('input', function (e) {
                var currentValue = $(this).val();
                var cursorPosition = this.selectionStart;

                // Allow digits, comma, and dot
                var cleanedValue = currentValue.replace(/[^0-9.,]/g, '');

                // Prevent consecutive , and . (., or ,.)
                cleanedValue = cleanedValue.replace(/([.,])([.,])/g, '$2');

                // Ensure only one dot
                let dotParts = cleanedValue.split('.');
                if (dotParts.length > 2) {
                    cleanedValue = dotParts[0] + '.' + dotParts.slice(1).join('').replace(/\./g, '');
                }

                // Ensure only one comma
                let commaParts = cleanedValue.split(',');
                if (commaParts.length > 2) {
                    cleanedValue = commaParts[0] + ',' + commaParts.slice(1).join('').replace(/,/g, '');
                }

                // Set the cleaned value back
                $(this).val(cleanedValue);

                // Restore cursor position
                this.setSelectionRange(cursorPosition, cursorPosition);
            });



            $('body').on('click','.buy-follow-receive__btn',function(e){
                e.preventDefault();
                let title = $('#title-input').val();
                let words = $('#In-two-words').val();
                let price = $('#price_input').val();
                let feeprice = $('#the_fee_amount').val();
                let totalprice = $('#you_will_pay').val();
                let currency = $('#currency_input').val();
                let currencySymbol = $('#currency_input option:selected').text();
                alert(feeprice);
                return;

                $('#title').val(title);
                $('#words').val(words);
                $('#price').val(price);
                $('#fee_price').val(feeprice);
                $('#total_price').val(totalprice);
                $('#currency').val(currency);
                $('#currency_symbol').val(currency);

                $('#submit-withoutcode-form').submit();
            });
        });
    </script>
@endsection
