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
                        {{ number_format($transaction->price, 2) }} {{ $transaction->currency_symbol }}
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
                                <input type="text" id="shipping-code" class="form-control" name="shipping-code"  @if ($transaction->shipping_code)
                                readonly value="{{ $transaction->shipping_code }}"
                                @endif required />
                            </div>

                            <div class="confirm-box">
                                <p class="receive-payment-text">
                                    the tracking code is provided by the seller shipping.
                                </p>

                                <div class="buy-follow-receive__buttons">
                                    @if ($transaction->shipping_code)
                                    <button class="buy-follow-receive__btn" id="contact_oasipay_alert">
                                        <p>INSERT CODE</p>
                                        <img src="{{ asset('assets/images/truck.png') }}" alt="" />
                                    </button>
                                    @else
                                    <button class="buy-follow-receive__btn" id="buy-follow-receive__btn">
                                        <p>INSERT CODE</p>
                                        <img src="{{ asset('assets/images/truck.png') }}" alt="" />
                                    </button>
                                    @endif
                                </div>

                            </div>
                        </div>

                        <div class="monitoring-transaction__column">
                            <div class="receive-payment-btn-box">
                                <a href="{{ route('transaction.cancel',$transaction->seller_code) }}" class="btn">CANCEL TRANSACTION</a>
                                <a href="{{ route('contact-us') }}" class="btn">CONTACT US</a>

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
                            <a href="#" class="btn">I RECEIVE ITEM</a>
                            <a href="{{route('tellus', $transaction->seller_code)}}" class="btn">WHAT’S WRONG</a>

                        </div>
                    </div>
                </div>
            </form>
        </section>

        <!-- The Modal -->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content" >
                <div class="modal-header">
                    <span class="close">&times;</span>
                  </div>
                <div class="modal-body">
                    <label for="The-payment-is-for">Seller Email</label>
                    <input type="email" style="height: 40px; margin-top: 15px;" id="seller_email_input" class="form-control" name="The-payment-is-for"   placeholder="Please provide seller email to insert shipping code" />
                    <div class="buy-follow-receive__buttons">
                        <button class="buy-follow-receive__btn" id="store_shipping_code" style="width: 30%;">
                            <p>INSERT CODE</p>
                            <img src="{{ asset('assets/images/truck.png') }}" alt="" />
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
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

            // ----- contact oasipay to update the code ----------
            $('body').on('click','#contact_oasipay_alert',function(e){
                e.preventDefault();
                toastr.error('Contact Oasipay team to change it');
            });

            // --------- store the seller code -------------
            $('body').on('click','#store_shipping_code',function(e){
                e.preventDefault();
                let shipping_code = $('#shipping-code').val();
                let email = $('#seller_email_input').val();
                let seller_code = $('#seller_code').val();
                if(!email){
                    toastr.error('Please insert seller email');
                    return;
                }

                let data = {
                    shipping_code : shipping_code,
                    email : email,
                    seller_code : seller_code,
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
                            $('#shipping-code').attr('readonly',true);
                            toastr.success(response.message);
                        }
                    },
                    error: function(error) {
                        console.log( error);
                    }
                });

            });
        });

        // When the user clicks on <span> (x), close the modal
        var modal = document.getElementById("myModal");
        var span = document.getElementsByClassName("close")[0];
        span.onclick = function() {
            modal.style.display = "none";
        }
    </script>
@endsection
