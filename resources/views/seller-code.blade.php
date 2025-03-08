@extends('layouts.app')
@section('content')
    <main>
        <section class="generate-seller-code-container">
            <h1>Generate Seller Code</h1>
            <form class="generate-seller-code-form" action="{{ route('save.sellercode') }}" method="POST">
                @csrf
                <div class="generate-seller-code-row">
                    <div class="generate-seller-code-column">
                        <div class="form-group">
                            <label for="name-input">Name</label>
                            <input type="text" id="name-input" name="name" required />
                        </div>
                    </div>

                    <div class="generate-seller-code-column generate-seller-code-column-mail">
                        <div class="form-group">
                            <label for="email-input">E-mail</label>
                            <input type="email" id="email-input" class="form-control" name="email" required />
                        </div>
                        <div class="generate-seller-code-form-right" style="display: none" id="confirmed-img">
                            <a href="#"><img src="{{ asset('assets/images/confirm.png') }}" /></a>
                        </div>
                    </div>
                    <div class="generate-seller-code-column">
                        <div class="form-group">
                            <label for="name-input">Send code</label>
                            <a class="btn" id="send-code">Send</a>
                        </div>
                    </div>
                    <div class="generate-seller-code-column">
                        <div class="form-group">
                            <label for="name-input">Enter Code</label>
                            <input type="text" id="verification_code" name="" required />
                        </div>
                    </div>
                    <div class="generate-seller-code-column">
                        <label for="name-input">Verify code</label>
                        <button class="btn" id="verify-code">Verify</button>
                    </div>
                </div>

                <div class="generate-seller-code-row">
                    <div class="generate-seller-code-column">
                        <div class="form-group form-group-seller-code-input">
                            <label for="seller-code-input">The code is for....</label>
                            <input type="text" id="seller-code-input" class="form-control" name="seller_code"
                                placeholder="item for the code is made" required />
                        </div>
                    </div>
                    <div class="generate-seller-code-column">
                        <div class="form-group form-group-seller-code-input">
                            <label for="seller-code-input"> Indicate the price of the item</label>
                            <input type="text" id="seller-code-input" class="form-control" name="price"
                                placeholder=" 1'919,45€" required />
                        </div>
                    </div>
                    <div class="generate-seller-code-column">
                        <div class="form-group form-group-In-two-words">
                            <label for="In-two-words">In two words</label>
                            <textarea type="text" id="In-two-words" class="form-control" name="words" required
                                placeholder="small descripption of item"></textarea>
                        </div>
                    </div>

                    {{-- <div class="generate-seller-code-column">
                        <p class="generate-seller-code-seller-price">
                            Indicate the price of the item
                        </p>
                        <p class="generate-seller-code-price make-a-payment-price01">
                            1'919,45€
                        </p>
                        <input type="text" name="" id="" class="generate-seller-code-price make-a-payment-price01">
                    </div> --}}
                </div>

                <div class="generate-seller-code-row">
                    <div class="generate-seller-code-column">
                        <p class="generate-seller-code-text">
                            Remember to check the form and verify that the item you are
                            paying for is the right one!
                        </p>
                        <div class="buy-follow-receive__buttons">
                            <div class="btn-box1">
                                <button class="buy-follow-receive__btn">
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
        $(document).ready(function(){
            // -------- send verification code to email ---------
            $('body').on('click', '#send-code', function(e) {
                e.preventDefault();
                let email = $('#email-input').val();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                if(!email){
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
                        if(response.error){
                            toastr.error(response.message);
                        }else{
                            toastr.success(response.message);
                        }
                    },
                    error: function(error) {
                        console.log('Error sending code:', error);
                    }
                });
            });

            // -------- verify the code -----------
            $('body').on('click','#verify-code',function(e){
                e.preventDefault();
                let email = $('#email-input').val();
                let code = $('#verification_code').val();

                if(!email){
                    toastr.error('Please insert email again');
                    return;
                }

                if(!code){
                    toastr.error('Please insert verification code from mail first');
                    return;
                }
                let data={
                    email: email,
                    code: code,
                  _token: $('meta[name="csrf-token"]').attr('content')
                };
                $.ajax({
                    url: "{{ route('verify.code') }}",
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if(response.error){
                            toastr.error(response.message);
                        }else{
                            $('#confirmed-img').css('display','block');
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
