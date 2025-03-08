@extends('layouts.app')
@section('content')
    <main>
        <section class="make-a-payment-container">
            <h1>Make a Payment</h1>
            <form class="make-a-payment-form" action="">
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
                            <a href="#"><img src="{{ asset('assets/images/confirm.png')}}" /></a>
                        </div>
                    </div>
                    <a href="#" style="margin-top: 10px" class="btn">CONFIRM CODE</a>

                    <p class="make-a-payment-text">
                        Remember to check the form and verify that the item you are paying
                        for is the right one!
                    </p>
                    <div class="make-a-payment-btn-box">
                        <a href="pay-without-code.html" class="btn">I PAY WITHOUT CODE</a>
                        <a href="Generate-Seller-Code.html" class="btn">I WANT SELLER CODE</a>
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
                    <p class="make-a-payment-price">1'919,45€</p>
                    <div class="make-a-payment-price-details">
                        <p class="make-a-payment-fee-details">
                            The fees amount
                            <span class="make-a-payment-fee-details-span">95,97€</span>
                        </p>
                    </div>
                    <p class="make-a-payment-seller-price">You will pay</p>
                    <p class="make-a-payment-price make-a-payment-price01">2'030,42€</p>
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
