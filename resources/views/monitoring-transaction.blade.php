@extends('layouts.app')
@section('style')
    <style>

       

        /* The Modal (background) */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 35%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s;
            border-radius: 20px;
            padding: 20px;
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        @media only screen and (max-width: 1900px) {
            .modal-content {
                width: 35% !important;
            }
        }

        @media only screen and (max-width: 1825px) {
            .modal-content {
                width: 40% !important;
            }
        }

        @media only screen and (max-width: 1590px) {
            .modal-content {
                width: 50% !important;
            }
        }

        @media only screen and (max-width: 1375px) {
            .modal-content {
                width: 65% !important;
            }
        }


        @media only screen and (max-width: 1200px) {
            .modal-content {
                width: 90% !important;
            }
        }

        @media only screen and (max-width: 730px) {
            .buy-follow-receive__btn {
                width: 45% !important;
            }
        }
        @media only screen and (max-width: 520px) {
            .buy-follow-receive__btn {
                width: 90% !important;
            }
        }

        /* The Close Button */
        .close {
            color: rgb(35, 90, 134);
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: rgb(35, 90, 134);
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            height: 35px;
            color: rgb(35, 90, 134);
        }

        .modal-body {
            padding: 2px 16px;
        }
    </style>
@endsection
@section('content')
    <main>
        <form action="{{ url('send/item-receive/email') }}" method="POST" id="receive_item_form">
            @csrf
            <input type="hidden" name="seller_code" id="" value="{{ $transaction->seller_code }}">
        </form>

        <section class="monitoring-transaction-container">
            <h1>Monitoring Transaction</h1>
            <form class="monitoring-transaction-form" action="#">
                <input type="hidden" name="seller_code" id="seller_code" value="{{ $transaction->seller_code }}">
                <div class="monitoring-transaction-column">
                    <div class="form-group">
                        <label for="The-payment-is-for">You receive a payment for...</label>
                        <input type="text" id="The-payment-is-for" class="form-control" name="The-payment-is-for"
                            value="{{ @$transaction->title }}" readonly placeholder="Item for which you pay" />
                    </div>
                    <div class="form-group">
                        <label for="In-two-words">In two words</label>
                        <textarea type="text" id="In-two-words" class="form-control" name="In-two-words" readonly
                            placeholder="small descripption of item"> {{ @$transaction->words }}</textarea>
                    </div>

                    <p class="monitoring-transaction-title">Transaction amount</p>
                    <p class="monitoring-transaction-amount">
                        {{ $transaction->price}} {{ $transaction->currency_symbol }}
                    </p>

                    </p>
                    <p class="monitoring-transaction-text">
                        the price does not include taxes, the total amount is visible only
                        to the buyer
                    </p>
                </div>

                <div class="monitoring-transaction-column">
                    <div class="monitoring-transaction-row">
                        <div class="monitoring-transaction__column">
                            <div class="form-group">
                                <label for="The-payment-is-for">Shipping code </label>
                                <input type="text" id="shipping-code" class="form-control" name="shipping-code"
                                    @if ($transaction->shipping_code) readonly value="{{ $transaction->shipping_code }}" @endif
                                    required />
                            </div>

                            <div class="confirm-box">
                                <p class="receive-payment-text">
                                    the tracking code is provided by the seller shipping.
                                </p>

                                <div class="buy-follow-receive__buttons">
                                    @if ($transaction->shipping_code)
                                        <button class="buy-follow-receive__btn" id="contact_oasipay_alert"  @if ($transaction->item_recieved) disabled @endif>
                                            <p>INSERT CODE</p>
                                            <img src="{{ asset('assets/images/truck.png') }}" alt="" />
                                        </button>
                                    @else
                                        <button class="buy-follow-receive__btn" id="buy-follow-receive__btn"  @if ($transaction->item_recieved) disabled @endif>
                                            <p>INSERT CODE</p>
                                            <img src="{{ asset('assets/images/truck.png') }}" alt="" />
                                        </button>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="monitoring-transaction__column">
                            <div class="receive-payment-btn-box">
                                @if ($transaction->shipping_code)
                                    <a href="" class="btn has_shipping_code {{ $transaction->item_recieved ? 'disabled-link' : '' }}"  >CANCEL TRANSACTION</a>
                                @else
                                    <a href="{{ route('transaction.cancel', $transaction->seller_code) }}"
                                        class="btn {{ $transaction->item_recieved ? 'disabled-link' : '' }}"  >CANCEL TRANSACTION</a>
                                @endif
                                <a href="{{ route('contact-us') }}" class="btn {{ $transaction->item_recieved ? 'disabled-link' : '' }}"  >CONTACT US</a>

                            </div>
                        </div>
                    </div>

                    <div class="monitoring-transaction-row mo-hight">
                        <div class="tracking-container">
                            <div class="tracking-header">Item tracking</div>
                            <div class="progress-line">
                                <div class="step step-1">
                                    <img src="{{ asset('assets/images/person-carrying-carton.webp') }}"
                                        alt="Person carrying box" />
                                    <p>item not yet shipped</p>
                                </div>
                                <div class="step step-2">
                                    <img src="{{ asset('assets/images/truck-carrying-carton.png') }}"
                                        alt="Delivery truck" />
                                    <p>item paid by the courier</p>
                                </div>
                                <div class="step step-3">
                                    <img src="{{ asset('assets/images/flag-blue.png') }}" alt="Checkered flag"
                                        class="flag" />
                                    <p>item delivered</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="monitoring-transaction-row mo-hight">
                        <div class="tracking-container">
                            <div class="tracking-header">Transaction tracking</div>
                            <div class="progress-line">
                                <div class="step step-4">
                                    <img src="{{ asset('assets/images/money-bundle.png') }}" alt="Person carrying box" />
                                    <p>payment just made</p>
                                </div>
                                <div class="step step-5">
                                    <img src="{{ asset('assets/images/favicon.png') }}" alt="Delivery truck" />
                                    <p>payment in charge of OasiPay</p>
                                </div>
                                <div class="step step-6">
                                    <img src="{{ asset('assets/images/flag-blue.png') }}" alt="Checkered flag"
                                        class="flag" />
                                    <p>payment sent to seller</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="monitoring-transaction-row">
                        <div class="monitoring-transaction-btn-box">
                            @if (isset($code))
                                <a href="#" class="btn {{ $transaction->item_recieved ? 'disabled-link' : '' }}" id="code_verified"  >I RECEIVE ITEM</a>
                            @else
                                <a class="btn {{ $transaction->item_recieved ? 'disabled-link' : '' }}" id="send_verification_code"  >I RECEIVE ITEM</a>
                            @endif
                            <a href="{{ route('tellus', $transaction->seller_code) }}" class="btn">WHAT’S WRONG</a>

                        </div>
                    </div>
                </div>
            </form>
        </section>

        <!-- The Modal for shipping code -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" id="close_shipping_model">&times;</span>
                </div>
                <div class="modal-body">
                    <label for="The-payment-is-for">Seller Email</label>
                    <input type="email" style="height: 40px; margin-top: 15px;" id="seller_email_input"
                        class="form-control" name="The-payment-is-for"
                        placeholder="Please provide seller email to insert shipping code" />
                    <div class="buy-follow-receive__buttons"
                        style="justify-content: center !important; flex-direction: row;">
                        <button class="buy-follow-receive__btn" id="store_shipping_code" style="width: 30%;">
                            <p>INSERT CODE</p>
                            <img src="{{ asset('assets/images/truck.png') }}" alt="" />
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- model for receive item --}}
        <div id="item_received_model" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close close_item">&times;</span>
                </div>
                <div class="modal-body">
                    <label for="The-payment-is-for">Buyer Name</label>
                    <input type="email" style="height: 40px; margin-top: 15px;" id="item_reciever_name"
                        class="form-control" name="name" placeholder="Please provide buyer name" />
                    <label for="The-payment-is-for">Buyer Email</label>
                    <input type="email" style="height: 40px; margin-top: 15px;" id="item_reciever_email"
                        class="form-control" name="email" placeholder="Please provide bu email" />
                    <div class="buy-follow-receive__buttons justify-content-center"
                        style="justify-content: center !important;  flex-direction: row;">
                        <a class="btn" id="send_verification_mail">Verify Email</a>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // --------- open model for verification of receive item -----------
            $('body').on('click', '#send_verification_code', function(e) {
                e.preventDefault();
                var modal = document.getElementById("item_received_model");
                modal.style.display = "block";
            });

            // ------- cancel shipping code error ----------
            $('body').on('click', '.has_shipping_code', function(e) {
                e.preventDefault();
                toastr.error('Contact Oasipay support to cancel the transaction');
            });

            // -----  open seller mail model --------
            $('body').on('click', '#buy-follow-receive__btn', function(e) {
                e.preventDefault();
                let shipping_code = $('#shipping-code').val();
                if (!shipping_code) {
                    toastr.error('Please insert shipping code');
                } else {
                    var modal = document.getElementById("myModal");
                    modal.style.display = "block";
                }
            });


            // --- send item recieve verification mail ---
            $('body').on('click', '#send_verification_mail', function(e) {
                e.preventDefault();
                let name = $('#item_reciever_name').val();
                let email = $('#item_reciever_email').val();
                let seller_code = $('#seller_code').val();
                let source = 'item_received';
                let data = {
                    name: name,
                    email: email,
                    seller_code: seller_code,
                    source: source,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };
                $.ajax({
                    url: "{{ route('verification.mail.send') }}",
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.message);
                        } else {
                            var modal = document.getElementById("item_received_model");
                            modal.style.display = "none";
                            toastr.success(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });

            // ---- send item recieved mail --------
            $('body').on('click', '#code_verified', function(e) {
                $('#receive_item_form').submit();
            });

            // ----- contact oasipay to update the code ----------
            $('body').on('click', '#contact_oasipay_alert', function(e) {
                e.preventDefault();
                toastr.error('Contact Oasipay team to change it');
            });

            // --------- store the seller code -------------
            $('body').on('click', '#store_shipping_code', function(e) {
                e.preventDefault();
                let shipping_code = $('#shipping-code').val();
                let email = $('#seller_email_input').val();
                let seller_code = $('#seller_code').val();
                if (!email) {
                    toastr.error('Please insert seller email');
                    return;
                }

                let data = {
                    shipping_code: shipping_code,
                    email: email,
                    seller_code: seller_code,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };
                console.log(data);
                $.ajax({
                    url: "{{ route('transaction.shipping.store') }}",
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.message);
                        } else {
                            var modal = document.getElementById("myModal");
                            modal.style.display = "none";
                            $('#shipping-code').attr('readonly', true);
                            toastr.success(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

            });

            $('body').on('click', '#close_shipping_model', function() {
                var modal = document.getElementById("myModal");
                modal.style.display = "none";
            });

        });



        // When the user clicks on <span> (x), close the modal
        var modal = document.getElementById("item_received_model");
        var span = document.getElementsByClassName("close_item")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
@endsection
