@extends('layouts.app')
@section('content')
    <main>
        <section class="make-a-payment-container">
            <h1>Make a Payment</h1>
            <form class="make-a-payment-form" action="">
                <input type="hidden" name="verification_code" id="verification_code">
                <div class="make-a-payment-column">
                    <div class="make-a-payment-form-main">
                        <div class="make-a-payment-form-left">
                            <div class="form-group">
                                <label for="name-input">Name</label>
                                <input type="text" id="name-input" name="name" required />
                            </div>

                            <div class="form-group">
                                <label for="email-input">Email</label>
                                <input type="email" id="email-input" class="form-control" name="email" required />
                            </div>

                            <div class="form-group">
                                <label for="seller-code-input">Insert seller code</label>
                                <input type="text" id="seller-code-input" class="form-control" name="seller_code"
                                    required />
                            </div>
                        </div>
                        <div class="make-a-payment-form-right">
                            <a href="#" id="send-code"><img src="{{ asset('assets/images/confirm.png')}}" /></a>
                        </div>
                    </div>
                    <a href="#" style="margin-top: 10px" class="btn" id="confirm-code">CONFIRM CODE</a>

                    <p class="make-a-payment-text">
                        Remember to check the form and verify that the item you are paying
                        for is the right one!
                    </p>
                    <div class="make-a-payment-btn-box">
                        <a href="{{ route('make.payment.withoutcode') }}" class="btn">I PAY WITHOUT CODE</a>
                        <a href="{{ route('seller.code') }}" class="btn">I WANT SELLER CODE</a>
                    </div>
                    <p class="make-a-payment-text">
                        What you are paying includes our taxes (5%) and shipping costs if
                        the seller ships through us. If the seller ships alone, the costs
                        are not present. We remind you that even in the case of
                        independent shipping, your money is still kept safe by OasiPay/
                    </p>

                    <div class="make-a-payments-images">
                        <div class="make-a-payments-images-rows">
                            <img src="{{ asset('assets/images/apple-pay.png')}}" alt="apple-pay" />
                            <img src="{{ asset('assets/images/ame.png')}}" alt="apple-pay" />
                            <img src="{{ asset('assets/images/google-pay.png')}}" alt="google-pay" />
                        </div>
                        <div class="make-a-payments-images-rows">
                            <img src="{{ asset('assets/images/paypal.png')}}" alt="paypal" />
                            <img src="{{ asset('assets/images/Master.png')}}" />
                        </div>
                    </div>
                </div>

                <div class="make-a-payment-column">
                    <div class="form-group">
                        <label for="The-payment-is-for">The payment is for...</label>
                        <input type="text" id="The-payment-is-for" class="form-control" name="The-payment-is-for"
                            required placeholder="Item for which you pay" />
                    </div>
                    <div class="form-group">
                        <label for="In-two-words">In two words....</label>
                        <textarea type="text" id="In-two-words" class="form-control" name="In-two-words" required
                            placeholder="small descripption of item"></textarea>
                    </div>

                    <p class="make-a-payment-seller-price">Seller Price</p>
                    <p class="make-a-payment-price" id="seller_price_field">00 €</p>
                    <div class="make-a-payment-price-details">
                        <p class="make-a-payment-fee-details">
                            The fees amount
                            <span class="make-a-payment-fee-details-span" id="fee_field">00 €</span>
                        </p>
                    </div>
                    <p class="make-a-payment-seller-price">You will pay</p>
                    <p class="make-a-payment-price make-a-payment-price01" id="you_pay_field">00 €</p>
                    <div class="buy-follow-receive__buttons">
                        <div class="btn-box1">
                            <button class="buy-follow-receive__btn">
                                <p>PROCEED TO PAY</p>
                                <img src="{{ asset('assets/images/fav.png')}}" alt="" />
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
        $(document).ready(function(){

             // ------------ email verification ------------
             $('body').on('click', '#send-code', function(e) {
                e.preventDefault();
                let email = $('#email-input').val();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                if (!email) {
                    toastr.error('Please insert email first');
                    return;
                }
                let data = {
                    email: email,
                    _token: csrfToken
                };
                $.ajax({
                    url: "{{ route('send.code') }}",
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.message);
                        } else {
                            $('#verification_code').val(response.code);
                            toastr.success(response.message);
                        }
                    },
                    error: function(error) {
                        console.log('Error sending code:', error);
                    }
                });
            });

             // -------------- get transaction data --------------
             $('body').on('click', '#confirm-code', function(e) {
                e.preventDefault();
                let seller_code = $('#seller-code-input').val();
                if (!seller_code) {
                    toastr.error('Please insert seller code first');
                } else {
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    let data = {
                        seller_code: seller_code,
                        _token: csrfToken
                    };

                    $.ajax({
                        url: "{{ route('get.transaction') }}",
                        type: "POST",
                        data: data,
                        success: function(response) {
                            if (response.error) {
                                toastr.error(response.message);
                            } else {
                                $('#seller_price_field').html(response.transaction.price + response.transaction.currency_symbol);
                                $('#fee_field').html(response.transaction.fee_price + response.transaction.currency_symbol);
                                $('#you_pay_field').html(parseInt(response.transaction.fee_price) + parseInt(response.transaction.price) +  response.transaction.currency_symbol);
                                $('#The-payment-is-for').val(response.transaction.title);
                                $('#In-two-words').html(response.transaction.words);
                                toastr.success(response.message);
                            }
                        },
                        error: function(error) {
                            console.log('Error sending code:', error);
                        }
                    });
                }
            });
        });
    </script>
@endsection
