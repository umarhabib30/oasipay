@extends('layouts.app')
@section('content')
    <main>
        <section class="cancel-transaction-container">
            <h1>Cancel Transaction</h1>
            <form class="cancel-transaction-form" action="">
                <input type="hidden" name="" id="is_confirmed" value="0">
                <div class="cancel-transaction-row">
                    <div class="cancel-transaction-column">
                        <div class="form-group">
                            <label for="name-input">Name</label>
                            <input type="text" id="name-input" name="name"
                                required />
                        </div>

                        <div class="form-group">
                            <label for="enter-email-input">E-mail </label>
                            <input type="text" id="enter-email-input" class="form-control" name="email"
                                 required />
                        </div>
                        <div class="form-group">
                            <label for="insert-transaction-code">Insert Transaction code
                            </label>
                            <input type="text" id="insert-transaction-code" class="form-control" name="insert-transaction-code" value="{{ $transaction->seller_code }}" readonly required />
                        </div>

                        <div style="margin-top: 20px" class="confirm-transaction-btn-box">
                            <a href="" class="btn" id="confirm-code">CONFIRM</a>
                        </div>
                    </div>
                    <div class="cancel-transaction-column">
                        <p class="confirm-transaction-seller-price">Cost of item</p>
                        <p class="confirm-transaction-price">
                            {{ $transaction->price}} {{ $transaction->currency_symbol }}
                        </p>

                        <p class="confirm-transaction-fee-text">
                            this is the payment you would have received
                        </p>
                        <p class="confirm-transaction-fee-details">
                            Cost of item
                            <span
                                class="confirm-transaction-fee-details-span confirm-transaction-fee-details-span02"> {{$transaction->price}}
                                {{ $transaction->currency_symbol }}</span>
                        </p>

                        <p class="confirm-transaction-fee-details">
                            The fees amount
                            <span
                                class="confirm-transaction-fee-details-span confirm-transaction-fee-details-span02"> {{ $transaction->fee_price }}
                                {{ $transaction->currency_symbol }}</span>
                        </p>
                    </div>
                    <div class="cancel-transaction-column">
                        <p class="confirm-transaction-seller-price">Transaction amount</p>
                        <p class="confirm-transaction-price">
                            {{ $transaction->total }} {{ $transaction->currency_symbol }}
                        </p>

                        <p class="confirm-transaction-fee-text">
                            The final price includes OasiPay fees.
                        </p>
                    </div>
                </div>
                <div class="cancel-transaction-row">
                    <p class="contact-us-text">
                        Remember that once the operation is completed it is not
                        reversible. The transaction cannot be canceled if the item has
                        been shipped.
                    </p>
                    <div class="confirm-transaction-btn-box">
                        <a href="#" class="btn" id="cancel-transaction">CANCEL</a>
                        <a href="javascript:history.back()" class="btn">BACK</a>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '#confirm-code', function(e) {
                e.preventDefault();
                let seller_code = $('#insert-transaction-code').val();
                let email = $('#enter-email-input').val();
                if (!seller_code) {
                    toastr.error('Please Transaction code');
                    return;
                }
                let data = {
                    email: email,
                    seller_code: seller_code,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };
                $.ajax({
                    url: "{{ route('transaction.confirm.code') }}",
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.message);
                        } else {
                            $('#is_confirmed').val(1);
                            toastr.success(response.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $('body').on('click','#cancel-transaction',function(e){
                e.preventDefault();
                let is_confirmed = $('#is_confirmed').val();
                if(is_confirmed == 0){
                    toastr.error('Please confirm transaction code');
                    return;
                }
                let seller_code = $('#insert-transaction-code').val();
                let data = {
                    seller_code: seller_code,
                    _token: $('meta[name="csrf-token"]').attr('content')
                };
                $.ajax({
                    url: "{{ route('transaction.cancel.store') }}",
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.message);
                        } else {
                            toastr.success(response.message);
                            window.location.href= "{{ route('home') }}";
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
