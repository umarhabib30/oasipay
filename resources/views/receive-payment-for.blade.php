@extends('layouts.app')
@section('content')
    <main>
        <section class="receive-payment-container">
            <h1>Receive a Payment</h1>
            <form class="receive-payment-form" action="" id="receive_payment_form">
                @csrf
                <input type="hidden" name="verification_code" id="verification_code"
                    @if (isset($code)) value="{{ $code }}" @endif>
                <input type="hidden" name="from_recieve_payment_for" value="yes" id="">
                <div class="receive-payment-column">
                    <div class="receive-payment-form-main">
                        <div class="receive-payment-form-left">
                            <div class="form-group">
                                <label for="name-input">Name</label>
                                <input type="text" id="name-input" name="name" required readonly
                                    value="{{ $transaction->seller_name }}" />
                            </div>

                            <div class="form-group">
                                <label for="email-input">Email</label>
                                <input type="email" id="email-input" class="form-control" name="email" required readonly
                                value="{{ $transaction->seller_email }}" />
                            </div>

                            <div class="form-group">
                                <label for="Insert-buyer-code">Insert buyer code</label>
                                <input type="text" id="Insert-buyer-cod" class="form-control" name="seller_code" value="{{ $transaction->seller_code }}" readonly required />
                            </div>
                        </div>
                        <div class="receive-payment-form-right">
                            <a href="#" id="send-code"><img src="{{ asset('assets/images/confirm.png') }}" /></a>
                        </div>
                    </div>

                    <div class="receive-payment-btn-box">
                        {{-- <a href="#" class="btn" id="confirm-code">CONFIRM CODE</a> --}}
                        @if (isset($code))
                            <a href="#" class="btn" id="confirm-code">CONFIRM CODE</a>
                        @else
                            <a href="#" class="btn" id="confirm-code-first">CONFIRM CODE</a>
                        @endif
                        <a href="{{ route('seller.code') }}" class="btn">I WANT SELLER CODE</a>

                    </div>
                    {{-- <p class="make-a-payment-seller-price">Buyer pay</p>
                    <p class="receive-payment-price" id="buyer_pay_data">0€</p> --}}
                    <p class="make-a-payment-seller-price">You receive</p>
                    <p class="receive-payment-price" id="receive_pay_data">{{ $transaction->price }}€</p>

                    <p class="receive-payment-text">
                        If the price is not consistent with the item offered for sale, do
                        not continue. Contact the seller and ask him to verify and redo
                        the correct payment!
                    </p>
                    {{-- <p class="make-a-payment-seller-price">You receive</p>
                    <p class="receive-payment-price" id="receive_pay_data">0€</p> --}}
                    <p class="make-a-payment-seller-price">Buyer pay</p>
                    <p class="receive-payment-price" id="buyer_pay_data">{{ $transaction->price + $transaction->fee_price }}€</p>

                </div>

                <div class="receive-payment-column">
                    <div class="form-group">
                        <label for="The-payment-is-for">You receive a payement for...</label>
                        <input type="text" id="The-payment-is-for" class="form-control" name="The-payment-is-for" value="{{ $transaction->title }}" required placeholder="Item for which you pay" readonly />
                    </div>
                    <div class="form-group">
                        <label for="In-two-words">In two words</label>
                        <textarea type="text" id="In-two-words" class="form-control" name="In-two-words" required readonly
                            placeholder="small descripption of item">{{ $transaction->words }}</textarea>
                    </div>

                    <p class="receive-payment-fee-text">
                        if the item does not match, do not confirm the data to receive
                        the payment....OasiPay is not responsible for inconsistencies
                        or misunderstandings with the buyer!
                    </p>

                </div>
                </div>

                <div class="receive-payment-column">
                    <h5 class="receive-payment-msize">How do you want to receive payment</h5>
                    <div class="receive-payment-radio-options">
                        <label>
                            <input type="radio" name="receive_payment" id="swift" value="bank" /><span
                                class="custom-radio"></span>
                            <img src="{{ asset('assets/images/iban.png') }}"></label>
                    </div>

                    <div class="form-group">
                        <label for="account-holder">Account holder name</label>
                        <input type="text" id="account-holder" name="account_holder_name" required />
                    </div>

                    <div class="form-group">
                        <label for="IBAN">IBAN</label>
                        <input type="text" id="IBAN" class="form-control" name="iban" required />
                    </div>
                    <div class="form-group">
                        <label for="BIC-Swift">BIC-Swift</label>
                        <input type="text" id="BIC-Swift" class="form-control" name="bic_swift" required />
                    </div>

                    <div class="receive-payment-radio-options">
                        <label><input type="radio" id="paypalRadio" name="receive_payment" value="paypal" /><span
                                class="custom-radio"></span>
                            <img class="paypal-icon" src="{{ asset('assets/images/paypal.png') }}"></label>
                    </div>
                    <div class="form-group form-group-f">
                        <label for="Insert-buyer-code">Insert your link for recive payment
                        </label>
                        <input type="text" id="Insert-buyer-code" class="form-control" name="paypal_link" required />
                    </div>
                    <div class="buy-follow-receive__buttons">
                        <div class="btn-box1">
                            <button class="buy-follow-receive__btn" id="receive_payment_btn">
                                <p>CONFIRM DATA</p>
                                <img src="{{ asset('assets/images/bubble-atoms.png') }}" alt="" />
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
                toastr.error('Already confirmed');
            });

            // ------------ email verification ------------
            $('body').on('click', '#send-code', function(e) {
                toastr.error('Already confirmed');
                return;
                e.preventDefault();
                let email = $('#email-input').val();
                let name = $('#name-input').val();
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
                    source: 'receive_payment',
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
                let seller_code = $('#Insert-buyer-cod').val();
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
                    toastr.error('Please insert buyer code first');
                } else {
                    let csrfToken = $('meta[name="csrf-token"]').attr('content');
                    let data = {
                        seller_code: seller_code,
                        name: name,
                        email: email,
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
                             $('#receive_pay_data').html(parseFloat(response.transaction.price).toFixed(2) + response.transaction.currency_symbol);
                            $('#buyer_pay_data').html((parseFloat(response.transaction.fee_price) + parseFloat(response.transaction.price)).toFixed(2) + response.transaction.currency_symbol);

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

            // ----------- store payment form ----------
            $('body').on('click', '#receive_payment_btn', function(e) {
                e.preventDefault();
                let verification_code = $('#verification_code').val();
                let name = $('#name-input').val();
                let email = $('#email-input').val();
                let title = $('#The-payment-is-for').val();
                let buyer_code = $('#Insert-buyer-cod').val();
                let bank_transfer = $('#swift').val();
                let account_holder = $('#account-holder').val();
                let iban = $('#IBAN').val();
                let swift_code = $('#BIC-Swift').val();
                let paypal_radio = $('#paypalRadio').val();
                let paypal_link = $('#Insert-buyer-code').val();



                if (!$('#swift').is(':checked') && !$('#paypalRadio').is(':checked')) {
                    toastr.error('Please select a payment method');
                    return;
                }

                if ($('#swift').is(':checked')) {
                    if (!account_holder) {
                        toastr.error('Please insert Account holder name');
                        return;
                    }
                    if (!iban) {
                        toastr.error('Please insert IBAN');
                        return;
                    }
                    if (!swift_code) {
                        toastr.error('Please insert BIC-Swift');
                        return;
                    }
                }

                if ($('#paypalRadio').is(':checked')) {
                    if (!paypal_link) {
                        toastr.error('Please insert your link for recive payment');
                        return;
                    }
                }
                let data = $('#receive_payment_form').serialize();
                $.ajax({
                    url: "{{ route('receivepayment.store') }}",
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.message);
                        } else {
                            $('#receive_payment_form')[0].reset();
                            $('#buyer_pay_data').html('0 €');
                            $('#receive_pay_data').html('0 €');
                            $('#In-two-words').html('');
                            toastr.success(response.message);
                        }
                    },
                    error: function(error) {
                        console.log('Error sending code:', error);
                    }
                });
            });
        });
    </script>
@endsection
