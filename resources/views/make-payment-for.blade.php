@extends('layouts.app')
@section('content')
    <main>
        <section class="make-a-payment-container">
            <h1>Make a Payment</h1>

            {{-- make payment without code form --}}
            <form action="{{ route('make.payment.withoutcode') }}" method="POST" id="make_payment_without_code_form">
                @csrf
                <input type="hidden" name="name" id=""  @if (isset($name)) value="{{ $name }}" @endif>
                <input type="hidden" name="email" id=""  @if (isset($email)) value="{{ $email }}" @endif>
            </form>

            {{-- make payment through api --}}
            <form action="{{ route('pay.through.api') }}" method="POST" id="make_payment_through_api">
                @csrf
                <input type="hidden" name="seller_code" id=""  value="{{ $transaction->seller_code }}">
                <input type="hidden" name="name" id=""  @if (isset($name)) value="{{ $name }}" @endif>
                <input type="hidden" name="email" id=""  @if (isset($email)) value="{{ $email }}" @endif>
            </form>

            <form class="make-a-payment-form" action="">
                <input type="hidden" name="verification_code" id="verification_code" @if (isset($code)) value="{{ $code }}" @endif>
                <div class="make-a-payment-column">
                    <div class="make-a-payment-form-main">
                        <div class="make-a-payment-form-left">
                            <div class="form-group">
                                <label for="name-input">Name</label>
                                <input type="text" id="name-input" name="name"
                                    @if (isset($name)) value="{{ $name }}" readonly @endif required />
                            </div>

                            <div class="form-group">
                                <label for="email-input">Email</label>
                                <input type="email" id="email-input" class="form-control" name="email"
                                    @if (isset($email)) value="{{ $email }}" readonly @endif required />
                            </div>

                            <div class="form-group">
                                <label for="seller-code-input">Insert seller code</label>
                                <input type="text" id="seller-code-input" class="form-control" value="{{ $transaction->seller_code }}" readonly name="seller_code"
                                    required />
                            </div>
                        </div>
                        <div class="make-a-payment-form-right">
                            <a href="#" id="send-code"><img src="{{ asset('assets/images/confirm.png') }}" /></a>
                        </div>
                    </div>
                    {{-- <a href="#" style="margin-top: 10px" class="btn" id="confirm-code">CONFIRM CODE</a> --}}
                    @if (isset($code))
                        <a href="#" style="margin-top: 10px" class="btn" id="confirm-code">CONFIRM CODE</a>
                    @else
                        <a href="#" style="margin-top: 10px" class="btn" id="confirm-code-first">CONFIRM CODE</a>
                    @endif

                    <p class="make-a-payment-text">
                        Remember to check the form and verify that the item you are paying
                        for is the right one!
                    </p>
                    <div class="make-a-payment-btn-box">
                        @if (isset($code))
                            <a href="#" class="btn submit_without_code">I PAY WITHOUT CODE</a>
                        @else
                            <a href="#" class="btn pay_without_code">I PAY WITHOUT CODE</a>
                        @endif
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
                            <img src="{{ asset('assets/images/apple-pay.png') }}" alt="apple-pay" />
                            <img src="{{ asset('assets/images/ame.png') }}" alt="apple-pay" />
                            <img src="{{ asset('assets/images/google-pay.png') }}" alt="google-pay" />
                        </div>
                        <div class="make-a-payments-images-rows">
                            <img src="{{ asset('assets/images/paypal.png') }}" alt="paypal" />
                            <img src="{{ asset('assets/images/Master.png') }}" />
                        </div>
                    </div>
                </div>

                <div class="make-a-payment-column">
                    <div class="form-group">
                        <label for="The-payment-is-for">The payment is for...</label>
                        <input type="text" id="The-payment-is-for" class="form-control" value="{{ $transaction->title }}" readonly name="The-payment-is-for"
                            required placeholder="Item for which you pay" />
                    </div>
                    <div class="form-group">
                        <label for="In-two-words">In two words....</label>
                        <textarea type="text" id="In-two-words" class="form-control" name="In-two-words" required
                            placeholder="small descripption of item" readonly>{{ $transaction->words }}</textarea>
                    </div>

                    <p class="make-a-payment-seller-price">Seller Price</p>
                    <p class="make-a-payment-price" id="seller_price_field">{{ $transaction->price }}€</p>
                    <div class="make-a-payment-price-details">
                        <p class="make-a-payment-fee-details">
                            The fees amount
                            <span class="make-a-payment-fee-details-span" id="fee_field">{{ $transaction->fee_price }}€</span>
                        </p>
                    </div>
                    <p class="make-a-payment-seller-price">You will pay</p>
                    <p class="make-a-payment-price make-a-payment-price01" id="you_pay_field">{{ $transaction->total }}€</p>
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
        $(document).ready(function() {

            $('body').on('click', '#confirm-code-first', function(e) {
                e.preventDefault();
                toastr.error('Please verify your name and email first');
            });


            $('body').on('click', '.pay_without_code', function(e) {
                e.preventDefault();
                toastr.error('Please verify your name and email first');
            });
            $('body').on('click', '.submit_without_code', function(e) {
                e.preventDefault();
                $('#make_payment_without_code_form').submit();
            });

            // ------------ email verification ------------
            $('body').on('click', '#send-code', function(e) {
                e.preventDefault();
                let email = $('#email-input').val();
                let name = $('#name-input').val();
                let seller_code = $('#seller-code-input').val();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                if (!name) {
                    toastr.error('Please insert name');
                    return;
                }
                if (!email) {
                    toastr.error('Please insert email first');
                    return;
                }
                let data = {
                    email: email,
                    name: name,
                    source: 'make_payment_for',
                    seller_code : seller_code,
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
                let email = $('#email-input').val();
                let name = $('#name-input').val();
                if (!name) {
                    toastr.error('Please enter name');
                    return;
                }
                if (!email) {
                    toastr.error('Please enter email');
                    return;
                }
                if (!seller_code) {
                    toastr.error('Please insert seller code first');
                } else {
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    let data = {
                        seller_code: seller_code,
                        email: email,
                        name: name,
                        _token: csrfToken
                    };

                    $.ajax({
                        url: "{{ route('get.transaction.make') }}",
                        type: "POST",
                        data: data,
                        success: function(response) {
                            if (response.error) {
                                toastr.error(response.message);
                            } else {
                                $('#seller_price_field').html(parseFloat(response.transaction
                                        .price).toFixed(2) + response.transaction
                                    .currency_symbol);
                                $('#fee_field').html(parseFloat(response.transaction.fee_price)
                                    .toFixed(2) + response.transaction.currency_symbol);
                                $('#you_pay_field').html((parseFloat(response.transaction
                                        .fee_price) + parseFloat(response.transaction
                                        .price)).toFixed(2) + response.transaction
                                    .currency_symbol);
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

            // --- proceed to payment ---
            $('body').on('click','.buy-follow-receive__btn',function(e){
                e.preventDefault();
                let seller_code = $('#seller-code-input').val();
                let email = $('#email-input').val();
                let name = $('#name-input').val();
                let verification_code = $('#verification_code').val();
                if (!name) {
                    toastr.error('Please enter name');
                    return;
                }
                if (!email) {
                    toastr.error('Please enter email');
                    return;
                }
                if (!verification_code) {
                    toastr.error('Please verify email');
                    return;
                }

                $('#make_payment_through_api').submit();

            })
        });
    </script>
@endsection
