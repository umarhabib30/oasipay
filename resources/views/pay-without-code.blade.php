@extends('layouts.app')
@section('content')
    <main>
        <section class="pay-without-code-container">
            <h1>I want to pay without code</h1>
            <form class="pay-without-code-form" action="">
                <div class="pay-without-code-column">
                    <div class="pay-without-code-form-main">
                        <div class="pay-without-code-form-left">


                            <div class="form-group">
                                <label for="email-input">E-mail</label>
                                <input type="email" id="email-input" class="form-control" name="email" required />
                            </div>
                        </div>
                        <div class="pay-without-code-form-right">
                            <a href="#"><img src="./assets/images/confirm.png" /></a>
                        </div>
                    </div>
                    <div class="form-group form-group-seller-code-input">
                        <label for="seller-code-input">The payment is for...</label>
                        <input type="text" id="seller-code-input" class="form-control" name="seller_code"
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
                    <p class="pay-without-code-price make-a-payment-price01">
                        1'919,45€
                    </p>
                    <p class="pay-without-code-text">
                        In this case OasiPay only takes care of the transaction, not the
                        shipping!
                    </p>
                    <div class="buy-follow-receive__payments">
                        <img src="{{ asset('assets/images/apple-pay.png') }}" alt="apple-pay" />
                        <img src="./assets/images/ame.png" alt="apple-pay" />
                        <img src="./assets/images/google-pay.png" alt="google-pay" />
                        <img src="./assets/images/paypal.png" alt="paypal" />
                        <img src="./assets/images/Master.png" />
                    </div>
                </div>

                <div class="pay-without-code-column">
                    <p class="pay-without-code-seller-price">The fees amount</p>
                    <p class="pay-without-code-price make-a-payment-price01">
                        95,97€
                    </p>
                    <p class="pay-without-code-seller-price pay-without-code-seller-price01">You will pay</p>
                    <p class="pay-without-code-price ">
                        2'015.42€
                    </p>

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
                                <img src="./assets/images/fav.png" alt="" />
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
