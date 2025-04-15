@extends('layouts.app')
@section('style')
    <style>
        /* Remove spinner for WebKit browsers (Chrome, Safari) */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Remove spinner for Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        /* Safari-specific fix */
        input[type=number] {
            appearance: none;
            -webkit-appearance: none;
        }
    </style>
@endsection
@section('content')
    <main>
        <section class="generate-seller-code-container">
            <h1>Generate Seller Code</h1>
            <form class="generate-seller-code-form" action="{{ route('save.sellercode') }}" method="POST"
                id="seller_code_form">
                @csrf
                <input type="hidden" name="verification_code" id="verification_code"
                    @if (isset($code)) value="{{ $code }}" @endif>
                <div class="generate-seller-code-row">
                    <div class="generate-seller-code-column">
                        <div class="form-group">
                            <label for="name-input">Name</label>
                            <input type="text" id="name-input" name="name"
                                @if (isset($name)) value="{{ $name }}" @endif required />
                        </div>
                    </div>

                    <div class="generate-seller-code-column generate-seller-code-column-mail">
                        <div class="form-group">
                            <label for="email-input">E-mail</label>
                            <input type="email" id="email-input" class="form-control" name="email"
                                @if (isset($email)) value="{{ $email }}" @endif required />
                        </div>
                        <div class="generate-seller-code-form-right">
                            <a id="send-code"><img src="{{ asset('assets/images/confirm.png') }}" /></a>
                        </div>
                    </div>

                    <div class="generate-seller-code-column">
                        <div class="form-group form-group-seller-code-input">
                            <label for="seller-code-input">The code is for....</label>
                            <input type="text" id="title_input" class="form-control" name="title"
                                placeholder="item for the code is made" required />
                        </div>
                    </div>
                </div>

                <div class="generate-seller-code-row">
                    <div class="generate-seller-code-column">
                        <div class="form-group form-group-In-two-words">
                            <label for="In-two-words">In two words</label>
                            <textarea type="text" id="In-two-words" class="form-control" name="words" required
                                placeholder="small descripption of item"></textarea>
                        </div>
                    </div>

                    <div class="generate-seller-code-column">
                        <p class="generate-seller-code-seller-price">
                            Indicate the price of the item
                        </p>
                        <div style="display: flex; align-items: center; ">
                            <input type="number" class="generate-seller-code-price make-a-payment-price01" value="0"
                                pattern="[0-9]*" oninput="validateNumber(this)" inputmode="numeric" min="0"
                                name="price" id="price_input" style="height: 71px !important">
                            <select class="generate-seller-code-price make-a-payment-price01"
                                style="width: 21%;height: 51px;font-size: 36px;" id="currency_input">
                                <option value="EUR" selected>€</option>
                                <option value="USD">$</option>
                                <option value="GBP">£</option>
                                <option value="CHF">CHF</option>
                                <option value="JPY">¥</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="generate-seller-code-row">
                    <div class="generate-seller-code-column">
                        <p class="generate-seller-code-text">
                            Remember to check the form and verify that the item you are
                            paying for is the right one!
                        </p>
                        <div class="buy-follow-receive__buttons">
                            <div class="btn-box1">
                                <button class="buy-follow-receive__btn" id="verify-code">
                                    <p>GENERATE CODE</p>
                                    <img src="{{ asset('assets/images/fav.png') }}" alt="" />
                                </button>
                            </div>
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

            // Function to ensure only numeric input
            $('#price_input').on('input', function() {
                var currentValue = $(this).val();

                // Remove any non-numeric characters except for the decimal point
                var numericValue = currentValue.replace(/[^0-9.]/g, '');

                // Ensure that only one decimal point is allowed
                // if (numericValue.split('.').length > 2) {
                //     numericValue = numericValue.replace(/\.+$/, '');
                // }

                // Set the cleaned value back to the input field
                $(this).val(numericValue);
            });

            // Ensure that a number like .34 is not allowed as the first character
            $('#price_input').on('focusout', function() {
                var currentValue = $(this).val();
                // If the value starts with a decimal point, add a leading zero
                if (currentValue.startsWith('.')) {
                    $(this).val('0' + currentValue);
                }
            });
            // -------- send verification code to email ---------
            $('body').on('click', '#send-code', function(e) {
                e.preventDefault();
                let email = $('#email-input').val();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');
                let name = $('#name-input').val();
                if (!name) {
                    toastr.error('Please insert name');
                    return;
                }
                if (!email) {
                    toastr.error('Please insert email');
                    return;
                }


                let data = {
                    email: email,
                    name: name,
                    source: 'seller',
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

            // -------- verify the code -----------
            $('body').on('click', '#verify-code', function(e) {
                e.preventDefault();
                let email = $('#email-input').val();
                let code = $('#verification_code').val();
                let name = $('#name-input').val();
                let title = $('#title_input').val();
                let words = $('#In-two-words').val();
                let price = $('#price_input').val();
                let currency = $('#currency_input').val();
                let currencySymbol = $('#currency_input option:selected').text();

                if (!name) {
                    toastr.error('Please enter your name');
                    return;
                }

                if (!email) {
                    toastr.error('Please insert email');
                    return;
                }

                if (!code) {
                    toastr.error('Please click on confirm to verify your email');
                    return;
                }

                if (!title) {
                    toastr.error('Please enter a title');
                    return;
                }

                if (!words) {
                    toastr.error('Please enter two words');
                    return;
                }

                if (!price || price == 0) {
                    toastr.error('Please enter a price more than 0');
                    return;
                }

                if (!currency) {
                    toastr.error('Please select a currency');
                    return;
                }

                let data = {
                    code: code,
                    name: name,
                    email: email,
                    title: title,
                    price: price,
                    currency: currency,
                    currency_symbol: currencySymbol,
                    words: words,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };
                console.log(data);
                $.ajax({
                    url: "{{ route('save.sellercode') }}",
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.message);
                        } else {
                            $('#seller_code_form')[0].reset();
                            $('#name-input').val('');
                            $('#email-input').val('');
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
