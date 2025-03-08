@extends('layouts.app')
@section('content')
<main>
    <section class="receive-payment-container">
        <h1>Receive a Payment</h1>
        <form class="receive-payment-form" action="">
            <div class="receive-payment-column">
                <div class="receive-payment-form-main">
                    <div class="receive-payment-form-left">
                        <div class="form-group">
                            <label for="name-input">Name</label>
                            <input type="text" id="name" name="name" required />
                        </div>

                        <div class="form-group">
                            <label for="email-input">Email</label>
                            <input type="email" id="email-input" class="form-control" name="email" required />
                        </div>

                        <div class="form-group">
                            <label for="Insert-buyer-code">Insert buyer code</label>
                            <input type="text" id="Insert-buyer-cod" class="form-control" name="Insert-buyer-code"
                                required />
                        </div>
                    </div>
                    <div class="receive-payment-form-right">
                        <a href="#"><a href="#"><img src="{{ asset('assets/images/confirm.png') }}" /></a></a>
                    </div>
                </div>

                <div class="receive-payment-btn-box">
                    <a href="#" class="btn">CONFIRM CODE</a>
                    <a href="Generate-Seller-Code.html" class="btn">I WANT SELLER CODE</a>

                </div>
                <p class="make-a-payment-seller-price">Buyer pay</p>
                <p class="receive-payment-price">1'919,45€</p>
                <p class="receive-payment-text">
                    If the price is not consistent with the item offered for sale, do
                    not continue. Contact the seller and ask him to verify and redo
                    the correct payment!
                </p>
                <p class="make-a-payment-seller-price">You receive</p>
                <p class="receive-payment-price">1'919,45€</p>

            </div>

            <div class="receive-payment-column">
                <div class="form-group">
                    <label for="The-payment-is-for">You receive a payement for...</label>
                    <input type="text" id="The-payment-is-for" class="form-control" name="The-payment-is-for"
                        required placeholder="Item for which you pay" />
                </div>
                <div class="form-group">
                    <label for="In-two-words">In two words</label>
                    <textarea type="text" id="In-two-words" class="form-control" name="In-two-words" required
                        placeholder="small descripption of item"></textarea>
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
                        <input type="radio" name="receive-payment" id="swift" /><span class="custom-radio"></span>
                        <img src="{{ asset('assets/images/iban.png') }}"></label>
                </div>

                <div class="form-group">
                    <label for="account-holder">Account holder name</label>
                    <input type="text" id="account-holder" name="name" required />
                </div>

                <div class="form-group">
                    <label for="IBAN">IBAN</label>
                    <input type="text" id="IBAN" class="form-control" name="IBAN" required />
                </div>
                <div class="form-group">
                    <label for="BIC-Swift">BIC-Swift</label>
                    <input type="text" id="BIC-Swift" class="form-control" name="BIC-Swift" required />
                </div>

                <div class="receive-payment-radio-options">
                    <label><input type="radio" id="paypalRadio" name="receive-payment" /><span
                            class="custom-radio"></span>
                        <img class="paypal-icon" src="{{ asset('assets/images/paypal.png') }}"></label>
                </div>
                <div class="form-group form-group-f">
                    <label for="Insert-buyer-code">Insert your link for recive payment
                    </label>
                    <input type="text" id="Insert-buyer-code" class="form-control" name="Insert-buyer-code"
                        required />
                </div>
                <div class="buy-follow-receive__buttons">
                    <div class="btn-box1">
                        <button class="buy-follow-receive__btn">
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
